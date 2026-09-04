<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Missions - SkillLink</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto py-10 px-6">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    My Missions
                </h1>

                <p class="text-gray-600 mt-1">
                    Manage your missions
                </p>
            </div>

            <a href="{{ route('missions.create') }}"
               class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                + Create Mission
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($missions->count() > 0)

            <div class="grid gap-6">

                @foreach($missions as $mission)

                    <div class="bg-white rounded-xl shadow p-6">

                        <div class="flex justify-between items-start">

                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $mission->title }}
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    {{ $mission->description }}
                                </p>
                            </div>

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                {{ $mission->status }}
                            </span>

                        </div>

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

                        <div class="mt-5 flex gap-3">

                            <a href="{{ route('missions.show', $mission) }}"
                               class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800">
                                View
                            </a>

                            <a href="{{ route('missions.edit', $mission) }}"
                               class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('missions.destroy', $mission) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this mission?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-xl shadow p-10 text-center">

                <h2 class="text-xl font-semibold text-gray-700">
                    No missions yet
                </h2>

                <p class="text-gray-500 mt-2">
                    Create your first mission to find a freelancer.
                </p>

                <a href="{{ route('missions.create') }}"
                   class="inline-block mt-5 bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                    Create Your First Mission
                </a>

            </div>

        @endif

    </div>

</body>
</html>