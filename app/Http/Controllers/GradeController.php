<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:1|max:10',
            'date' => 'required|date',
        ]);

        Grade::create($request->all());
        return redirect()->route('grades.index')->with('success', 'Grade added');
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);

        $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:1|max:10',
            'date' => 'required|date',
        ]);

        $grade->update($request->all());
        return redirect()->route('grades.index')->with('success', 'Grade updated');
    }

    public function destroy($id)
    {
        Grade::destroy($id);
        return redirect()->route('grades.index')->with('success', 'Grade deleted');
    }
}


