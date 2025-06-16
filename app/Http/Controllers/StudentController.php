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
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
    
        // Check for duplicate name + last_name
        $exists = User::where('role', 'student')
            ->whereRaw('LOWER(name) = ?', [strtolower($request->name)])
            ->whereRaw('LOWER(last_name) = ?', [strtolower($request->last_name)])
            ->exists();
    
        if ($exists) {
            return back()->withErrors(['name' => 'A student with the same full name already exists.'])->withInput();
        }
    
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
    $student = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $student->id,
    ]);

    $exists = User::where('id', '!=', $student->id)
        ->where('role', 'student')
        ->whereRaw('LOWER(name) = ?', [strtolower($request->name)])
        ->whereRaw('LOWER(last_name) = ?', [strtolower($request->last_name)])
        ->exists();

    if ($exists) {
        return back()->withErrors(['name' => 'Another student with the same full name already exists.'])->withInput();
    }

    $student->update($request->all());

    return redirect('/students')->with('success', 'Student updated.');
}


    public function destroy($id)
    {
        Student::destroy($id);
        return redirect('/students')->with('success', 'Student deleted.');
    }
}

