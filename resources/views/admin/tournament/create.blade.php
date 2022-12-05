<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tournament') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 btn-lg">
            <form action="{{ route('admin.tournament.store') }}" method="post">
                @csrf
                <x-text-input type="text" name="name" field="name" placeholder="name" class="w-full"
                    autocomplete="off" :value="@old('name')"></x-text-input>
                <x-text-input type="text" name="location" field="location" placeholder="location" class="w-full"
                    autocomplete="off" :value="@old('location')"></x-text-input>

                <x-textarea name="description" rows="10" field="description" placeholder="Start typing here..."
                    class="w-full mt-6" :value="@old('description')"></x-textarea>

                <input type="date" name="start_date"field="start_date" :value="@old('start_date')" />


                <div class="form-group">
                    <label for="teams">Teams</label>
                    <select name="team_id">
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <x-primary-button class="mt-6">Save Tournament</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
