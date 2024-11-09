<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Department Information') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Your department information.") }}
                    </p>
                </header>

                @if($department->id)
                    @php($route = route('department.update', $department->id))
                    @php($method = 'PUT')
                @else
                    @php($route = route('department.store'))
                    @php($method = 'POST')
                @endif

                <form method="post" action="{{ $route }}" class="mt-6 space-y-6">
                    <input type="hidden" name="_method" value="{{ $method }}">
                    @csrf
                    
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                        :value="old('name', $department->name)" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea 
                            id="description" 
                            name="description" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('description', $department->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1" @if(old('status', $department->status) == 1) selected @endif>Active</option>
                            <option value="0" @if(old('status', $department->status) == 0) selected @endif>Inactive</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>

                </form>
            </section>


        </div>
    </div>

</x-app-layout>