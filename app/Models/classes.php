<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class classes extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'classes_subject', 'classes_id', 'subject_id')
        ->withPivot('status');
    }
}
