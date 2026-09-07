<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            My Applications
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

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

                        {{-- Mission --}}
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $application->mission->title }}
                        </h2>

                        {{-- Budget --}}
                        <p class="text-gray-600 mt-2">
                            Budget:
                            <strong>
                                ${{ $application->mission->budget }}
                            </strong>
                        </p>

                        {{-- Proposed Price --}}
                        <p class="text-gray-600 mt-2">
                            Proposed Price:
                            <strong>
                                ${{ number_format($application->proposed_price, 2) }}
                            </strong>
                        </p>

                        {{-- Deadline --}}
                        <p class="text-gray-600 mt-2">
                            Deadline:
                            {{ $application->mission->deadline }}
                        </p>

                        {{-- Cover Letter --}}
                        @if($application->cover_letter)

                            <div class="mt-4">
                                <strong>Cover Letter:</strong>

                                <p class="text-gray-600 mt-2">
                                    {{ $application->cover_letter }}
                                </p>
                            </div>

                        @endif

                        {{-- Application Status --}}
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

                                {{-- Complete Mission --}}
                                @if($application->mission->status === 'in_progress')

                                    <form
                                        action="{{ route('freelance.missions.complete', $application->mission) }}"
                                        method="POST"
                                        class="mt-4"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
                                            onclick="return confirm('Are you sure you want to mark this mission as completed?')"
                                        >
                                            Complete Mission
                                        </button>

                                    </form>

                               @elseif($application->mission->status === 'completed')

    <div class="mt-4 bg-green-100 text-green-700 p-3 rounded-lg">
        Mission Completed ✅
    </div>

    @php
        $clientReview = $application->mission->reviews()
            ->where('reviewer_id', auth()->id())
            ->first();
    @endphp

    @if(!$clientReview)

        <div class="mt-5 bg-gray-50 border rounded-lg p-5">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Review Client ⭐
            </h3>

            <form
                method="POST"
                action="{{ route('freelance.missions.review-client', $application->mission) }}"
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

        <div class="mt-5 bg-blue-50 border border-blue-200 rounded-lg p-5">

            <h3 class="text-lg font-semibold text-gray-800 mb-3">
                Your Review ⭐
            </h3>

            <p class="text-yellow-500 text-xl mb-2">
                {{ str_repeat('⭐', $clientReview->rating) }}
            </p>

            @if($clientReview->comment)

                <p class="text-gray-700">
                    {{ $clientReview->comment }}
                </p>

            @else

                <p class="text-gray-500">
                    No comment provided.
                </p>

            @endif

        </div>

    @endif

@endif

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