<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Vidējās atzīmes priekšmetos</h1>

        <a href="{{ route('grades.export.average.excel') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
            Eksportēt uz Excel
        </a>
        <a href="{{ route('grades.export.average.pdf') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
           Eksportēt uz PDF
        </a>

        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left">Priekšmets</th>
                    <th class="px-4 py-2 text-left">Vidējā atzīme</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($averages as $average)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $average->subject->subject_name ?? 'Unknown' }}</td>
                        <td class="px-4 py-2">{{ number_format($average->average_grade, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
