<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Available Missions - SkillLink</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto py-10 px-6">

        {{-- Header --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-800">
                Available Missions
            </h1>

            <div class="bg-white rounded-xl shadow-md p-6 mb-8">

    <h2 class="text-lg font-semibold text-gray-800 mb-4">
        Search & Filter Missions 🔎
    </h2>

    <form method="GET" action="{{ route('freelance.missions.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search mission..."
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                >
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Category
                </label>

                <select
                    name="category_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                >
                    <option value="">All Categories</option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Min Budget
                </label>

                <input
                    type="number"
                    name="min_budget"
                    min="0"
                    step="0.01"
                    value="{{ request('min_budget') }}"
                    placeholder="Min"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                >
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Max Budget
                </label>

                <input
                    type="number"
                    name="max_budget"
                    min="0"
                    step="0.01"
                    value="{{ request('max_budget') }}"
                    placeholder="Max"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                >
            </div>

        </div>

        <div class="flex gap-3 mt-5">

            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
            >
                Search
            </button>

            <a
                href="{{ route('freelance.missions.index') }}"
                class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300"
            >
                Reset
            </a>

        </div>

    </form>

</div>

            <p class="text-gray-600 mt-1">
                Find a mission and apply as a freelancer.
            </p>

        </div>

        {{-- Missions --}}
        @if($missions->count() > 0)

            <div class="grid gap-6">

                @foreach($missions as $mission)

                    <div class="bg-white rounded-xl shadow p-6">

                        {{-- Title + Status --}}
                        <div class="flex justify-between items-start">

                            <div>

                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $mission->title }}
                                </h2>

                                {{-- Category --}}
                                @if($mission->category)
                                    <p class="text-sm text-blue-600 font-medium mt-2">
                                        Category: {{ $mission->category->name }}
                                    </p>
                                @endif

                            </div>

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Open
                            </span>

                        </div>

                        {{-- Description --}}
                        <p class="text-gray-600 mt-4">
                            {{ $mission->description }}
                        </p>

                        {{-- Budget + Deadline --}}
                        <div class="mt-5 flex gap-6 text-sm text-gray-600">

                            <p>
                                <strong>Budget:</strong>
                                {{ $mission->budget }}
                            </p>

                            <p>
                                <strong>Deadline:</strong>
                                {{ $mission->deadline }}
                            </p>

                        </div>

                        {{-- Apply --}}
                       
                     <div class="mt-5">

    <form
        action="{{ route('freelance.missions.apply', $mission) }}"
        method="POST"
        class="bg-gray-50 border rounded-lg p-5"
    >
        @csrf

        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Submit your offer
        </h3>

        {{-- Proposed Price --}}
        <div class="mb-4">

            <label
                for="proposed_price_{{ $mission->id }}"
                class="block font-medium text-gray-700 mb-2"
            >
                Proposed Price
            </label>

            <input
                type="number"
                step="0.01"
                min="0"
                id="proposed_price_{{ $mission->id }}"
                name="proposed_price"
                required
                class="w-full border-gray-300 rounded-lg shadow-sm"
                placeholder="Example: 450"
            >

        </div>

        {{-- Cover Letter --}}
        <div class="mb-4">

            <label
                for="cover_letter_{{ $mission->id }}"
                class="block font-medium text-gray-700 mb-2"
            >
                Cover Letter
            </label>

            <textarea
                id="cover_letter_{{ $mission->id }}"
                name="cover_letter"
                rows="4"
                required
                class="w-full border-gray-300 rounded-lg shadow-sm"
                placeholder="Explain why you are the right freelancer for this mission..."
            ></textarea>

        </div>

        <button
            type="submit"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
        >
            Submit Application
        </button>

    </form>

</div>
                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-xl shadow p-10 text-center">

                <h2 class="text-xl font-semibold text-gray-700">
                    No missions available
                </h2>

                <p class="text-gray-500 mt-2">
                    There are currently no open missions.
                </p>

            </div>

        @endif

    </div>

</body>

</html>