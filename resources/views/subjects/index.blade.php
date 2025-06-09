<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Subjects</h1>
            <a href="{{ route('subjects.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
                + Add Subject
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700 text-sm uppercase">
                        <th class="px-6 py-3 border-b">Subject Name</th>
                        <th class="px-6 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">{{ $subject->subject_name }}</td>
                            <td class="px-6 py-4 border-b flex space-x-4">
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Delete this subject?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-gray-500 text-center">No subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
