<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MembershipPlan::truncate();

        $plans = [
            ['Silver', 'SIL', 1],
            ['Gold', 'GLD', 1],
            ['Platinum', 'PLT', 1],

            ['Silver', 'SIL', 3],
            ['Gold', 'GLD', 3],
            ['Platinum', 'PLT', 3],

            ['Silver', 'SIL', 6],
            ['Gold', 'GLD', 6],
            ['Platinum', 'PLT', 6],

            ['Silver', 'SIL', 12],
            ['Gold', 'GLD', 12],
            ['Platinum', 'PLT', 12],
        ];

        foreach ($plans as $plan) {

            MembershipPlan::create([
                'name'              => $plan[0],
                'code'              => $plan[1] . '-' . $plan[2],
                'duration_months'   => $plan[2],
                'price'             => 0,
                'description'       => $plan[0] . ' Membership - ' . $plan[2] . ' Month',
                'is_active'         => true,
            ]);
        }
    }
}