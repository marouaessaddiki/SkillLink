<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                ID
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Name
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Email
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Role
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($users as $user)

                            <tr>
                                <td class="px-6 py-4">
                                    {{ $user->id }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($user->hasRole('admin'))
                                        Admin
                                    @elseif($user->hasRole('client'))
                                        Client
                                    @elseif($user->hasRole('freelance'))
                                        Freelance
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="px-6 py-4">

                                    @if($user->id !== auth()->id())

                                        <form method="POST"
                                              action="{{ route('admin.users.destroy', $user) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-800 font-medium">
                                                Delete
                                            </button>

                                        </form>

                                    @else

                                        <span class="text-gray-400">
                                            Current account
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No users found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>