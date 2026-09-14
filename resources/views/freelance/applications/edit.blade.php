c:\Users\user\OneDrive\Bureau\mcd fiilrouge.jpg<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        <div class="bg-white rounded-xl shadow p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit offer</h1>
            <p class="text-gray-600 mb-8">{{ $application->mission->title }}</p>

            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('freelance.applications.update', $application) }}">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="proposed_price" class="block font-medium text-gray-700 mb-2">Proposed price</label>
                    <input id="proposed_price" name="proposed_price" type="number" min="0" step="0.01" required
                           value="{{ old('proposed_price', $application->proposed_price) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div class="mb-6">
                    <label for="cover_letter" class="block font-medium text-gray-700 mb-2">Message</label>
                    <textarea id="cover_letter" name="cover_letter" rows="6" required
                              class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('cover_letter', $application->cover_letter) }}</textarea>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('freelance.applications.index') }}" class="text-gray-600 hover:text-gray-800">Back</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Update offer</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
