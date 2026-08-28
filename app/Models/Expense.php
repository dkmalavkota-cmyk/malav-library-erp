<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'library_id',

        'expense_no',

        'title',

        'amount',

        'expense_date',

        'category',

        'description',

        'payment_mode',

        'created_by',

        'updated_by',

    ];


    protected $casts = [

        'amount' => 'decimal:2',

        'expense_date' => 'date',

    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function library()
    {
        return $this->belongsTo(Library::class);
    }


    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }


    public function updater()
    {
        return $this->belongsTo(
            User::class,
            'updated_by'
        );
    }
}