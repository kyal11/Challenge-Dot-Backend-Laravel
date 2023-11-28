<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'name',
        'nim',
        'birth_date',
        'address',
        'gender',
        'major'
    ];
    public function grade(): HasMany {
        return $this->hasMany(grades::class, 'student_id');
    }
}
