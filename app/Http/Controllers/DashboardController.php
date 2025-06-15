<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< Updated upstream
=======
use App\Models\Subject;
use App\Models\User;
use App\Models\Grade;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
>>>>>>> Stashed changes
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    {
        $user = Auth::user();
        $subjects = Subject::all();

        // Base query with relationships loaded
        $query = Grade::with(['student', 'subject']);

        // Student-specific filtering
        if ($user->role === 'student') {
            $query->where('student_id', $user->id);
        } else {
            // Teacher: Filter by student name (first or last)
            if ($request->filled('student_name')) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->student_name . '%')
                      ->orWhere('last_name', 'like', '%' . $request->student_name . '%');
                });
            }

            // Filter by subject
            if ($request->filled('subject_id')) {
                $query->where('subject_id', $request->subject_id);
            }
        }

        // Order and paginate results
        $grades = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard', compact('grades', 'subjects', 'user'));
=======
{
    $user = Auth::user();

    $query = Grade::with(['student', 'subject']);

    // Students see only their own grades
    if ($user->role === 'student') {
        $query->where('student_id', $user->id);
    } else {
        // Teachers can filter by student name
        if ($request->filled('student_name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student_name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->student_name . '%');
            });
        }
>>>>>>> Stashed changes
=======
{
    $user = Auth::user();

    $query = Grade::with(['student', 'subject']);

    // Students see only their own grades
    if ($user->role === 'student') {
        $query->where('student_id', $user->id);
    } else {
        // Teachers can filter by student name
        if ($request->filled('student_name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student_name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->student_name . '%');
            });
        }
>>>>>>> Stashed changes
=======
{
    $user = Auth::user();

    $query = Grade::with(['student', 'subject']);

    // Students see only their own grades
    if ($user->role === 'student') {
        $query->where('student_id', $user->id);
    } else {
        // Teachers can filter by student name
        if ($request->filled('student_name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student_name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->student_name . '%');
            });
        }
>>>>>>> Stashed changes
    }

    // Allow filtering by subject for both students and teachers
    if ($request->filled('subject_id')) {
        $query->where('subject_id', $request->subject_id);
    }

    $grades = $query->paginate(10);
    $subjects = Subject::all();

    return view('dashboard', compact('grades', 'subjects', 'user'));
}
}
