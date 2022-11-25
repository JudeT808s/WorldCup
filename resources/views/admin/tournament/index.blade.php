<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tournament') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- route links to the tournament.create.blade.php page --}}
            <a href="{{ route('admin.tournament.create') }}" class="btn-link btn-lg mb-2">Add a Tournament</a>
            <!-- {{ $tournaments }} -->
            <!-- {{ $tournaments }} -->
            @forelse ($tournaments as $tournament)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        {{-- title is hyperlinked to show page and if clicked will add id to end of link and display tournament --}}
                        <a href="{{ route('admin.tournament.show', $tournament->id) }}">{{ $tournament->name }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ $tournament->location }}
                    </p>
                    <p class="mt-2">
                        {{ $tournament->start_date }}
                    </p>
                    <span class="block mt-4 text-sm opacity-70">{{ $tournament->updated_at->diffForHumans() }}</span>
                </div>
                {{-- If no tournaments are found in the db prints no tournaments yet --}}
            @empty
                <p>You have no tournaments yet.</p>
            @endforelse
            {{ $tournaments->links() }}
        </div>
    </div>
</x-app-layout>
