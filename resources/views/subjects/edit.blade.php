<x-app-layout>
<h1>Edit Subject</h1>

<form method="POST" action="{{ route('subjects.update', $subject->id) }}">
    @csrf @method('PUT')
    <label>Subject Name:</label>
    <input type="text" name="subject_name" value="{{ $subject->subject_name }}" required>
    <button type="submit">Update</button>
</form>
</x-app-layout>
