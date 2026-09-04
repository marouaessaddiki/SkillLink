<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            Applications
        </h1>

        @if($applications->isEmpty())

            <div class="bg-white p-8 rounded-xl shadow text-center">
                <p class="text-gray-500">
                    No applications yet.
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
                            Freelancer:
                            <strong>
                                {{ $application->freelance->name }}
                            </strong>
                        </p>

                        <p class="text-gray-600 mt-2">
                            Email:
                            {{ $application->freelance->email }}
                        </p>

                        @if($application->cover_letter)
                            <div class="mt-4">
                                <strong>Cover Letter:</strong>

                                <p class="text-gray-600 mt-2">
                                    {{ $application->cover_letter }}
                                </p>
                            </div>
                        @endif

                        <p class="mt-4">
                            <strong>Status:</strong>

                            <span class="font-semibold">
                                {{ ucfirst($application->status) }}
                            </span>
                        </p>

                       @if($application->status === 'pending')

    <div class="flex gap-3 mt-5">

        <form method="POST"
              action="{{ route('client.applications.accept', $application) }}">
            @csrf

            <button
                type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Accept
            </button>
        </form>

        <form method="POST"
              action="{{ route('client.applications.reject', $application) }}">
            @csrf

            <button
                type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Reject
            </button>
        </form>

    </div>

@elseif($application->status === 'accepted')

    <div class="mt-5 bg-green-100 text-green-700 p-3 rounded-lg">
        Application Accepted ✅
    </div>

@elseif($application->status === 'rejected')

    <div class="mt-5 bg-red-100 text-red-700 p-3 rounded-lg">
        Application Rejected ❌
    </div>

@endif 

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>