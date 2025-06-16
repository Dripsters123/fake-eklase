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
        'subject_name' => [
            'required',
            function ($attribute, $value, $fail) {
                // Normalize: trim, lowercase, collapse multiple spaces
                $normalized = preg_replace('/\s+/', ' ', strtolower(trim($value)));

                // Check if a similar subject already exists
                $exists = Subject::all()->contains(function ($subject) use ($normalized) {
                    $existingNormalized = preg_replace('/\s+/', ' ', strtolower(trim($subject->subject_name)));
                    return $existingNormalized === $normalized;
                });

                if ($exists) {
                    $fail('Tāds priekšmets jau eksistē.');
                }
            }
        ]
    ]);

    Subject::create([
        'subject_name' => preg_replace('/\s+/', ' ', trim($request->subject_name)), // optional: clean name
    ]);

    return redirect('/subjects')->with('success', 'Priekšmets pievienots.');
}


    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
    
        $request->validate([
            'subject_name' => [
                'required',
                function ($attribute, $value, $fail) use ($id) {
                    $normalized = preg_replace('/\s+/', ' ', strtolower(trim($value)));
    
                    $exists = Subject::where('id', '!=', $id)->get()->contains(function ($subject) use ($normalized) {
                        $existingNormalized = preg_replace('/\s+/', ' ', strtolower(trim($subject->subject_name)));
                        return $existingNormalized === $normalized;
                    });
    
                    if ($exists) {
                        $fail('Tāds priekšmets jau eksistē.');
                    }
                }
            ]
        ]);
    
        $subject->update([
            'subject_name' => preg_replace('/\s+/', ' ', trim($request->subject_name)),
        ]);
    
        return redirect('/subjects')->with('success', 'Subject updated.');
    }
    

    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect('/subjects')->with('success', 'Subject deleted.');
    }
}
