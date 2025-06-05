<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\User;
class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required'
        ]);

        Subject::create($request->all());
        return redirect('/subjects')->with('success', 'Subject added.');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        return redirect('/subjects')->with('success', 'Subject updated.');
    }

    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect('/subjects')->with('success', 'Subject deleted.');
    }
}
