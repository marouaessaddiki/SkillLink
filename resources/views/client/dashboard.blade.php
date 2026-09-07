<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Client Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen">

        {{-- Header --}}
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-6 py-5">

                <h1 class="text-3xl font-bold text-gray-800">
                    Client Dashboard
                </h1>

                <p class="mt-1 text-gray-600">
                    Welcome {{ auth()->user()->name }} 👋
                </p>

            </div>
        </header>


        {{-- Content --}}
        <main class="max-w-7xl mx-auto px-6 py-8">

            {{-- Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                {{-- Total missions --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Total Missions
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $stats['total'] }}
                    </p>
                </div>


                {{-- Open missions --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Open Missions
                    </p>

                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $stats['open'] }}
                    </p>
                </div>


                {{-- In progress --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        In Progress
                    </p>

                    <p class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $stats['in_progress'] }}
                    </p>
                </div>


                {{-- Completed --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Completed
                    </p>

                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ $stats['completed'] }}
                    </p>
                </div>


                {{-- Applications --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Applications
                    </p>

                    <p class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $stats['applications'] }}
                    </p>
                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-8 bg-white rounded-xl shadow p-6">

                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    Quick Actions
                </h2>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('missions.create') }}"
                       class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                        + Create Mission
                    </a>

                    <a href="{{ route('missions.index') }}"
                       class="bg-gray-200 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-300">
                        My Missions
                    </a>

                    <a href="{{ route('client.applications.index') }}"
                       class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700">
                        View Applications
                    </a>

                </div>

            </div>

        </main>

    </div>

</body>
</html>