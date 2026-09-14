<x-admin-shell title="Applications Monitoring">
    <div class="mb-7">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Platform Oversight</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">All Applications & Offers</h2>
        <p class="mt-1 text-sm text-slate-500">Monitor proposals submitted by freelancers across all active and past missions.</p>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-subtle">
        <div class="border-b border-slate-100 px-6 py-4 flex items-center justify-between">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                Total: {{ $applications->count() }} records
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm divide-y divide-slate-100">
                <thead class="bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th scope="col" class="px-6 py-3.5">Freelancer</th>
                        <th scope="col" class="px-6 py-3.5">Mission</th>
                        <th scope="col" class="px-6 py-3.5">Proposed Price</th>
                        <th scope="col" class="px-6 py-3.5">Status</th>
                        <th scope="col" class="px-6 py-3.5">Date Submitted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                    @forelse($applications as $application)
                        <tr class="transition-colors hover:bg-slate-50/60">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-900 text-xs font-bold text-white">
                                        {{ strtoupper(substr($application->freelance->name ?? 'F', 0, 1)) }}
                                    </span>
                                    <div>
                                        <p class="font-semibold text-slate-900 leading-none">{{ $application->freelance->name }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $application->freelance->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-slate-800 line-clamp-1 max-w-xs">{{ $application->mission->title }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">Client: {{ $application->mission->client->name ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900 whitespace-nowrap">
                                {{ number_format($application->proposed_price, 2) }} MAD
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-status-badge :status="$application->status" size="sm" />
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ $application->date_submission?->format('d M Y, H:i') ?? $application->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <p class="text-base font-semibold text-slate-700">No applications recorded yet</p>
                                <p class="text-xs text-slate-400 mt-1">Offers will appear here once freelancers apply to published missions.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-shell>
