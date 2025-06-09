<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Atzīmju saraksts</h1>

        <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex flex-col sm:flex-row sm:items-end sm:space-x-4 space-y-4 sm:space-y-0">
            <div class="flex flex-col">
                <label for="student_name" class="block font-semibold text-gray-700">Meklēt pēc vārda/uzvārda</label>
                <input
                    type="text"
                    name="student_name"
                    id="student_name"
                    value="{{ request('student_name') }}"
                    class="border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Skolēna vārds vai uzvārds"
                >
            </div>

            <div class="flex flex-col">
                <label for="subject_id" class="block font-semibold text-gray-700">Priekšmets</label>
                <select
                    name="subject_id"
                    id="subject_id"
                    class="border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Visi priekšmeti</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected(request('subject_id') == $subject->id)>
                            {{ $subject->subject_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Filtrēt
                </button>
            </div>
        </form>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700 text-sm uppercase">
                        <th class="px-6 py-3 border-b">Studenti</th>
                        <th class="px-6 py-3 border-b">Priekšmeti</th>
                        <th class="px-6 py-3 border-b">Atzīmes</th>
                        @if ($user->role === 'teacher')
                            <th class="px-6 py-3 border-b">Funkcijas</th>
                        @endif
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
                            @if ($user->role === 'teacher')
                                <td class="px-6 py-4 border-b flex space-x-4">
                                    <a href="{{ route('grades.edit', $grade) }}" class="text-blue-600 hover:underline">Labot</a>
                                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" onsubmit="return confirm('Vai tiešām dzēst šo atzīmi?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Dzēst</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $user->role === 'teacher' ? '4' : '3' }}" class="px-6 py-4 text-center text-gray-500">Nav atrastas atzīmes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $grades->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
