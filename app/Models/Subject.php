<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(classes::class, 'classes_subject','subject_id', 'classes_id')
        ->withPivot('status');
    }
}
