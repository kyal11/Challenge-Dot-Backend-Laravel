<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class grades extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $fillable = [
        'id',
        'student_id',
        'course_id',
        'grade'
    ];
    public function student(): BelongsTo {
        return $this->belongsTo(students::class, 'student_id');
    }

    public function course(): BelongsTo {
        return $this->belongsTo(courses::class, 'corse_id');
    }
}
