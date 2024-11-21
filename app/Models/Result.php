<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function subject() : BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
