<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen">

        {{-- Header --}}
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-6 py-5">

                <h1 class="text-3xl font-bold text-gray-800">
                    Admin Dashboard
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

                {{-- Users --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Total Users
                    </p>

                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $stats['users'] }}
                    </p>
                </div>


                {{-- Clients --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Clients
                    </p>

                    <p class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $stats['clients'] }}
                    </p>
                </div>


                {{-- Freelances --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Freelances
                    </p>

                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ $stats['freelances'] }}
                    </p>
                </div>


                {{-- Missions --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Total Missions
                    </p>

                    <p class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $stats['missions'] }}
                    </p>
                </div>


                {{-- Completed --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Completed Missions
                    </p>

                    <p class="text-3xl font-bold text-gray-700 mt-2">
                        {{ $stats['completed'] }}
                    </p>
                </div>

            </div>


            {{-- Admin Actions --}}
            <div class="mt-8 bg-white rounded-xl shadow p-6">

                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    Administration
                </h2>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('missions.index') }}"
                       class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                        View Missions
                    </a>

                </div>

            </div>

        </main>

    </div>

</body>
</html>