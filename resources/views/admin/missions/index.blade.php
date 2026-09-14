<x-admin-shell title="Missions">

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                ID
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Title
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Client
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Category
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Budget
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Deadline
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($missions as $mission)

                            <tr>
                                <td class="px-6 py-4">
                                    {{ $mission->id }}
                                </td>

                                <td class="px-6 py-4 font-medium">
                                    {{ $mission->title }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $mission->client->name ?? '—' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $mission->category->name ?? '—' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $mission->budget }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $mission->status }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $mission->deadline }}
                                </td>

                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('admin.missions.destroy', $mission) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Delete this mission?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    No missions found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-admin-shell>