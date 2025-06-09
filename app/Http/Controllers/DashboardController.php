<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
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
    }
}
