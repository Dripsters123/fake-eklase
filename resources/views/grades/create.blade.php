<x-app-layout>
<h1>{{ isset($grade) ? 'Edit' : 'Add' }} Grade</h1>

<form method="POST" action="{{ isset($grade) ? route('grades.update', $grade) : route('grades.store') }}">
    @csrf
    @if(isset($grade)) @method('PUT') @endif

    <label>Student</label>
    <select name="student_id">
        @foreach($students as $student)
            <option value="{{ $student->id }}" {{ (isset($grade) && $grade->student_id == $student->id) ? 'selected' : '' }}>
                {{ $student->name }} {{ $student->last_name }}
            </option>
        @endforeach
    </select>

    <label>Subject</label>
    <select name="subject_id">
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ (isset($grade) && $grade->subject_id == $subject->id) ? 'selected' : '' }}>
                {{ $subject->subject_name }}
            </option>
        @endforeach
    </select>

    <label>Grade</label>
    <input type="number" name="grade" min="1" max="10" value="{{ $grade->grade ?? '' }}">

    <label>Date</label>
    <input type="datetime-local" name="date" value="{{ isset($grade) ? \Carbon\Carbon::parse($grade->date)->format('Y-m-d\TH:i') : '' }}">

    <button type="submit">{{ isset($grade) ? 'Update' : 'Submit' }}</button>
</form>
</x-app-layout>
