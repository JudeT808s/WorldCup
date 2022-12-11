<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 btn-lg">
            <form action="{{ route('admin.team.store') }}" method="post">
                @csrf
                <x-text-input type="text" name="name" field="name" placeholder="name" class="w-full"
                    autocomplete="off" :value="@old('name')"></x-text-input>
                <div class="form-group">
                    <label for="sponsor"> <strong> Sponsors </strong> <br> </label>
                    @foreach ($sponsors as $sponsor)
                        <input type="checkbox", value="{{ $sponsor->id }}" name="sponsors[]">{{ $sponsor->name }}
                    @endforeach
                    {{ $sponsor->id }}
                </div>
                <x-primary-button class="mt-6">Save Team</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
