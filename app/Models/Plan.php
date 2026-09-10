<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'monthly_price',
        'yearly_price',
        'student_limit',

        // Core Library ERP
        'student_management_access',
        'membership_access',
        'seat_management_access',
        'attendance_access',
        'payment_access',
        'expense_access',
        'id_card_access',
        'reports_access',

        // Online Examination
        'exam_access',
        'question_bank_access',
        'current_affairs_access',
        'major_test_access',
        'assigned_test_access',
        'public_exam_access',
        'advanced_reports_access',

        'is_active',
        'is_public',
        'description',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'student_limit' => 'integer',

        // Core Library ERP
        'student_management_access' => 'boolean',
        'membership_access' => 'boolean',
        'seat_management_access' => 'boolean',
        'attendance_access' => 'boolean',
        'payment_access' => 'boolean',
        'expense_access' => 'boolean',
        'id_card_access' => 'boolean',
        'reports_access' => 'boolean',

        // Online Examination
        'exam_access' => 'boolean',
        'question_bank_access' => 'boolean',
        'current_affairs_access' => 'boolean',
        'major_test_access' => 'boolean',
        'assigned_test_access' => 'boolean',
        'public_exam_access' => 'boolean',
        'advanced_reports_access' => 'boolean',

        'is_active' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function hasStudentLimit(): bool
    {
        return $this->student_limit !== null;
    }

    public function allowsStudents(int $currentStudentCount): bool
    {
        if (!$this->hasStudentLimit()) {
            return true;
        }

        return $currentStudentCount < $this->student_limit;
    }
}