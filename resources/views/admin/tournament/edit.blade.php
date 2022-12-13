<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tournament') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 btn-lg">
            <form action="{{ route('admin.tournament.update', $tournament) }}" method="post">
                @method('PUT')
                @csrf
                <input type="text" name="name" field="name" placeholder="name" class="w-full mt-6" autocomplete="off"
                    value="{{ $tournament->name }}"></input>
                <input type="text" name="location" field="location" placeholder="location" class="w-full mt-6"
                    autocomplete="off" value="{{ $tournament->location }}"></input>

                <textarea name="description" rows="10" field="description" placeholder="Start typing here..." class="w-full mt-6">{{ $tournament->description }}</textarea>

                <input type="date" name="start_date"field="start_date" value="{{ $tournament->start_date }}" />




                <div class="form-group">
                    <label for="teams"> <strong> Teams</strong> <br> </label>
                    @foreach ($teams as $team)
                        <input type="checkbox", value="{{ $team->id }}" name="teams[]">
                        {{ $team->name }}
                    @endforeach
                </div>

                {{-- <!-- "
                        @if ($team->id == $tournament->team_id)
{{ 'checked' }}
@endif --}}

                <x-primary-button class="mt-6">Edit Tournament</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
