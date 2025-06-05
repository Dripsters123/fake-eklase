<x-app-layout>
<h1>Edit Student</h1>

<form method="POST" action="{{ route('students.update', $student->id) }}">
    @csrf @method('PUT')
    <label>First Name:</label>
    <input type="text" name="name" value="{{ $student->name }}" required><br>
    <label>Last Name:</label>
    <input type="text" name="last_name" value="{{ $student->last_name }}" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="{{ $student->email }}" required><br>
    <button type="submit">Update</button>
</form>
</x-app-layout>
