<x-app-layout>
<h1>Add Student</h1>

<form method="POST" action="{{ route('students.store') }}">
    @csrf
    <label>First Name:</label>
    <input type="text" name="name" required><br>
    <label>Last Name:</label>
    <input type="text" name="last_name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Create</button>
</form>
</x-app-layout>
