<x-workspace-shell :role="$role" title="Notifications" eyebrow="Workspace">
    <div class="mx-auto max-w-3xl">
        <div class="mb-7 flex items-end justify-between gap-4">
            <div>
                <p class="sl-kicker">Activity &amp; Alerts</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Notifications</h2>
                <p class="mt-1 text-sm text-slate-500">Real-time alerts for offers, mission status changes, and reviews.</p>
            </div>
            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-200">
                {{ $notifications->whereNull('read_at')->count() }} unread
            </span>
        </div>

        <div class="sl-panel divide-y divide-slate-100 overflow-hidden">
            @forelse($notifications as $notification)
                @php $isUnread = is_null($notification->read_at); @endphp
                <div class="flex items-start gap-4 p-5 transition-colors {{ $isUnread ? 'bg-blue-50/40' : 'bg-white' }}">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $isUnread ? 'bg-blue-600 text-white shadow-xs' : 'bg-slate-100 text-slate-500' }}">
                        <x-icon name="bell" class="w-4 h-4" />
                    </span>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $notification->data['message'] ?? 'New SkillLink update' }}
                            </p>
                            <time class="text-xs text-slate-400 whitespace-nowrap">
                                {{ $notification->created_at->diffForHumans() }}
                            </time>
                        </div>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $isUnread ? 'Requires your attention' : 'Viewed' }}
                        </p>
                        @if($isUnread)
                            <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="mt-3">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700">
                                    <span>Mark as read</span>
                                    <x-icon name="check" class="w-3.5 h-3.5" />
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                        <x-icon name="bell" class="w-6 h-6" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-slate-900">You're all caught up</h3>
                    <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                        When clients accept your offers, or freelancers apply to your briefs, updates will appear here.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</x-workspace-shell>