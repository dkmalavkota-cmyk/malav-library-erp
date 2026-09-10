<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Seed the application's plan master data.
     */
    public function run(): void
    {
        Plan::updateOrCreate(
            ['name' => 'Free Trial'],
            [
                'monthly_price' => 0,
                'yearly_price' => 0,
                'student_limit' => null,

                'exam_access' => true,
                'question_bank_access' => true,
                'current_affairs_access' => true,
                'major_test_access' => true,
                'assigned_test_access' => true,
                'public_exam_access' => true,
                'advanced_reports_access' => true,

                'is_active' => true,
                'description' => '5-day free trial with full ERP and examination access.',
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Starter'],
            [
                'monthly_price' => 799,
                'yearly_price' => 7000,
                'student_limit' => 100,

                'exam_access' => false,
                'question_bank_access' => false,
                'current_affairs_access' => false,
                'major_test_access' => false,
                'assigned_test_access' => false,
                'public_exam_access' => false,
                'advanced_reports_access' => false,

                'is_active' => true,
                'description' => 'Essential library ERP plan for up to 100 students.',
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Professional'],
            [
                'monthly_price' => 1499,
                'yearly_price' => 14900,
                'student_limit' => 120,

                'exam_access' => true,
                'question_bank_access' => true,
                'current_affairs_access' => true,
                'major_test_access' => true,
                'assigned_test_access' => true,
                'public_exam_access' => false,
                'advanced_reports_access' => false,

                'is_active' => true,
                'description' => 'ERP plus online examination features for up to 120 students.',
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Premium'],
            [
                'monthly_price' => 2499,
                'yearly_price' => 21500,
                'student_limit' => 360,

                'exam_access' => true,
                'question_bank_access' => true,
                'current_affairs_access' => true,
                'major_test_access' => true,
                'assigned_test_access' => true,
                'public_exam_access' => true,
                'advanced_reports_access' => true,

                'is_active' => true,
                'description' => 'Complete ERP and advanced online examination solution for up to 360 students.',
            ]
        );
    }
}