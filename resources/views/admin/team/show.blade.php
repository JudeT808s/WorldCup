<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex">
            <p class="opacity-70">
                <strong>Created: </strong> {{ $team->created_at->diffForHumans() }}
            </p>
            <p class="opacity-70 ml-8">
                <strong>Updated at: </strong> {{ $team->updated_at->diffForHumans() }}
            </p>
            <a href="{{ route('admin.team.edit', $team) }}" class="btn-link ml-auto">Edit team</a>
            <form action="{{ route('admin.team.destroy', $team) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger ml-4"
                    onclick="return confirm('Are you sure you wish to delete this team?')">Delete Note</button>
        </div>
        <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
            <tr>
                <td rowspan="6">
                    <img src="{{ asset('storage/images/' . $team->team_image) }}" width="150" />
                </td>
            </tr>
            <h2 class="font-bold text-4xl">
                {{ $team->name }}
            </h2>
            <p class="mt-6 whitespace-">{{ $team->text }}</p>
            <tr>
                <h2 class="font-bold p-1 text-red-500">Sponsor </h2>
                <td>{{ $team->sponsor->name }}</td>
            </tr class="border-b">
            <h2 class="font-bold p-1 text-red-500">Players </h2>
            {{-- takes player array and explodes just the name, removing square brackets and quote marks into list --}}
            @foreach ($players as $player)
                @php
                    $values = explode(' ', $player->name);
                @endphp
                <ul>
                    <li>{{ $player->name }}</li>
                </ul>
                {{-- <p>
                        @if (in_array("$player->name", $values))
                            {{ $players->name }}
                        @endif
                    </p> --}}
            @endforeach
            {{-- <td>{{ $team->player_name }}</td> --}}
            {{-- <td>{{ $team->players->get }}</td> --}}
            </tr>
        </div>
        <ul>

        </ul>
    </div>
    </div>
</x-app-layout>
