<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Subject</h1>

        <form method="POST" action="{{ route('subjects.update', $subject->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="subject_name">
                    Subject Name
                </label>
                <input
                    id="subject_name"
                    type="text"
                    name="subject_name"
                    value="{{ old('subject_name', $subject->subject_name) }}"
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                @error('subject_name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
