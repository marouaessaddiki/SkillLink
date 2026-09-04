<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            Available Missions
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($missions->isEmpty())

            <div class="bg-white p-8 rounded-xl shadow text-center">
                <p class="text-gray-500">
                    No missions available at the moment.
                </p>
            </div>

        @else

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($missions as $mission)

                    <div class="bg-white rounded-xl shadow-md p-6">

                        <h2 class="text-xl font-bold text-gray-800 mb-3">
                            {{ $mission->title }}
                        </h2>

                        <p class="text-gray-600 mb-4">
                            {{ $mission->description }}
                        </p>

                        <div class="space-y-2 text-sm mb-5">

                            <p>
                                <strong>Budget:</strong>
                                {{ $mission->budget }} DH
                            </p>

                            <p>
                                <strong>Deadline:</strong>
                                {{ $mission->deadline }}
                            </p>

                            <p>
                                <strong>Status:</strong>
                                <span class="text-green-600 font-semibold">
                                    {{ ucfirst($mission->status) }}
                                </span>
                            </p>

                        </div>

                     @if(in_array($mission->id, $appliedMissionIds))

    <div class="bg-gray-100 text-gray-600 px-4 py-3 rounded-lg">
        You already applied to this mission.
    </div>

@else

    <form method="POST"
          action="{{ route('freelance.missions.apply', $mission) }}">

        @csrf

        <textarea
            name="cover_letter"
            rows="4"
            placeholder="Write your cover letter..."
            class="w-full border-gray-300 rounded-lg mb-3"
        ></textarea>

        <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
            Apply Now
        </button>

    </form>

@endif   

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>