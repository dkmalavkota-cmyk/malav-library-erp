<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'library_id',
        'student_id',
        'membership_id',
        'receipt_no',
        'amount',
        'payment_mode',
        'payment_date',
        'transaction_id',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}