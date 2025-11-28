<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'label',
        'name',
        'type',
        'placeholder',
        'required',
        'active',
        'order',
        'options'
    ];

    protected $casts = [
        'required' => 'boolean',
        'active' => 'boolean',
    ];
}
