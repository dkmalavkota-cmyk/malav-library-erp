<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'library_id',
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
     * Service belongs to a Library.
     */
    public function library()
    {
        return $this->belongsTo(Library::class);
    }

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