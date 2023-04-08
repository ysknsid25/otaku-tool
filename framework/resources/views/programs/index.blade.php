<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('A&G Programs') }}
        </h2>
    </x-slot>


    <div class="py-6">
        <form method="post" action="{{ route('programs.show') }}" class="mb-6">
            @csrf
            @method('post')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <select name="targetDay"
                                class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                @foreach ($weekDays as $val => $weekday)
                                    <option value="{{ $val }}" {{ $val == $targetDay ? 'selected' : '' }}>
                                        {{ $weekday }}</option>
                                @endforeach
                            </select>
                            <div class="flex flex-col ml-4">
                                <x-primary-button>{{ __('Search') }}</x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @foreach ($programs as $program)
            <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <input id="default-checkbox-{{ $program->getId() }}" type="checkbox" name="program[]"
                                value="{{ $program->getId() }}"
                                class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                            <label for="default-checkbox-{{ $program->getId() }}">
                                <div class="flex flex-col ml-4">
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $program->getPrgoramNm() }}
                                    </div>
                                    <div class="text-sm">{{ $program->getPersonalities() }}</div>
                                    <div class="text-sm">{{ $program->getOnAirTime() }}</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
