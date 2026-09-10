<?php

namespace App\Exports;

use App\Models\ExamQuestion;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExamQuestionsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(
        protected int $libraryId,
        protected ?int $subjectId = null,
        protected ?int $topicId = null,
        protected ?string $search = null,
        protected ?string $status = null,
        protected ?string $difficulty = null,
    ) {
    }

    public function query(): Builder
    {
        return ExamQuestion::query()
            ->where('library_id', $this->libraryId)
            ->when(
                $this->subjectId,
                fn (Builder $query) => $query->where('subject_id', $this->subjectId)
            )
            ->when(
                $this->topicId,
                fn (Builder $query) => $query->where('topic_id', $this->topicId)
            )
            ->when(
                $this->search,
                function (Builder $query) {
                    $query->where(function (Builder $q) {
                        $q->where(
                            'question_text',
                            'like',
                            '%' . $this->search . '%'
                        )->orWhere(
                            'explanation',
                            'like',
                            '%' . $this->search . '%'
                        );
                    });
                }
            )
            ->when(
                in_array($this->status, ['active', 'inactive'], true),
                fn (Builder $query) => $query->where(
                    'is_active',
                    $this->status === 'active'
                )
            )
            ->when(
                in_array($this->difficulty, ['Easy', 'Medium', 'Hard'], true),
                fn (Builder $query) => $query->where(
                    'difficulty',
                    $this->difficulty
                )
            )
            ->with([
                'subject',
                'topic',
                'options',
            ])
            ->orderBy('subject_id')
            ->orderBy('topic_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Subject',
            'Topic',
            'Question',
            'Question Type',
            'Option 1',
            'Option 2',
            'Option 3',
            'Option 4',
            'Correct Option',
            'Explanation',
            'Marks',
            'Negative Marks',
            'Difficulty',
            'Status',
        ];
    }

    public function map($question): array
    {
        $options = $question->options->values();

        $correctOption = $options->search(
            fn ($option) => (bool) $option->is_correct
        );

        return [
            $question->id,
            $question->subject?->name ?? '',
            $question->topic?->name ?? '',
            $question->question_text,
            $question->question_type,
            $options->get(0)?->option_text ?? '',
            $options->get(1)?->option_text ?? '',
            $options->get(2)?->option_text ?? '',
            $options->get(3)?->option_text ?? '',
            $correctOption !== false
                ? 'Option ' . ($correctOption + 1)
                : '',
            $question->explanation ?? '',
            $question->marks,
            $question->negative_marks,
            $question->difficulty ?? '',
            $question->is_active ? 'Active' : 'Inactive',
        ];
    }
}