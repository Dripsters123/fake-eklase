<x-app-layout>
<h1>Create Subject</h1>

<form method="POST" action="{{ route('subjects.store') }}">
    @csrf
    <label>Subject Name:</label>
    <input type="text" name="subject_name" required>
    <button type="submit">Add</button>
</form>
</x-app-layout>
