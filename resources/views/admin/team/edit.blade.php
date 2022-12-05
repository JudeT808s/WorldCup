<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 btn-lg">
            <form action="{{ route('admin.team.update', $team) }}" method="post">
                @method('PUT')
                @csrf
                <input type="text" name="name" field="name" placeholder="name" class="w-full mt-6" autocomplete="off"
                    value="{{ $team->name }}"></input>
                <x-primary-button class="mt-6">Edit Team</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
