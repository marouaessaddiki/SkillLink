<x-admin-shell title="Users Directory">
    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Platform Management</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">User Accounts</h2>
            <p class="mt-1 text-sm text-slate-500">Manage clients, vetted freelancers, and administrative staff across the platform.</p>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 mb-7">
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Users</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-slate-100 text-slate-700">
                    <x-icon name="users" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-slate-900">{{ $stats['total'] }}</p>
            <p class="mt-1 text-xs text-slate-400">All registered profiles</p>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Freelancers</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <x-icon name="user" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-blue-600">{{ $stats['freelancers'] }}</p>
            <p class="mt-1 text-xs text-slate-400">Available specialists</p>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Clients</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <x-icon name="building" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-indigo-600">{{ $stats['clients'] }}</p>
            <p class="mt-1 text-xs text-slate-400">Mission publishers</p>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">New (30d)</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <x-icon name="sparkles" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-emerald-600">{{ $stats['new'] }}</p>
            <p class="mt-1 text-xs text-slate-400">Recent registrations</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-800">
            <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 flex items-center gap-2.5 rounded-xl border border-rose-200 bg-rose-50/80 px-4 py-3 text-sm font-medium text-rose-800">
            <x-icon name="x-mark" class="w-5 h-5 text-rose-600 shrink-0" />
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Filter & Search Bar -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 flex flex-col gap-3 rounded-2xl border border-slate-200/90 bg-white p-4 shadow-subtle sm:flex-row sm:items-center">
        <div class="relative flex-1">
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <x-icon name="search" class="w-4 h-4" />
            </span>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by user name or email..."
                class="w-full rounded-xl border-slate-200 bg-white pl-10 text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors"
            >
        </div>

        <div class="flex items-center gap-2">
            <select
                name="role"
                class="rounded-xl border-slate-200 bg-white text-sm text-slate-900 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors"
            >
                <option value="">All Roles</option>
                <option value="client" {{ request('role') === 'client' ? 'selected' : '' }}>Client</option>
                <option value="freelance" {{ request('role') === 'freelance' ? 'selected' : '' }}>Freelancer</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
            </select>

            <button type="submit" class="sl-button-primary py-2 px-4 text-xs font-bold">
                <x-icon name="filter" class="w-3.5 h-3.5" />
                <span>Filter</span>
            </button>

            @if(request('search') || request('role'))
                <a href="{{ route('admin.users.index') }}" class="sl-button-secondary py-2 px-3 text-xs">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- Users Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-subtle">
        <div class="border-b border-slate-100 px-6 py-4 flex items-center justify-between">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                Showing {{ $users->count() }} accounts
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm divide-y divide-slate-100">
                <thead class="bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th scope="col" class="px-6 py-3.5">User Profile</th>
                        <th scope="col" class="px-6 py-3.5">Platform Role</th>
                        <th scope="col" class="px-6 py-3.5">Registration Date</th>
                        <th scope="col" class="px-6 py-3.5">Account Status</th>
                        <th scope="col" class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                    @forelse($users as $user)
                        @php
                            $roleName = $user->roles->first()?->name ?? 'user';
                        @endphp
                        <tr class="transition-colors hover:bg-slate-50/60">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-900 text-xs font-bold text-white shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                    <div>
                                        <p class="font-semibold text-slate-900 leading-tight">{{ $user->name }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($roleName === 'admin')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-900 px-2.5 py-0.5 text-xs font-semibold text-white">
                                        <x-icon name="shield-check" class="w-3 h-3 text-blue-400" />
                                        <span>Administrator</span>
                                    </span>
                                @elseif($roleName === 'client')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-semibold text-indigo-700">
                                        <x-icon name="building" class="w-3 h-3 text-indigo-500" />
                                        <span>Client</span>
                                    </span>
                                @elseif($roleName === 'freelance')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                                        <x-icon name="user" class="w-3 h-3 text-blue-500" />
                                        <span>Freelancer</span>
                                    </span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-600">
                                        {{ ucfirst($roleName) }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Active</span>
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete user {{ $user->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-2.5 py-1 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                            <x-icon name="trash" class="w-3.5 h-3.5" />
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs font-medium text-slate-400 italic">Current User</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <x-icon name="users" class="mx-auto w-8 h-8 text-slate-300 mb-2" />
                                <p class="text-base font-semibold text-slate-700">No users found</p>
                                <p class="text-xs text-slate-400 mt-1">Try adjusting your keyword search or role filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-shell>
