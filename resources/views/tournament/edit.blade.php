<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tournament') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('tournament.update', $tournament) }}" method="post">
                @method('PUT')
                    @csrf
                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('name', $tournament->name)"></x-text-input>
                    <x-text-input
                        type="text"
                        name="location"
                        field="location"
                        placeholder="location"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('location', $tournament->location)"></x-text-input>

                    <x-textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="Start typing here..."
                        class="w-full mt-6"
                        :value="@old('description', $tournament->description)"></x-textarea>

                        <input type="date" name="start_date"field="start_date"  
                        value="{{$tournament->start_date}}" />
                        
                    <x-primary-button class="mt-6">Edit Tournament</x-primary-button>
                </form>
        </div>
    </div>
</x-app-layout>