<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\User;
use App\Models\Grade;

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

        $query = Grade::with(['student', 'subject']);

        // Ja lietotājs ir students, rādīt tikai viņa atzīmes
        if ($user->role === 'student') {
            $query->where('student_id', $user->id);
        } else {
            // Meklēšana pēc skolēna vārda vai uzvārda
            if ($request->filled('student_name')) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->student_name . '%')
                      ->orWhere('last_name', 'like', '%' . $request->student_name . '%');
                });
            }

            // Filtrē pēc priekšmeta
            if ($request->filled('subject_id')) {
                $query->where('subject_id', $request->subject_id);
            }
        }

        $grades = $query->paginate(10);
        $subjects = Subject::all();

        return view('dashboard', compact('grades', 'subjects', 'user'));
    }
}

    

