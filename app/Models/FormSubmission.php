<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $guarded = [];
    protected $casts = [
        'submission_data' => 'array',
        'submitted_at' => 'datetime'
    ];

    public function formConfiguration()
    {
        return $this->belongsTo(FormConfiguration::class, 'form_id', 'form_id');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
