<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Grades</h1>
            <a href="{{ route('grades.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
                + Add Grade
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700 text-sm uppercase">
                        <th class="px-6 py-3 border-b">Student</th>
                        <th class="px-6 py-3 border-b">Subject</th>
                        <th class="px-6 py-3 border-b">Grade</th>
                        <th class="px-6 py-3 border-b">Date</th>
                        <th class="px-6 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grades as $grade)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                {{ $grade->student->name }} {{ $grade->student->last_name }}
                            </td>
                            <td class="px-6 py-4 border-b">{{ $grade->subject->subject_name }}</td>
                            <td class="px-6 py-4 border-b">{{ $grade->grade }}</td>
                            <td class="px-6 py-4 border-b">{{ $grade->date }}</td>
                            <td class="px-6 py-4 border-b flex space-x-4">
                                <a href="{{ route('grades.edit', $grade) }}" class="text-blue-600 hover:underline">Edit</a>

                                <form action="{{ route('grades.destroy', $grade) }}" method="POST" onsubmit="return confirm('Delete this grade?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-gray-500 text-center">No grades available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
