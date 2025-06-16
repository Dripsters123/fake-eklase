<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Atzīmju saraksts</h1>

        

        <div class="container mx-auto p-4">

            @if ($user->role === 'teacher')
                {{-- Teacher filter form --}}
                <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex flex-wrap gap-4 items-end">
                    <div>
                        <label for="student_name" class="block font-semibold mb-1">Meklēt pēc vārda/uzvārda</label>
                        <input type="text" name="student_name" id="student_name" value="{{ request('student_name') }}"
                            class="border rounded px-3 py-1" placeholder="Skolēna vārds vai uzvārds">
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
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrēt</button>
                    </div>
                </form>
            @endif

            @if ($user->role === 'student')
                {{-- Student filter form --}}
                <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex flex-wrap gap-4 items-end">
                    <div>
                        <label for="subject_id" class="block font-semibold mb-1">Filtrēt pēc priekšmeta</label>
                        <select name="subject_id" id="subject_id" class="border rounded px-3 py-1">
                            <option value="">Visi priekšmeti</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" @selected(request('subject_id') == $subject->id)>
                                    {{ $subject->subject_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrēt</button>
                    </div>
                </form>

                {{-- Export buttons for students --}}
                <div class="mb-6 flex gap-4">
                    <a href="{{ route('grades.export.excel', request()->only('subject_id')) }}"
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Eksportēt uz Excel
                    </a>
                    <a href="{{ route('grades.export.pdf', request()->only('subject_id')) }}"
                       class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Eksportēt uz PDF
                    </a>
                </div>
            @endif

            {{-- Grades table --}}
            <table class="min-w-full bg-white border rounded shadow">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2 text-left">Studenti</th>
                        <th class="px-4 py-2 text-left">Mācību priekšmeti</th>
                        <th class="px-4 py-2 text-left">Atzīmes</th>
                        @if ($user->role === 'teacher')
                            <th class="px-4 py-2 text-left">Funkcijas</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grades as $grade)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ $grade->student?->name }} {{ $grade->student?->last_name }}</td>
                            <td class="px-6 py-4">{{ $grade->subject?->subject_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $grade->grade }}</td>
                            @if ($user->role === 'teacher')
                                <td class="px-6 py-4 flex space-x-4">
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
                            <td colspan="{{ $user->role === 'teacher' ? 4 : 3 }}" class="px-6 py-4 text-center text-gray-500">Nav atrastas atzīmes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $grades->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
