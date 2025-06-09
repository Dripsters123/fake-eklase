<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            {{ isset($grade) ? 'Edit' : 'Add' }} Grade
        </h1>

        <form
            method="POST"
            action="{{ isset($grade) ? route('grades.update', $grade) : route('grades.store') }}"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        >
            @csrf
            @if(isset($grade)) @method('PUT') @endif

            <div class="mb-4">
                <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">
                    Student
                </label>
                <select
                    name="student_id"
                    id="student_id"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                >
                    @foreach($students as $student)
                        <option value="{{ $student->id }}"
                            {{ (isset($grade) && $grade->student_id == $student->id) ? 'selected' : '' }}>
                            {{ $student->name }} {{ $student->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="subject_id" class="block text-gray-700 text-sm font-bold mb-2">
                    Subject
                </label>
                <select
                    name="subject_id"
                    id="subject_id"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                >
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            {{ (isset($grade) && $grade->subject_id == $subject->id) ? 'selected' : '' }}>
                            {{ $subject->subject_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="grade" class="block text-gray-700 text-sm font-bold mb-2">
                    Grade
                </label>
                <input
                    type="number"
                    name="grade"
                    id="grade"
                    min="1"
                    max="10"
                    value="{{ old('grade', $grade->grade ?? '') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                >
                @error('grade')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">
                    Date
                </label>
                <input
                    type="datetime-local"
                    name="date"
                    id="date"
                    value="{{ isset($grade) ? \Carbon\Carbon::parse($grade->date)->format('Y-m-d\TH:i') : '' }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                >
                @error('date')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    {{ isset($grade) ? 'Update' : 'Submit' }}
                </button>
                <a href="{{ route('grades.index') }}" class="text-gray-600 hover:underline text-sm">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
