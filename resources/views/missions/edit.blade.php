<x-workspace-shell role="client" title="Edit mission" eyebrow="Client workspace">

    <div class="max-w-3xl mx-auto py-10 px-6">

        <div class="bg-white rounded-xl shadow p-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Edit Mission
            </h1>

            <p class="text-gray-600 mb-8">
                Update your mission information.
            </p>

            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">

                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <form method="POST"
                  action="{{ route('missions.update', $mission) }}">

                @csrf
                @method('PUT')

                <div class="mb-5">

                    <label for="category_id"
                           class="block font-medium text-gray-700 mb-2">
                        Category
                    </label>

                    <select id="category_id"
                            name="category_id"
                            required
                            class="w-full border-gray-300 rounded-lg shadow-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $mission->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-5">

                    <label for="title"
                           class="block font-medium text-gray-700 mb-2">
                        Mission Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $mission->title) }}"
                        required
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                    >

                </div>

                <div class="mb-5">

                    <label for="description"
                           class="block font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        required
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                    >{{ old('description', $mission->description) }}</textarea>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <label for="budget"
                               class="block font-medium text-gray-700 mb-2">
                            Budget
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            id="budget"
                            name="budget"
                            value="{{ old('budget', $mission->budget) }}"
                            required
                            min="0"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                        >

                    </div>

                    <div>

                        <label for="deadline"
                               class="block font-medium text-gray-700 mb-2">
                            Deadline
                        </label>

                        <input
                            type="date"
                            id="deadline"
                            name="deadline"
                            value="{{ old('deadline', $mission->deadline) }}"
                            required
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                        >

                    </div>

                </div>

                <div class="flex justify-between items-center">

                    <a href="{{ route('missions.index') }}"
                       class="text-gray-600 hover:text-gray-800">
                        ← Back
                    </a>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Update Mission
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-workspace-shell>