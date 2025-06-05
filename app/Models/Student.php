<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'users'; // use users table

    // Automatically scope queries to only students
    protected static function booted()
    {
        static::addGlobalScope('student', function (Builder $builder) {
            $builder->where('role', 'student');
        });
    }

    // Add any student-specific methods here
}
