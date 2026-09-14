<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SkillLink connects clients with qualified freelancers and helps teams move missions from brief to completion.">
    <title>SkillLink · Turn ideas into real results</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-x-hidden bg-[var(--paper)]">
    <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5" aria-label="SkillLink home">
            <span class="relative flex h-9 w-9 items-center justify-center rounded-xl bg-[var(--blue)]"><span class="absolute h-2.5 w-2.5 -translate-x-1.5 rounded-full bg-white"></span><span class="absolute h-2.5 w-2.5 translate-x-1.5 rounded-full bg-[var(--mint)]"></span><span class="absolute h-0.5 w-5 bg-white"></span></span>
            <span class="text-xl font-bold tracking-tight text-[var(--ink)]">Skill<span class="text-[var(--blue)]">Link</span></span>
        </a>
        <nav class="hidden items-center gap-8 text-sm font-semibold text-[var(--muted)] md:flex"><a href="#how-it-works" class="transition hover:text-[var(--ink)]">How it works</a><a href="#ecosystem" class="transition hover:text-[var(--ink)]">The ecosystem</a><a href="{{ route('login') }}" class="transition hover:text-[var(--ink)]">Sign in</a></nav>
        <a href="{{ route('register') }}" class="sl-button-primary">Create account <span aria-hidden="true">↗</span></a>
    </header>

    <main>
        <section class="mx-auto grid max-w-7xl items-center gap-14 px-6 pb-20 pt-12 lg:grid-cols-[.95fr_1.05fr] lg:px-10 lg:pb-28 lg:pt-20">
            <div class="sl-reveal max-w-2xl">
                <p class="sl-kicker mb-6">The professional link between work and skill</p>
                <h1 class="text-5xl font-bold leading-[1.04] tracking-[-0.055em] text-[var(--ink)] sm:text-6xl lg:text-[5.2rem]">Turn ideas into <span class="text-[var(--blue)]">real results.</span></h1>
                <p class="mt-7 max-w-xl text-lg leading-8 text-[var(--muted)]">SkillLink connects clients with qualified freelancers and keeps every mission moving from a clear brief to a trusted result.</p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row"><a href="{{ route('register') }}" class="sl-button-primary">Find a freelancer <span aria-hidden="true">→</span></a><a href="{{ route('register') }}" class="sl-button-secondary">Publish a mission</a></div>
                <div class="mt-10 flex items-center gap-3 border-t border-[var(--line)] pt-5 text-sm text-[var(--muted)]"><span class="flex h-9 w-9 items-center justify-center rounded-full border border-blue-100 bg-blue-50 text-[var(--blue)]">✓</span><span><strong class="text-[var(--ink)]">Built for real collaboration.</strong><br>Clear missions, thoughtful offers, confident decisions.</span></div>
            </div>

            <div id="ecosystem" class="sl-reveal-delay relative overflow-hidden rounded-[2rem] border border-[#dfe5f2] bg-white px-5 py-8 shadow-[0_24px_80px_rgba(23,35,61,.08)] sm:px-10 sm:py-10">
                <div class="absolute right-0 top-0 h-40 w-40 border-l border-b border-blue-100"></div><div class="absolute bottom-0 left-0 h-28 w-28 border-r border-t border-blue-100"></div>
                <div class="relative flex items-center justify-between"><div><p class="sl-kicker">The SkillLink connection</p><h2 class="mt-2 text-2xl font-bold text-[var(--ink)]">One mission. The right people.</h2></div><span class="font-mono text-xs text-slate-400">01 — 05</span></div>
                <svg class="relative mt-8 h-[330px] w-full" viewBox="0 0 560 330" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Client and freelancer connected through a SkillLink mission">
                    <path d="M92 86C168 86 184 164 270 164M290 164C376 164 392 86 468 86M290 184C376 184 386 264 468 264" stroke="#B8C7EE" stroke-width="2" stroke-dasharray="5 7"/>
                    <circle cx="280" cy="174" r="57" fill="#EEF2FF" stroke="#9BB0EF" stroke-width="2"/><circle cx="280" cy="174" r="38" fill="white" stroke="#3859E8" stroke-width="2"/>
                    <path d="M267 174h26M280 161v26" stroke="#3859E8" stroke-width="2.5" stroke-linecap="round"/><path d="M273 168l-7 7 7 7M287 168l7 7-7 7" stroke="#3859E8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <rect x="24" y="47" width="136" height="78" rx="14" fill="white" stroke="#E3E8F3"/><circle cx="53" cy="86" r="20" fill="#17233D"/><path d="M45 82h16v13H45zM48 79h10" stroke="white" stroke-width="2" stroke-linecap="round"/><text x="84" y="82" fill="#667085" font-size="11" font-family="DM Sans">CLIENT</text><text x="84" y="101" fill="#17233D" font-size="13" font-weight="700" font-family="DM Sans">A clear brief</text>
                    <rect x="400" y="47" width="136" height="78" rx="14" fill="white" stroke="#E3E8F3"/><circle cx="429" cy="86" r="20" fill="#B9F1DC"/><circle cx="429" cy="81" r="5" stroke="#17233D" stroke-width="2"/><path d="M420 96c2-8 16-8 18 0" stroke="#17233D" stroke-width="2" stroke-linecap="round"/><text x="460" y="82" fill="#667085" font-size="11" font-family="DM Sans">FREELANCER</text><text x="460" y="101" fill="#17233D" font-size="13" font-weight="700" font-family="DM Sans">The right skill</text>
                    <rect x="212" y="140" width="136" height="68" rx="14" fill="#3859E8"/><path d="M238 161h14v19h-14zM241 157h8" stroke="white" stroke-width="2" stroke-linecap="round"/><text x="266" y="169" fill="#C8D5FF" font-size="10" font-family="DM Sans">MISSION</text><text x="266" y="188" fill="white" font-size="12" font-weight="700" font-family="DM Sans">A focused outcome</text>
                    <rect x="400" y="225" width="136" height="78" rx="14" fill="#F8FAFD" stroke="#E3E8F3"/><circle cx="429" cy="264" r="20" fill="#E8F8F1"/><path d="m419 264 7 7 13-15" stroke="#18845A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><text x="460" y="260" fill="#667085" font-size="11" font-family="DM Sans">RESULT</text><text x="460" y="279" fill="#17233D" font-size="13" font-weight="700" font-family="DM Sans">Trust earned</text>
                    <circle cx="92" cy="86" r="4" fill="#3859E8"/><circle cx="468" cy="86" r="4" fill="#3859E8"/><circle cx="468" cy="264" r="4" fill="#18845A"/>
                </svg>
                <div class="flex items-center justify-between border-t border-[var(--line)] pt-5 text-xs text-[var(--muted)]"><span>Brief → match → delivery</span><span class="font-bold text-[var(--blue)]">Made visible</span></div>
            </div>
        </section>

        <section id="how-it-works" class="border-y border-[var(--line)] bg-white px-6 py-20 lg:px-10"><div class="mx-auto max-w-7xl"><div class="flex flex-col justify-between gap-5 md:flex-row md:items-end"><div class="max-w-xl"><p class="sl-kicker">How it works</p><h2 class="mt-3 text-3xl font-bold tracking-tight text-[var(--ink)] sm:text-4xl">A simpler path from need to done.</h2></div><p class="max-w-sm text-sm leading-6 text-[var(--muted)]">Every step is designed to make professional collaboration clearer, faster and more human.</p></div><div class="mt-12 grid gap-8 border-t border-[var(--line)] pt-8 md:grid-cols-4"><div><span class="font-mono text-sm text-[var(--blue)]">01</span><div class="mt-5 flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[var(--blue)]"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 5h16v14H4zM8 9h8M8 13h5"/></svg></div><h3 class="mt-4 text-lg font-bold text-[var(--ink)]">Publish a mission</h3><p class="mt-2 text-sm leading-6 text-[var(--muted)]">Share the outcome, budget and deadline.</p></div><div><span class="font-mono text-sm text-[var(--blue)]">02</span><div class="mt-5 flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[var(--blue)]"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m20 20-4.5-4.5M10.5 17a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13Z"/></svg></div><h3 class="mt-4 text-lg font-bold text-[var(--ink)]">Receive applications</h3><p class="mt-2 text-sm leading-6 text-[var(--muted)]">Meet freelancers whose skills fit the work.</p></div><div><span class="font-mono text-sm text-[var(--blue)]">03</span><div class="mt-5 flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[var(--blue)]"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3 4 7l8 4 8-4-8-4ZM4 12l8 4 8-4M4 17l8 4 8-4"/></svg></div><h3 class="mt-4 text-lg font-bold text-[var(--ink)]">Choose the right fit</h3><p class="mt-2 text-sm leading-6 text-[var(--muted)]">Compare offers and make a confident choice.</p></div><div><span class="font-mono text-sm text-[var(--blue)]">04</span><div class="mt-5 flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m5 12 4 4L19 6"/></svg></div><h3 class="mt-4 text-lg font-bold text-[var(--ink)]">Complete the mission</h3><p class="mt-2 text-sm leading-6 text-[var(--muted)]">Finish strong and build lasting trust.</p></div></div></div></section>
    </main>
    <footer class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-8 text-sm text-[var(--muted)] sm:flex-row sm:items-center sm:justify-between lg:px-10"><span>© {{ date('Y') }} SkillLink</span><span>The right skill for the right mission.</span></footer>
</body>
</html>
