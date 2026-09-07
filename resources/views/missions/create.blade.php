<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Mission - SkillLink</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto py-10 px-6">

        <div class="bg-white rounded-xl shadow p-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Create a Mission
            </h1>

            <p class="text-gray-600 mb-8">
                Publish your mission and find the right freelancer.
            </p>

            {{-- Validation errors --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('missions.store') }}">
                @csrf

                {{-- Title --}}
                <div class="mb-5">
                    <label
                        for="title"
                        class="block font-medium text-gray-700 mb-2"
                    >
                        Mission Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                        placeholder="Example: Create a Laravel website"
                    >
                </div>

                {{-- Category --}}
                <div class="mb-5">
                    <label
                        for="category_id"
                        class="block font-medium text-gray-700 mb-2"
                    >
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        required
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                    >
                        <option value="">Select a category</option>

                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="mb-5">
                    <label
                        for="description"
                        class="block font-medium text-gray-700 mb-2"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        required
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                        placeholder="Describe your mission..."
                    >{{ old('description') }}</textarea>
                </div>

                {{-- Budget + Deadline --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label
                            for="budget"
                            class="block font-medium text-gray-700 mb-2"
                        >
                            Budget
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            id="budget"
                            name="budget"
                            value="{{ old('budget') }}"
                            required
                            min="0"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            placeholder="500"
                        >
                    </div>

                    <div>
                        <label
                            for="deadline"
                            class="block font-medium text-gray-700 mb-2"
                        >
                            Deadline
                        </label>

                        <input
                            type="date"
                            id="deadline"
                            name="deadline"
                            value="{{ old('deadline') }}"
                            required
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                        >
                    </div>

                </div>

                {{-- Status --}}
<div class="mb-6 mt-5">

    <label
        for="status"
        class="block font-medium text-gray-700 mb-2"
    >
        Status
    </label>

    <select
        id="status"
        name="status"
        class="w-full border-gray-300 rounded-lg shadow-sm"
    >

        <option
            value="open"
            {{ old('status', 'open') == 'open' ? 'selected' : '' }}
        >
            Open
        </option>

        <option
            value="in_progress"
            {{ old('status') == 'in_progress' ? 'selected' : '' }}
        >
            In Progress
        </option>

        <option
            value="completed"
            {{ old('status') == 'completed' ? 'selected' : '' }}
        >
            Completed
        </option>

        <option
            value="cancelled"
            {{ old('status') == 'cancelled' ? 'selected' : '' }}
        >
            Cancelled
        </option>

    </select>

</div>

{{-- Buttons --}}
<div class="flex justify-between items-center mt-6">

    <a
        href="{{ route('missions.index') }}"
        class="text-gray-600 hover:text-gray-800"
    >
        ← Back
    </a>

    <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700"
    >
        Create Mission
    </button>

</div>

</form>

</div>
</div>

</body>
</html>