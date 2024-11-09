<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('message'))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{ session('message') }}
            </div>
            @endif

            <div class="pb-3">
                <a href="{{ route('user.create') }}" class="items-center px-4 py-2 bg-gray-800 rounded font-semibold text-white">
                    Add New User
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900">
                    
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php($i = 0)
                            @foreach($users as $user)
                            <tr class="border-b">
                                <td class="px-6 py-4">{{ ++$i }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ $user->role }}</td>
                                <td class="px-6 py-4">{{ $user->status }}</td>
                                <td class="px-6 py-4">
                                    <form method="POST" 
                                    action="{{ route('user.destroy', $user->id) }}"
                                    onsubmit="return confirm('Are you sure to delete this?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <a href="{{ route('user.edit', $user->id) }}" 
                                            class="items-center px-4 py-2 bg-gray-800 rounded font-semibold text-white">
                                            Edit
                                        </a>
                                        <x-danger-button class="ms-3">
                                            Delete
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>