<?php

namespace App\Imports;

use App\Models\ExamQuestion;
use App\Models\ExamQuestionOption;
use App\Models\ExamSubject;
use App\Models\ExamTopic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use RuntimeException;

class ExamQuestionsImport implements ToCollection, WithHeadingRow
{
    protected int $libraryId;

    protected int $imported = 0;

    public function __construct(int $libraryId)
    {
        $this->libraryId = $libraryId;
    }

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            $excelRow = $index + 2;

            $this->validateRow($row, $excelRow);

            DB::transaction(function () use ($row, $excelRow) {
                $subject = $this->findSubject(
                    trim((string) $row['subject']),
                    $excelRow
                );

                $topic = $this->findTopic(
                    trim((string) $row['topic']),
                    $subject,
                    $excelRow
                );

                $questionType = strtolower(
                    trim((string) ($row['question_type'] ?? 'mcq'))
                );

                if (
                    !in_array(
                        $questionType,
                        ['mcq', 'true_false'],
                        true
                    )
                ) {
                    throw new RuntimeException(
                        "Row {$excelRow}: question_type must be mcq or true_false."
                    );
                }

                $question = ExamQuestion::create([
                    'library_id' => $this->libraryId,
                    'subject_id' => $subject->id,
                    'topic_id' => $topic->id,
                    'question_text' => trim(
                        (string) $row['question']
                    ),
                    'question_type' => $questionType,
                    'explanation' => $this->nullableValue(
                        $row['explanation'] ?? null
                    ),
                    'marks' => $this->numberValue(
                        $row['marks'] ?? 1,
                        1
                    ),
                    'negative_marks' => $this->numberValue(
                        $row['negative_marks'] ?? 0,
                        0
                    ),
                    'difficulty' => $this->difficultyValue(
                        $row['difficulty'] ?? 'Medium',
                        $excelRow
                    ),
                    'sort_order' => $this->nextSortOrder(
                        $subject->id,
                        $topic->id
                    ),
                    'is_active' => $this->booleanValue(
                        $row['status'] ?? 'Active'
                    ),
                ]);

                if ($questionType === 'mcq') {
                    $this->createMcqOptions(
                        $question,
                        $row,
                        $excelRow
                    );
                } else {
                    $this->createTrueFalseOptions(
                        $question,
                        $row,
                        $excelRow
                    );
                }

                $this->imported++;
            });
        }
    }

    protected function validateRow(
        Collection $row,
        int $excelRow
    ): void {
        if (
            trim((string) ($row['question'] ?? '')) === ''
        ) {
            throw new RuntimeException(
                "Row {$excelRow}: question is required."
            );
        }

        if (
            trim((string) ($row['subject'] ?? '')) === ''
        ) {
            throw new RuntimeException(
                "Row {$excelRow}: subject is required."
            );
        }

        if (
            trim((string) ($row['topic'] ?? '')) === ''
        ) {
            throw new RuntimeException(
                "Row {$excelRow}: topic is required."
            );
        }
    }

    protected function findSubject(
    string $name,
    int $excelRow
): ExamSubject {
    $subject = ExamSubject::query()
        ->where('library_id', $this->libraryId)
        ->whereRaw('LOWER(name) = ?', [
            strtolower($name),
        ])
        ->first();

    if ($subject) {
        return $subject;
    }

    $sortOrder = (
        (int) ExamSubject::query()
            ->where('library_id', $this->libraryId)
            ->max('sort_order')
    ) + 1;

    return ExamSubject::create([
        'library_id' => $this->libraryId,
        'name' => $name,
        'slug' => ExamSubject::makeSlug(
            $name,
            $this->libraryId
        ),
        'description' => null,
        'is_active' => true,
        'sort_order' => $sortOrder,
    ]);
}

   protected function findTopic(
    string $name,
    ExamSubject $subject,
    int $excelRow
): ExamTopic {
    $topic = ExamTopic::query()
        ->where('library_id', $this->libraryId)
        ->where('subject_id', $subject->id)
        ->whereRaw('LOWER(name) = ?', [
            strtolower($name),
        ])
        ->first();

    if ($topic) {
        return $topic;
    }

    $sortOrder = (
        (int) ExamTopic::query()
            ->where('library_id', $this->libraryId)
            ->where('subject_id', $subject->id)
            ->max('sort_order')
    ) + 1;

    return ExamTopic::create([
        'library_id' => $this->libraryId,
        'subject_id' => $subject->id,
        'name' => $name,
        'slug' => ExamTopic::makeSlug(
            $name,
            $subject->id
        ),
        'description' => null,
        'is_active' => true,
        'sort_order' => $sortOrder,
    ]);
}
    protected function createMcqOptions(
        ExamQuestion $question,
        Collection $row,
        int $excelRow
    ): void {
        $options = [
            $row['option_1'] ?? null,
            $row['option_2'] ?? null,
            $row['option_3'] ?? null,
            $row['option_4'] ?? null,
            $row['option_5'] ?? null,
            $row['option_6'] ?? null,
        ];

        $options = array_values(
            array_filter(
                $options,
                fn ($value) =>
                    trim((string) $value) !== ''
            )
        );

        if (count($options) < 2) {
            throw new RuntimeException(
                "Row {$excelRow}: MCQ requires at least 2 options."
            );
        }

        $correctOption = (int) (
            $row['correct_option'] ?? 0
        );

        if (
            $correctOption < 1
            || $correctOption > count($options)
        ) {
            throw new RuntimeException(
                "Row {$excelRow}: correct_option must be between 1 and "
                . count($options) . '.'
            );
        }

        foreach ($options as $index => $optionText) {
            $question->options()->create([
                'option_text' => trim((string) $optionText),
                'is_correct' => ($index + 1) === $correctOption,
                'sort_order' => $index + 1,
            ]);
        }
    }

    protected function createTrueFalseOptions(
        ExamQuestion $question,
        Collection $row,
        int $excelRow
    ): void {
        $answer = strtolower(
            trim((string) ($row['correct_option'] ?? ''))
        );

        if (
            !in_array(
                $answer,
                ['true', 'false'],
                true
            )
        ) {
            throw new RuntimeException(
                "Row {$excelRow}: For true_false, correct_option must be true or false."
            );
        }

        $question->options()->create([
            'option_text' => 'True',
            'is_correct' => $answer === 'true',
            'sort_order' => 1,
        ]);

        $question->options()->create([
            'option_text' => 'False',
            'is_correct' => $answer === 'false',
            'sort_order' => 2,
        ]);
    }

    protected function nextSortOrder(
        int $subjectId,
        int $topicId
    ): int {
        return (
            (int) ExamQuestion::query()
                ->where('library_id', $this->libraryId)
                ->where('subject_id', $subjectId)
                ->where('topic_id', $topicId)
                ->max('sort_order')
        ) + 1;
    }

    protected function difficultyValue(
        mixed $value,
        int $excelRow
    ): string {
        $difficulty = ucfirst(
            strtolower(trim((string) $value))
        );

        if (
            !in_array(
                $difficulty,
                ['Easy', 'Medium', 'Hard'],
                true
            )
        ) {
            throw new RuntimeException(
                "Row {$excelRow}: difficulty must be Easy, Medium or Hard."
            );
        }

        return $difficulty;
    }

    protected function numberValue(
        mixed $value,
        float $default
    ): float {
        if (
            $value === null
            || trim((string) $value) === ''
        ) {
            return $default;
        }

        return (float) $value;
    }

    protected function booleanValue(mixed $value): bool
    {
        $value = strtolower(
            trim((string) $value)
        );

        return !in_array(
            $value,
            ['0', 'false', 'inactive', 'no'],
            true
        );
    }

    protected function nullableValue(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    public function importedCount(): int
    {
        return $this->imported;
    }
}