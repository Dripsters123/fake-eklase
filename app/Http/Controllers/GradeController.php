<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\GradeChangedNotification;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\GradesExport;
use App\Exports\AverageGradesExport;

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
            'date' => 'required|date|before_or_equal:today|after_or_equal:today',
        ]);

        $grade = Grade::create($request->all());

        $student = $grade->student;
        $teacher = auth()->user();
        $action = 'created';

        $student->notify(new GradeChangedNotification($action, $grade, $teacher));

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
    
        // Manually validate date equals today (ignore time)
        $inputDate = \Carbon\Carbon::parse($request->date)->toDateString();
        if ($inputDate !== now()->toDateString()) {
            return back()->withErrors(['date' => 'The date must be today only.'])->withInput();
        }
    
        $grade->update($request->all());
    
        $student = $grade->student;
        $teacher = auth()->user();
        $action = 'updated';
    
        $student->notify(new GradeChangedNotification($action, $grade, $teacher));
    
        return redirect()->route('grades.index')->with('success', 'Grade updated');
    }
    

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $student = $grade->student;
        $teacher = auth()->user();

        $grade->delete();

        $student->notify(new GradeChangedNotification('deleted', $grade, $teacher));

        return redirect()->route('grades.index')->with('success', 'Grade deleted');
    }

    public function exportExcel(Request $request)
    {
        $user = Auth::user();

        $query = Grade::with('subject')->where('student_id', $user->id);

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $grades = $query->get();

        return Excel::download(new GradesExport($grades), 'atzimes.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();

        $query = Grade::with('subject')->where('student_id', $user->id);

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $grades = $query->get();

        $pdf = Pdf::loadView('exports.grades_pdf', compact('grades'));

        return $pdf->download('atzimes.pdf');
    }

    public function averageGrades()
    {
        $user = auth()->user();
        if ($user->role !== 'teacher') {
            abort(403, 'Unauthorized');
        }

        $averages = Grade::select('subject_id')
            ->with('subject')
            ->groupBy('subject_id')
            ->selectRaw('subject_id, AVG(grade) as average_grade')
            ->get();

        return view('grades.average', compact('averages'));
    }

    public function exportAverageExcel()
    {
        $user = Auth::user();
        if ($user->role !== 'teacher') {
            abort(403, 'Unauthorized');
        }

        $averages = Grade::select('subject_id')
            ->with('subject')
            ->groupBy('subject_id')
            ->selectRaw('subject_id, AVG(grade) as average_grade')
            ->get();

        return Excel::download(new AverageGradesExport($averages), 'average_grades.xlsx');
    }

    public function exportAveragePdf()
    {
        $user = Auth::user();
        if ($user->role !== 'teacher') {
            abort(403, 'Unauthorized');
        }

        $averages = Grade::select('subject_id')
            ->with('subject')
            ->groupBy('subject_id')
            ->selectRaw('subject_id, AVG(grade) as average_grade')
            ->get();

        $pdf = Pdf::loadView('grades.average_pdf', compact('averages'));

        return $pdf->download('average_grades.pdf');
    }
}
