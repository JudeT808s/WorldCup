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
                    <label for="sponsor">sponsor</label>
                    <select name="sponsor_id">
                        @foreach ($sponsors as $sponsor)
                            <option value="{{ $sponsor->id }}"
                                {{ old('sponsor_id') == $sponsor->id ? 'selected' : '' }}>
                                {{ $sponsor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-primary-button class="mt-6">Save Team</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
