<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tournament') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex">
            <p class="opacity-70">
                <strong>Created: </strong> {{ $tournament->created_at->diffForHumans() }}
            </p>
            <p class="opacity-70 ml-8">
                <strong>Updated at: </strong> {{ $tournament->updated_at->diffForHumans() }}
            </p>
            {{-- //Impossible Content --}}
            {{-- <a href="{{ route('user.tournament.edit', $tournament) }}" class="btn-link ml-auto">Edit tournament</a>
                <form action="{{ route('user.tournament.destroy', $tournament) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this tournament?')">Delete Note</button> --}}
        </div>
        <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
            <h2 class="font-bold text-4xl">
                {{ $tournament->name }}
            </h2>
            <h2 class="font-bold text-4xl">
                {{ $tournament->location }}
            </h2>
            <h2 class="font-bold text-4xl">
                {{ $tournament->description }}
            </h2>
            <h2 class="font-bold text-4xl">
                {{ $tournament->start_date }}
            </h2>
            <p class="mt-6 whitespace-">{{ $tournament->text }}</p>
            <div style="border-bottom: 5px solid red">
                <strong>
                    <h1>Players</h1>
                </strong>
            </div>
            <ul>
                @forelse ($players as $player)
                    <li>{{ $player->name }}</li>
                @empty
                    <p>You have no players yet.</p>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
