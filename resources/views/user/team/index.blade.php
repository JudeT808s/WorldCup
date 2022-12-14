<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- route links to the team.create.blade.php page --}}
            {{-- {{ $teams }} --}}
            @forelse ($teams as $team)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        {{-- title is hyperlinked to show page and if clicked will add id to end of link and display team --}}
                        <a href="{{ route('user.team.show', $team->id) }}">{{ $team->name }}</a>
                    </h2>
                    <span class="block mt-4 text-sm opacity-70">{{ $team->updated_at->diffForHumans() }}</span>
                </div>
                {{-- If no teams are found in the db prints no teams yet --}}
            @empty
                <p>You have no teams yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
