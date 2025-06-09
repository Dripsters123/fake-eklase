<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'student',
    ]);

    return redirect()->route('students.index')->with('success', 'Student added successfully.');
}

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect('/students')->with('success', 'Student updated.');
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect('/students')->with('success', 'Student deleted.');
    }
}

