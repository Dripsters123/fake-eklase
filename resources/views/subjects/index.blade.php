<x-app-layout>
<h1>Subjects</h1>

<a href="{{ route('subjects.create') }}">+ Add Subject</a>

<table>
    <thead>
        <tr>
            <th>Subject Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{ $subject->subject_name }}</td>
                <td>
                    <a href="{{ route('subjects.edit', $subject->id) }}">Edit</a>
                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this subject?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>