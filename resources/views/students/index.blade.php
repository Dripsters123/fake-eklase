<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Students</h1>
            <a href="{{ route('students.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
                + Add Student
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700 text-sm uppercase">
                        <th class="px-6 py-3 border-b">Name</th>
                        <th class="px-6 py-3 border-b">Email</th>
                        <th class="px-6 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                {{ $student->name }} {{ $student->last_name }}
                            </td>
                            <td class="px-6 py-4 border-b">{{ $student->email }}</td>
                            <td class="px-6 py-4 border-b flex space-x-4">
                                <a href="{{ route('students.edit', $student->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>

                                <form action="{{ route('students.destroy', $student->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this student?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-gray-500 text-center">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
