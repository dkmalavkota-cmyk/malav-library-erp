<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Plans that include this service.
     */
    public function membershipPlans(): BelongsToMany
    {
        return $this->belongsToMany(
            MembershipPlan::class,
            'membership_plan_services'
        );
    }
}