
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700">
                            Category Name
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            required
                            autofocus
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        >

                        @error('name')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mt-6 flex items-center gap-3">

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Update Category
                        </button>

                        <a
                            href="{{ route('admin.categories.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
```
