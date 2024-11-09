<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message with better styling --}}
            @if(session('message'))
            <div class="mb-4 relative">
                <div class="p-4 rounded-md shadow-sm border border-emerald-200 bg-emerald-50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon check-circle -->
                            <svg class="h-5 w-5 text-emerald-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">
                                {{ session('message') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Add New User Button --}}
            <div class="mb-6">
                <a href="{{ route('user.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Add New User
                </a>
            </div>

            {{-- Users Table with proper borders --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">User Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php($i = 0)
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200">{{ ++$i }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b border-gray-200">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200">
                                    <span class="inline-flex px-2 text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200">{{ $user->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-b border-gray-200">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('user.edit', $user->id) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-gray-800 rounded text-xs font-semibold text-white hover:bg-gray-700">
                                            Edit
                                        </a>
                                        
                                        <form method="POST" 
                                              action="{{ route('user.destroy', $user->id) }}"
                                              class="inline-flex"
                                              onsubmit="return confirm('Are you sure to delete this?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 rounded text-xs font-semibold text-white hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
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