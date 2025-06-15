<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'grade',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
