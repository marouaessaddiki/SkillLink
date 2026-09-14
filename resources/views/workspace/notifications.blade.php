<x-workspace-shell :role="$role" title="Notifications" eyebrow="Workspace">
    <div class="mx-auto max-w-4xl">
        <div class="mb-7 flex items-end justify-between gap-4"><div><p class="sl-kicker">Stay in the loop</p><h2 class="mt-2 text-3xl font-bold tracking-tight text-[var(--ink)]">Your notifications</h2><p class="mt-2 text-[var(--muted)]">Important updates from your missions and offers.</p></div><span class="rounded-full bg-blue-50 px-3 py-2 text-xs font-bold text-[var(--blue)]">{{ $notifications->whereNull('read_at')->count() }} unread</span></div>
        <div class="sl-panel divide-y divide-[var(--line)] overflow-hidden">
            @forelse($notifications as $notification)
                <div class="flex gap-4 p-5 {{ is_null($notification->read_at) ? 'bg-blue-50/40' : 'bg-white' }}">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ is_null($notification->read_at) ? 'bg-[var(--blue)] text-white' : 'bg-slate-100 text-[var(--muted)]' }}">♢</span>
                    <div class="min-w-0 flex-1"><div class="flex flex-wrap items-center justify-between gap-2"><p class="font-semibold text-[var(--ink)]">{{ $notification->data['message'] ?? 'New SkillLink update' }}</p><time class="text-xs text-[var(--muted)]">{{ $notification->created_at->diffForHumans() }}</time></div><p class="mt-1 text-sm text-[var(--muted)]">{{ is_null($notification->read_at) ? 'Unread notification' : 'Read notification' }}</p>@if(is_null($notification->read_at))<form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="mt-3">@csrf<button class="text-xs font-bold text-[var(--blue)]">Mark as read →</button></form>@endif</div>
                </div>
            @empty
                <div class="p-14 text-center"><span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-2xl text-[var(--blue)]">♢</span><h3 class="mt-5 text-lg font-bold text-[var(--ink)]">You're all caught up</h3><p class="mt-2 text-sm text-[var(--muted)]">New mission and offer updates will appear here.</p></div>
            @endforelse
        </div>
    </div>
</x-workspace-shell>