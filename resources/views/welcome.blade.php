<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SkillLink is Morocco's dedicated platform connecting verified enterprises with vetted freelancers. Publish project briefs, evaluate transparent offers, and deliver milestones.">
    <title>SkillLink &mdash; Where the Right Skills Meet the Right Mission</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 text-slate-900 antialiased flex flex-col justify-between">
    <!-- Top Global Announcement Bar -->
    <div class="border-b border-blue-100 bg-blue-50/70 px-4 py-2 text-center text-xs font-medium text-blue-800">
        <span>SkillLink Marketplace &mdash; Where serious briefs meet vetted expertise. Real talent, transparent MAD rates.</span>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/95 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5" aria-label="SkillLink Home">
                <x-application-logo />
            </a>

            <!-- Central Navigation Links -->
            <nav class="hidden items-center gap-8 text-sm font-semibold text-slate-600 md:flex">
                <a href="#how-it-works" class="transition-colors hover:text-blue-600">How it works</a>
                <a href="#why-skilllink" class="transition-colors hover:text-blue-600">Why SkillLink</a>
                <a href="#ecosystem" class="transition-colors hover:text-blue-600">The ecosystem</a>
                <a href="#reviews" class="transition-colors hover:text-blue-600">Reviews</a>
            </nav>

            <!-- Auth Action Buttons -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="sl-button-primary">
                        <span>Workspace</span>
                        <x-icon name="arrow-up-right" class="w-4 h-4" />
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 px-3 py-2 transition-colors">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="sl-button-primary">
                        <span>Create account</span>
                        <x-icon name="arrow-right" class="w-4 h-4" />
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1">
        <!-- Hero Section -->
        <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28">
            <div class="pointer-events-none absolute inset-0 -z-10 flex items-center justify-center">
                <div class="h-[500px] w-[800px] rounded-full bg-gradient-to-tr from-blue-100/40 via-indigo-50/30 to-sky-100/40 blur-3xl"></div>
            </div>

            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-16">
                    <!-- Left: Editorial Hero Copy -->
                    <div class="lg:col-span-6">
                        <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50/80 px-3 py-1 text-xs font-semibold text-blue-700">
                            <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                            Professional Freelance Marketplace
                        </div>

                        <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl lg:leading-[1.1]">
                            Where the right skills meet the <span class="text-blue-600">right mission.</span>
                        </h1>

                        <p class="mt-6 text-base sm:text-lg leading-relaxed text-slate-600">
                            SkillLink is Morocco's dedicated platform connecting verified enterprises with vetted freelancers. Publish project briefs, evaluate transparent offers, and deliver milestones with protected collaboration.
                        </p>

                        <!-- Call to Action Buttons -->
                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <a href="{{ route('register') }}" class="sl-button-primary px-6 py-3.5 text-base justify-center">
                                <span>Find a freelancer</span>
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                            <a href="{{ route('register') }}" class="sl-button-secondary px-6 py-3.5 text-base justify-center">
                                <x-icon name="document-text" class="w-4 h-4 text-slate-500" />
                                <span>Publish a mission</span>
                            </a>
                        </div>

                        <!-- Trust Checkpoints Statement -->
                        <div class="mt-10 grid grid-cols-3 gap-4 border-t border-slate-200/80 pt-6 text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span class="font-medium text-slate-700">Vetted Specialists</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-icon name="shield-check" class="w-4 h-4 text-blue-600 shrink-0" />
                                <span class="font-medium text-slate-700">Milestone Security</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-icon name="star" class="w-4 h-4 text-amber-500 shrink-0" />
                                <span class="font-medium text-slate-700">Mutual 5★ Reviews</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Authentic Professional Photograph -->
                    <div class="lg:col-span-6">
                        <div class="relative mx-auto max-w-lg lg:max-w-none">
                            <!-- Main Frame with Subtle Border and Shadow -->
                            <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white p-2 shadow-panel">
                                <img
                                    src="{{ asset('images/freelancer-hero.jpg') }}"
                                    alt="Professional specialist working remotely on digital development project"
                                    class="h-[380px] sm:h-[420px] w-full rounded-xl object-cover object-center"
                                    loading="eager"
                                />
                            </div>

                            <!-- Floating Badge 1: Top Right Status Label -->
                            <div class="absolute -top-3 -right-3 hidden sm:flex items-center gap-2 rounded-xl border border-slate-200/90 bg-white/95 px-3.5 py-2 shadow-elevated backdrop-blur-sm">
                                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-ping"></span>
                                <span class="text-xs font-bold text-slate-900">Active Collaboration</span>
                            </div>

                            <!-- Floating Badge 2: Bottom Card with Verified Metadata -->
                            <div class="absolute -bottom-5 -left-4 sm:left-6 rounded-2xl border border-slate-200/90 bg-white p-4 shadow-elevated flex items-center gap-3.5 max-w-xs">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white font-bold text-sm shrink-0 shadow-sm">
                                    <x-icon name="check-badge" class="w-6 h-6 text-white" />
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <p class="text-xs font-bold text-slate-900 leading-tight">Verified Specialist</p>
                                        <span class="rounded bg-emerald-50 px-1.5 py-0.2 text-[10px] font-bold text-emerald-700">100% Fit</span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Software Engineering &bull; 5.0 Rating</p>
                                    <div class="mt-1 flex items-center gap-1 text-[11px] font-semibold text-blue-600">
                                        <x-icon name="shield-check" class="w-3.5 h-3.5" />
                                        <span>Protected Milestone Delivery</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Counter Bar -->
        <section class="border-y border-slate-200/80 bg-white py-9">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-6 text-center md:grid-cols-4">
                    <div>
                        <p class="text-3xl font-extrabold tracking-tight text-slate-900">100%</p>
                        <p class="mt-1 text-xs font-semibold text-slate-500 uppercase tracking-wider">Role-Based Protection</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold tracking-tight text-blue-600">5-Star</p>
                        <p class="mt-1 text-xs font-semibold text-slate-500 uppercase tracking-wider">Mutual Review System</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold tracking-tight text-slate-900">&lt; 24h</p>
                        <p class="mt-1 text-xs font-semibold text-slate-500 uppercase tracking-wider">Average First Offer</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold tracking-tight text-emerald-600">0 MAD</p>
                        <p class="mt-1 text-xs font-semibold text-slate-500 uppercase tracking-wider">Hidden Platform Fees</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: HOW IT WORKS (4 Clear Steps) -->
        <section id="how-it-works" class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Structured Process</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">How SkillLink Works</h2>
                    <p class="mt-3 text-base text-slate-600">
                        Four straightforward, verified milestones from initial brief definition to final project completion.
                    </p>
                </div>

                <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Step 01 -->
                    <div class="relative rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-blue-600">Step 01</span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <x-icon name="document-text" class="w-5 h-5" />
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Publish a mission</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Define your goals, tech requirements, target timeline, and budget in MAD. Published briefs are immediately visible to vetted specialists.
                        </p>
                    </div>

                    <!-- Step 02 -->
                    <div class="relative rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-blue-600">Step 02</span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                                <x-icon name="briefcase" class="w-5 h-5" />
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Receive applications</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Qualified freelancers submit competitive proposals with transparent proposed rates and detailed cover letter pitches.
                        </p>
                    </div>

                    <!-- Step 03 -->
                    <div class="relative rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-blue-600">Step 03</span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                                <x-icon name="link" class="w-5 h-5" />
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Choose the right freelancer</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Review applicant track records, compare pricing, and accept the top offer. Contract status updates to in_progress with instant alerts.
                        </p>
                    </div>

                    <!-- Step 04 -->
                    <div class="relative rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-600">Step 04</span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <x-icon name="check-circle" class="w-5 h-5" />
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Complete the mission</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Freelancer delivers the work, milestones are signed off, and both parties unlock verified mutual reviews to grow reputation.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: WHY SKILLINK (Benefits) -->
        <section id="why-skilllink" class="border-y border-slate-200/80 bg-white py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Built for Serious Work</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Why Choose SkillLink</h2>
                    <p class="mt-3 text-base text-slate-600">
                        A focused marketplace designed for professional standards, eliminating low-quality bidding and opaque communications.
                    </p>
                </div>

                <div class="mt-14 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Benefit 1 -->
                    <div class="rounded-2xl border border-slate-200/80 p-6 bg-slate-50/50 hover:bg-white hover:shadow-subtle transition-all">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white mb-4">
                            <x-icon name="user" class="w-5 h-5" />
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Find Qualified Talent</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Connect with validated engineers, designers, and specialists who possess proven competencies in their respective categories.
                        </p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="rounded-2xl border border-slate-200/80 p-6 bg-slate-50/50 hover:bg-white hover:shadow-subtle transition-all">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 text-white mb-4">
                            <x-icon name="document-text" class="w-5 h-5" />
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Clear Mission Management</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Track the entire lifecycle from draft to completion with clear status transitions, notifications, and direct ownership checks.
                        </p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="rounded-2xl border border-slate-200/80 p-6 bg-slate-50/50 hover:bg-white hover:shadow-subtle transition-all">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-white mb-4">
                            <x-icon name="cash" class="w-5 h-5" />
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Transparent Applications</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Clear proposed prices in MAD and comprehensive pitch letters. No hidden platform deducts or confusing credit tokens.
                        </p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="rounded-2xl border border-slate-200/80 p-6 bg-slate-50/50 hover:bg-white hover:shadow-subtle transition-all">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-white mb-4">
                            <x-icon name="star" class="w-5 h-5 text-amber-400" />
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Professional Collaboration</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Mutual reviews ensure high standards on both sides. Build an authentic reputation verified by real project deliveries.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: CLIENT + FREELANCER ECOSYSTEM -->
        <section id="ecosystem" class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Two Sides, One Marketplace</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">The SkillLink Ecosystem</h2>
                    <p class="mt-3 text-base text-slate-600">
                        Tailored workspaces engineered specifically for the distinct needs of project owners and independent specialists.
                    </p>
                </div>

                <div class="mt-14 grid gap-8 lg:grid-cols-2">
                    <!-- Client Card -->
                    <div class="rounded-3xl border border-slate-200/90 bg-white p-8 sm:p-10 shadow-subtle">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                                <x-icon name="building" class="w-6 h-6" />
                            </div>
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">For Companies &amp; Founders</span>
                                <h3 class="text-xl font-bold text-slate-900">Hire with Precision</h3>
                            </div>
                        </div>

                        <p class="text-sm leading-relaxed text-slate-600">
                            Eliminate the noise of generic gig boards. SkillLink allows clients to define strict criteria, evaluate tailored candidate proposals in MAD, and review previous mission feedback before committing.
                        </p>

                        <ul class="mt-6 space-y-3 text-xs font-medium text-slate-700">
                            <li class="flex items-center gap-2.5">
                                <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span>Publish missions with exact budgets and delivery dates</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span>Single-click offer acceptance that automatically clears pending bids</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span>Leave authentic 1-to-5 star feedback upon delivery</span>
                            </li>
                        </ul>

                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <a href="{{ route('register') }}" class="sl-button-primary">
                                <span>Join as a Client</span>
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                        </div>
                    </div>

                    <!-- Freelancer Card -->
                    <div class="rounded-3xl border border-slate-200/90 bg-white p-8 sm:p-10 shadow-subtle">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                <x-icon name="briefcase" class="w-6 h-6" />
                            </div>
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">For Independent Specialists</span>
                                <h3 class="text-xl font-bold text-slate-900">Build Your Reputation</h3>
                            </div>
                        </div>

                        <p class="text-sm leading-relaxed text-slate-600">
                            Apply to real, funded briefs from clients who understand your craft. Propose competitive pricing that reflects your skills, manage your proposals, and mark projects complete to unlock ratings.
                        </p>

                        <ul class="mt-6 space-y-3 text-xs font-medium text-slate-700">
                            <li class="flex items-center gap-2.5">
                                <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span>Browse curated missions filtered by category and budget</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span>Submit detailed pitches with tailored proposed pricing</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span>Earn verified client reviews to cement your market authority</span>
                            </li>
                        </ul>

                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <a href="{{ route('register') }}" class="sl-button-secondary">
                                <span>Join as a Freelancer</span>
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: TRUST / REVIEWS -->
        <section id="reviews" class="border-y border-slate-200/80 bg-white py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Verified Testimonials</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Trusted by Teams &amp; Talent</h2>
                    <p class="mt-3 text-base text-slate-600">
                        Read how clients and independent specialists collaborate with clarity and mutual accountability.
                    </p>
                </div>

                <div class="mt-14 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Review 1: Client -->
                    <div class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1 text-amber-500 mb-3">
                                @for($i = 0; $i < 5; $i++)
                                    <x-icon name="star" class="w-4 h-4 text-amber-500 fill-current" />
                                @endfor
                            </div>
                            <p class="text-xs leading-relaxed text-slate-700 italic">
                                "SkillLink transformed how we scale our engineering capacity. We published a mission for our customer portal and had 5 verified proposals within 24 hours. Delivered ahead of schedule."
                            </p>
                        </div>
                        <div class="mt-6 flex items-center gap-3 border-t border-slate-200/60 pt-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-900 font-bold text-white text-xs">
                                KB
                            </span>
                            <div>
                                <p class="text-xs font-bold text-slate-900 leading-tight">Karim Benjelloun</p>
                                <p class="text-[11px] text-slate-400">Founder &bull; Casablanca</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 2: Freelancer -->
                    <div class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1 text-amber-500 mb-3">
                                @for($i = 0; $i < 5; $i++)
                                    <x-icon name="star" class="w-4 h-4 text-amber-500 fill-current" />
                                @endfor
                            </div>
                            <p class="text-xs leading-relaxed text-slate-700 italic">
                                "The transparency on SkillLink is unmatched. Real clients with realistic budgets, no spam proposals, and a mutual review system that actually protects serious developers."
                            </p>
                        </div>
                        <div class="mt-6 flex items-center gap-3 border-t border-slate-200/60 pt-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 font-bold text-white text-xs">
                                SA
                            </span>
                            <div>
                                <p class="text-xs font-bold text-slate-900 leading-tight">Salma Alami</p>
                                <p class="text-[11px] text-slate-400">Full-Stack Architect &bull; Rabat</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 3: Client -->
                    <div class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1 text-amber-500 mb-3">
                                @for($i = 0; $i < 5; $i++)
                                    <x-icon name="star" class="w-4 h-4 text-amber-500 fill-current" />
                                @endfor
                            </div>
                            <p class="text-xs leading-relaxed text-slate-700 italic">
                                "Clean dashboard, zero clutter, and clear milestone sign-offs. We found an outstanding mobile developer who executed our MVP within our exact 20,000 MAD budget."
                            </p>
                        </div>
                        <div class="mt-6 flex items-center gap-3 border-t border-slate-200/60 pt-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 font-bold text-white text-xs">
                                YM
                            </span>
                            <div>
                                <p class="text-xs font-bold text-slate-900 leading-tight">Younes Mansouri</p>
                                <p class="text-[11px] text-slate-400">Product Manager &bull; Marrakech</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: FINAL CTA -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="rounded-3xl border border-slate-900 bg-slate-900 p-8 sm:p-14 text-white shadow-panel relative overflow-hidden">
                    <div class="relative z-10 max-w-2xl">
                        <span class="rounded-full bg-blue-500/20 px-3 py-1 text-xs font-bold uppercase tracking-wider text-blue-400 border border-blue-400/30">
                            Join Morocco's Skill Network
                        </span>
                        <h2 class="mt-5 text-3xl font-extrabold tracking-tight sm:text-4xl text-white">
                            Ready to connect skills with high-impact opportunities?
                        </h2>
                        <p class="mt-4 text-sm sm:text-base leading-relaxed text-slate-300">
                            Create your free account today. Publish your first project brief or explore active missions ready for your expertise.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3.5 text-sm font-bold text-white hover:bg-blue-700 transition-colors shadow-subtle">
                                <span>Create Free Account</span>
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-700 bg-slate-800/80 px-6 py-3.5 text-sm font-bold text-slate-200 hover:bg-slate-800 transition-colors">
                                <span>Sign In to Workspace</span>
                            </a>
                        </div>
                    </div>

                    <!-- Subtle Geometric Accent -->
                    <div class="pointer-events-none absolute -right-20 -bottom-20 h-96 w-96 rounded-full bg-blue-600/10 blur-3xl"></div>
                </div>
            </div>
        </section>
    </main>

    <!-- Professional Footer -->
    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="col-span-2 md:col-span-1">
                    <x-application-logo />
                    <p class="mt-4 text-xs leading-relaxed text-slate-500">
                        SkillLink is the dedicated marketplace connecting verified enterprises with independent specialists across Morocco and beyond.
                    </p>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Platform</h3>
                    <ul class="mt-4 space-y-2 text-xs text-slate-600">
                        <li><a href="#how-it-works" class="hover:text-blue-600 transition-colors">How it works</a></li>
                        <li><a href="#why-skilllink" class="hover:text-blue-600 transition-colors">Why SkillLink</a></li>
                        <li><a href="#ecosystem" class="hover:text-blue-600 transition-colors">The ecosystem</a></li>
                        <li><a href="#reviews" class="hover:text-blue-600 transition-colors">Verified reviews</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Workspaces</h3>
                    <ul class="mt-4 space-y-2 text-xs text-slate-600">
                        <li><a href="{{ route('register') }}" class="hover:text-blue-600 transition-colors">Client Portal</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-blue-600 transition-colors">Freelancer Directory</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-blue-600 transition-colors">Sign in</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-blue-600 transition-colors">Admin Console</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Trust &amp; Security</h3>
                    <ul class="mt-4 space-y-2 text-xs text-slate-600">
                        <li><span class="text-slate-500">Role-based Access</span></li>
                        <li><span class="text-slate-500">Milestone Protection</span></li>
                        <li><span class="text-slate-500">Mutual Ratings</span></li>
                        <li><span class="text-slate-500">Morocco (MAD) Support</span></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 border-t border-slate-100 pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between text-xs text-slate-400 gap-3">
                <p>&copy; {{ date('Y') }} SkillLink. All rights reserved.</p>
                <p class="text-[11px]">Engineered for verified clients and professional freelancers.</p>
            </div>
        </div>
    </footer>
</body>
</html>
