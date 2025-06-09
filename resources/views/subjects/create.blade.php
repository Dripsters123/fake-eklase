<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Create Subject</h1>

        <form method="POST" action="{{ route('subjects.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="subject_name" class="block text-gray-700 text-sm font-bold mb-2">
                    Subject Name
                </label>
                <input
                    type="text"
                    name="subject_name"
                    id="subject_name"
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ old('subject_name') }}"
                >
                @error('subject_name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button
                    type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Add
                </button>
                <a href="{{ route('subjects.index') }}" class="text-gray-600 hover:underline text-sm">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
