<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $subjects = Subject::all();

        $query = Grade::with(['student', 'subject']);

        if ($user->role === 'student') {
            $query->where('student_id', $user->id);
        } else {
            if ($request->filled('student_name')) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->student_name . '%')
                      ->orWhere('last_name', 'like', '%' . $request->student_name . '%');
                });
            }

            if ($request->filled('subject_id')) {
                $query->where('subject_id', $request->subject_id);
            }
        }

        $grades = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard', compact('grades', 'subjects', 'user'));
    }
}
