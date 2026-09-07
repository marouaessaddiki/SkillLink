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
    Proposed Price:
    <strong>
        ${{ number_format($application->proposed_price, 2) }}
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

    @if($application->mission->status === 'completed')

        @if(!$application->mission->reviews()
            ->where('reviewer_id', auth()->id())
            ->exists())

            <div class="mt-5 bg-gray-50 border rounded-lg p-5">

                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Review Freelancer ⭐
                </h3>

                <form
                    method="POST"
                    action="{{ route('client.missions.review', $application->mission) }}"
                >
                    @csrf

                    <div class="mb-4">

                        <label class="block font-medium text-gray-700 mb-2">
                            Rating
                        </label>

                        <select
                            name="rating"
                            required
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                        >
                            <option value="">Choose rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                            <option value="4">⭐⭐⭐⭐ - Very Good</option>
                            <option value="3">⭐⭐⭐ - Good</option>
                            <option value="2">⭐⭐ - Poor</option>
                            <option value="1">⭐ - Very Poor</option>
                        </select>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-gray-700 mb-2">
                            Comment
                        </label>

                        <textarea
                            name="comment"
                            rows="4"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            placeholder="Write your review..."
                        ></textarea>

                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
                    >
                        Submit Review
                    </button>

                </form>

            </div>

       @else

    @php
        $review = $application->mission->reviews()
            ->where('reviewer_id', auth()->id())
            ->first();
    @endphp

    @if($review)

        <div class="mt-5 bg-blue-50 border border-blue-200 rounded-lg p-5">

            <h3 class="text-lg font-semibold text-gray-800 mb-3">
                Your Review ⭐
            </h3>

            <p class="text-yellow-500 text-xl mb-2">
                {{ str_repeat('⭐', $review->rating) }}
            </p>

            @if($review->comment)

                <p class="text-gray-700">
                    {{ $review->comment }}
                </p>

            @else

                <p class="text-gray-500">
                    No comment provided.
                </p>

            @endif

        </div>

    @endif

@endif

    @endif

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