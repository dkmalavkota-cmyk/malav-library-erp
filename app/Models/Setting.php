<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'library_id',
        'key',
        'value',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}