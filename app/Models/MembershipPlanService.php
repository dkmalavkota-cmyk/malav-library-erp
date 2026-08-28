<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlanService extends Model
{
    protected $fillable = [
        'library_id',
        'membership_plan_id',
        'service_id',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function membershipPlan()
    {
        return $this->belongsTo(
            MembershipPlan::class,
            'membership_plan_id'
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'service_id'
        );
    }
}