<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Atzīmju saraksts</h1>

        @if ($user->role === 'teacher')
            <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex flex-wrap gap-4 items-end">
                <div>
                    <label for="student_name" class="block font-semibold mb-1">Meklēt pēc vārda/uzvārda</label>
                    <input type="text" name="student_name" id="student_name" value="{{ request('student_name') }}"
                        class="border rounded px-3 py-1" placeholder="Skolēna vārds vai uzvārds">
                </div>

                <div>
                    <label for="subject_id" class="block font-semibold mb-1">Priekšmets</label>
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
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrēt</button>
                </div>
            </form>
        @endif
        @if ($user->role === 'student')
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
@endif
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
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $grade->student?->name }} {{ $grade->student?->last_name }}</td>
                        <td class="px-4 py-2">{{ $grade->subject->subject_name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $grade->grade }}</td>
                        @if ($user->role === 'teacher')
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('grades.edit', $grade) }}" class="text-blue-600 hover:underline">Labot</a>
                                <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Vai tiešām dzēst šo atzīmi?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Dzēst</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $user->role === 'teacher' ? '4' : '3' }}"
                            class="px-4 py-2 text-center">Atzīmes nav atrastas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $grades->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
