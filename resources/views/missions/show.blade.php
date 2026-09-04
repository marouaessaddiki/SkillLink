<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission Details - SkillLink</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto py-10 px-6">

        <div class="bg-white rounded-xl shadow p-8">

            <div class="flex justify-between items-start mb-6">

                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        {{ $mission->title }}
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Mission Details
                    </p>
                </div>

                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm">
                    {{ $mission->status }}
                </span>

            </div>

            <div class="space-y-6">

                <div>
                    <h2 class="font-semibold text-gray-700 mb-2">
                        Description
                    </h2>

                    <p class="text-gray-600">
                        {{ $mission->description }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">
                            Budget
                        </p>

                        <p class="text-xl font-bold text-gray-800">
                            {{ $mission->budget }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">
                            Deadline
                        </p>

                        <p class="text-xl font-bold text-gray-800">
                            {{ $mission->deadline }}
                        </p>
                    </div>

                </div>

            </div>

            <div class="mt-8 flex gap-3">

                <a href="{{ route('missions.index') }}"
                   class="bg-gray-600 text-white px-5 py-2 rounded-lg hover:bg-gray-700">
                    ← Back
                </a>

                <a href="{{ route('missions.edit', $mission) }}"
                   class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600">
                    Edit
                </a>

            </div>

        </div>

    </div>

</body>
</html>