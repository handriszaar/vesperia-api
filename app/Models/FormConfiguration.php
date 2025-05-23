<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormConfiguration extends Model
{
    protected  $guarded = [];

    protected $casts = [
        'payloads' => 'array',
        'is_active' => 'boolean'
    ];

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class, 'form_id', 'form_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
