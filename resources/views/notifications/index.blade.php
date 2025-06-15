<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Paziņojumi</h1>

        <ul class="space-y-4">
            @forelse ($notifications as $notification)
                <li class="border rounded p-4 bg-gray-50 relative">
                    <div>
                        <strong>{{ ucfirst($notification->data['action']) }}</strong> atzīme priekšmetā 
                        <strong>{{ $notification->data['subject'] }}</strong>: 
                        <strong>{{ $notification->data['grade'] }}</strong><br>
                        Skolotājs: {{ $notification->data['teacher'] }}
                    </div>
                    <small class="text-gray-500">{{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}</small>

                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">Dzēst</button>
                    </form>
                </li>
            @empty
                <li>Nav paziņojumu.</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
