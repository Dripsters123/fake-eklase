<x-app-layout>
<h1>Grades</h1>
<a href="{{ route('grades.create') }}">Add Grade</a>

<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Subject</th>
            <th>Grade</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grades as $grade)
            <tr>
                <td>{{ $grade->student->name }} {{ $grade->student->last_name }}</td>
                <td>{{ $grade->subject->subject_name }}</td>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->date }}</td>
                <td>
                    <a href="{{ route('grades.edit', $grade) }}">Edit</a>
                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>
