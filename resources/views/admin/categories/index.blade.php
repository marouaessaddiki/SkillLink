<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a
                    href="{{ route('admin.categories.create') }}"
                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                >
                    + Add Category
                </a>
            </div>

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
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($categories as $category)

                            <tr>
                                <td class="px-6 py-4">
                                    {{ $category->id }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $category->name }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">

                                        <a
                                            href="{{ route('admin.categories.edit', $category) }}"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.categories.destroy', $category) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    No categories found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>
```
