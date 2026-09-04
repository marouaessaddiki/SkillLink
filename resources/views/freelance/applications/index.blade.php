<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            My Applications
        </h1>

        @if($applications->isEmpty())

            <div class="bg-white p-8 rounded-xl shadow text-center">
                <p class="text-gray-500">
                    You haven't applied to any mission yet.
                </p>
            </div>

        @else

            <div class="space-y-6">

                @foreach($applications as $application)

                    <div class="bg-white rounded-xl shadow-md p-6">

                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $application->mission->title }}
                        </h2>

                        <p class="text-gray-600 mt-2">
                            Budget:
                            <strong>
                                ${{ $application->mission->budget }}
                            </strong>
                        </p>

                        <p class="text-gray-600 mt-2">
                            Deadline:
                            {{ $application->mission->deadline }}
                        </p>

                        @if($application->cover_letter)

                            <div class="mt-4">
                                <strong>Cover Letter:</strong>

                                <p class="text-gray-600 mt-2">
                                    {{ $application->cover_letter }}
                                </p>
                            </div>

                        @endif

                        <div class="mt-5">

                            <strong>Status:</strong>

                            @if($application->status === 'pending')

                                <span class="ml-2 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                    Pending
                                </span>

                            @elseif($application->status === 'accepted')

                                <span class="ml-2 bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                    Accepted ✅
                                </span>

                            @elseif($application->status === 'rejected')

                                <span class="ml-2 bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                    Rejected ❌
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>