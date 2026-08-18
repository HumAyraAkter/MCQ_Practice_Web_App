<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeyHumayra_MCQ_App</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #09090b;
            --surface: #131217;
            --surface-2: #1c1a22;
            --gold: #c9a24d;
            --gold-light: #ecd28c;
            --gold-dim: #6f5a2c;
            --ink: #f3efe6;
            --ink-dim: #a39d8f;
            --border: rgba(201, 162, 77, 0.16);
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--ink);
            font-family: 'Manrope', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        .font-display {
            font-family: 'Fraunces', serif;
            font-optical-sizing: auto;
        }

        /* ===== Ambient background glow ===== */
        .glow-orb {
            position: fixed;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,162,77,0.14) 0%, rgba(201,162,77,0) 70%);
            pointer-events: none;
            z-index: 0;
        }
        .glow-orb.one { top: -200px; right: -150px; }
        .glow-orb.two { bottom: -250px; left: -200px; background: radial-gradient(circle, rgba(201,162,77,0.08) 0%, rgba(201,162,77,0) 70%); }

        .grain-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201,162,77,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,162,77,0.035) 1px, transparent 1px);
            background-size: 64px 64px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
            pointer-events: none;
            z-index: 0;
        }

        /* ===== Navbar ===== */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(14px);
            background: rgba(9, 9, 11, 0.72);
            border-bottom: 1px solid var(--border);
        }

        .logo-mark {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1.5px solid var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            flex-shrink: 0;
        }
        .logo-mark svg { width: 16px; height: 16px; }

        .btn-ghost {
            color: var(--ink);
            border: 1px solid rgba(243,239,230,0.18);
            transition: border-color .2s ease, color .2s ease, background .2s ease;
        }
        .btn-ghost:hover { border-color: var(--gold); color: var(--gold-light); background: rgba(201,162,77,0.06); }

        .btn-gold {
            background: linear-gradient(180deg, var(--gold-light), var(--gold));
            color: #1a1408;
            font-weight: 700;
            box-shadow: 0 6px 20px -6px rgba(201,162,77,0.55);
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }
        .btn-gold:hover { transform: translateY(-1px); box-shadow: 0 10px 26px -6px rgba(201,162,77,0.7); filter: brightness(1.05); }

        a, button { outline-offset: 3px; }
        a:focus-visible, button:focus-visible { outline: 2px solid var(--gold); }

        /* ===== Hero copy entrance ===== */
        @media (prefers-reduced-motion: no-preference) {
            .fade-up { animation: fadeUp .8s ease both; }
            .fade-up.d1 { animation-delay: .08s; }
            .fade-up.d2 { animation-delay: .18s; }
            .fade-up.d3 { animation-delay: .28s; }
            .fade-up.d4 { animation-delay: .4s; }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .eyebrow {
            letter-spacing: .18em;
        }

        /* ===== Answer Stack (signature element) ===== */
        .stack-wrap {
            position: relative;
            width: 100%;
            max-width: 300px;
            height: 300px;
            margin: 0 auto;
            perspective: 1000px;
        }
        .stack-card {
            position: absolute;
            inset: 0;
            margin: auto;
            width: 240px;
            height: 148px;
            top: 76px;
            border-radius: 18px;
            background: linear-gradient(155deg, var(--surface-2), var(--surface));
            border: 1px solid rgba(201,162,77,0.22);
            box-shadow: 0 20px 40px -18px rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 22px;
        }
        .stack-card .letter {
            font-family: 'Fraunces', serif;
            font-size: 34px;
            font-weight: 600;
            color: var(--gold-light);
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 1.5px solid rgba(201,162,77,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .stack-card .lines { flex: 1; }
        .stack-card .lines span {
            display: block;
            height: 8px;
            border-radius: 4px;
            background: rgba(243,239,230,0.1);
            margin-bottom: 8px;
        }
        .stack-card .lines span:nth-child(1) { width: 90%; }
        .stack-card .lines span:nth-child(2) { width: 60%; margin-bottom: 0; }

        .stack-card .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            box-shadow: 0 0 0 4px var(--bg), 0 0 22px rgba(201,162,77,0.7);
        }
        .stack-card .badge svg { width: 15px; height: 15px; stroke: #1a1408; }

        @media (prefers-reduced-motion: no-preference) {
            .stack-card {
                animation: cycleCard 9s cubic-bezier(.6,0,.4,1) infinite;
            }
            .stack-card:nth-child(1) { animation-delay: 0s; }
            .stack-card:nth-child(2) { animation-delay: -2.25s; }
            .stack-card:nth-child(3) { animation-delay: -4.5s; }
            .stack-card:nth-child(4) { animation-delay: -6.75s; }

            .stack-card .badge { animation: badgePulse 9s ease infinite; }
            .stack-card:nth-child(1) .badge { animation-delay: 0s; }
            .stack-card:nth-child(2) .badge { animation-delay: -2.25s; }
            .stack-card:nth-child(3) .badge { animation-delay: -4.5s; }
            .stack-card:nth-child(4) .badge { animation-delay: -6.75s; }
        }

        @keyframes cycleCard {
            0%   { transform: translateY(0) scale(1) rotate(0deg);      z-index: 4; opacity: 1; }
            9%   { transform: translateY(0) scale(1) rotate(0deg);      z-index: 4; opacity: 1; }
            26%  { transform: translateY(34px) scale(0.93) rotate(-5deg); z-index: 1; opacity: 0.55; }
            49%  { transform: translateY(52px) scale(0.86) rotate(-7deg); z-index: 1; opacity: 0; }
            51%  { transform: translateY(-46px) scale(0.86) rotate(7deg); z-index: 1; opacity: 0; }
            74%  { transform: translateY(-14px) scale(0.9) rotate(4deg);  z-index: 2; opacity: 0.5; }
            91%  { transform: translateY(-3px) scale(0.96) rotate(1deg); z-index: 3; opacity: 0.85; }
            100% { transform: translateY(0) scale(1) rotate(0deg);      z-index: 4; opacity: 1; }
        }
        @keyframes badgePulse {
            0%   { opacity: 0; transform: scale(.6); }
            4%   { opacity: 1; transform: scale(1); }
            9%   { opacity: 1; transform: scale(1); }
            14%  { opacity: 0; transform: scale(.8); }
            100% { opacity: 0; }
        }

        /* ===== Category marquee ===== */
        .marquee-track {
            display: flex;
            gap: 12px;
            width: max-content;
        }
        @media (prefers-reduced-motion: no-preference) {
            .marquee-track { animation: marquee 26s linear infinite; }
        }
        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .pill {
            border: 1px solid var(--border);
            color: var(--ink-dim);
            white-space: nowrap;
            border-radius: 999px;
            padding: 8px 18px;
            font-size: 13px;
        }

        /* ===== Feature cards ===== */
        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            transition: border-color .25s ease, transform .25s ease;
        }
        .feature-card:hover { border-color: rgba(201,162,77,0.45); transform: translateY(-3px); }
        .feature-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            border: 1px solid rgba(201,162,77,0.3);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-light);
        }
    </style>
</head>
<body class="antialiased">

    <div class="glow-orb one"></div>
    <div class="glow-orb two"></div>
    <div class="grain-grid"></div>

    <!-- ===== Navbar ===== -->
    <header class="navbar">
        <div class="max-w-6xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span class="logo-mark">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" style="color: var(--gold)">
                        <path d="M5 12l4 4L19 6" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="font-display text-xl tracking-tight" style="color: var(--ink)">
                    Codey<span style="color: var(--gold-light)">Humayra</span>
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm" style="color: var(--ink-dim)">
                <a href="#features" class="hover:text-[var(--gold-light)] transition-colors">Features</a>
                <a href="#categories" class="hover:text-[var(--gold-light)] transition-colors">Categories</a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-gold px-5 py-2.5 rounded-lg text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost px-4 py-2.5 rounded-lg text-sm hidden sm:inline-block">Log in</a>
                    <a href="{{ route('register') }}" class="btn-gold px-5 py-2.5 rounded-lg text-sm">Get Started</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ===== Hero ===== -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 pt-20 pb-16 grid md:grid-cols-2 gap-14 items-center">
        <div>
            <p class="eyebrow fade-up d1 text-xs font-bold uppercase" style="color: var(--gold)">MCQ Exam Practice Platform</p>

            <h1 class="fade-up d2 font-display text-5xl md:text-6xl leading-[1.08] mt-5" style="color: var(--ink)">
                Master every subject,<br>
                <span style="color: var(--gold-light)">one question</span> at a time.
            </h1>

            <p class="fade-up d3 mt-6 text-lg leading-relaxed max-w-md" style="color: var(--ink-dim)">
                Timed mock tests, instant explanations, and a dashboard that tracks
                every attempt — built to help you walk into the real exam with confidence.
            </p>

            <div class="fade-up d4 mt-9 flex flex-wrap items-center gap-4">
                @auth
                    <a href="{{ route('exams.index') }}" class="btn-gold px-7 py-3.5 rounded-lg text-sm">Browse Exams</a>
                @else
                    <a href="{{ route('register') }}" class="btn-gold px-7 py-3.5 rounded-lg text-sm">Start practicing free</a>
                    <a href="#features" class="btn-ghost px-7 py-3.5 rounded-lg text-sm">See how it works</a>
                @endauth
            </div>
        </div>

        <!-- Signature element: The Answer Stack -->
        <div class="stack-wrap" aria-hidden="true">
            <div class="stack-card">
                <span class="badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round"><path d="M5 12l4 4L19 6"/></svg></span>
                <span class="letter">A</span>
                <span class="lines"><span></span><span></span></span>
            </div>
            <div class="stack-card">
                <span class="badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round"><path d="M5 12l4 4L19 6"/></svg></span>
                <span class="letter">B</span>
                <span class="lines"><span></span><span></span></span>
            </div>
            <div class="stack-card">
                <span class="badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round"><path d="M5 12l4 4L19 6"/></svg></span>
                <span class="letter">C</span>
                <span class="lines"><span></span><span></span></span>
            </div>
            <div class="stack-card">
                <span class="badge"><svg viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round"><path d="M5 12l4 4L19 6"/></svg></span>
                <span class="letter">D</span>
                <span class="lines"><span></span><span></span></span>
            </div>
        </div>
    </section>

    <!-- ===== Category marquee ===== -->
    <section id="categories" class="relative z-10 border-y py-6 overflow-hidden" style="border-color: var(--border)">
        <div class="marquee-track">
            @php
                $cats = ['Bangla', 'English', 'Mathematics', 'General Knowledge', 'ICT', 'BCS Preliminary', 'Admission Test', 'Science', 'Bangla', 'English', 'Mathematics', 'General Knowledge', 'ICT', 'BCS Preliminary', 'Admission Test', 'Science'];
            @endphp
            @foreach ($cats as $cat)
                <span class="pill">{{ $cat }}</span>
            @endforeach
        </div>
    </section>

    <!-- ===== Features ===== -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-24">
        <p class="eyebrow text-xs font-bold uppercase" style="color: var(--gold)">Why CodeyHumayra</p>
        <h2 class="font-display text-3xl md:text-4xl mt-3 max-w-lg" style="color: var(--ink)">
            Everything you need to walk in prepared.
        </h2>

        <div class="grid md:grid-cols-3 gap-5 mt-12">
            <div class="feature-card p-7">
                <div class="feature-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                </div>
                <h3 class="font-display text-xl mt-5" style="color: var(--ink)">Timed Mock Exams</h3>
                <p class="mt-2 text-sm leading-relaxed" style="color: var(--ink-dim)">
                    Sit for full-length exams with a live countdown and real exam pressure — negative marking included.
                </p>
            </div>

            <div class="feature-card p-7">
                <div class="feature-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
                </div>
                <h3 class="font-display text-xl mt-5" style="color: var(--ink)">Instant Explanations</h3>
                <p class="mt-2 text-sm leading-relaxed" style="color: var(--ink-dim)">
                    Every question comes with a clear explanation, right after you submit — no more guessing why you missed it.
                </p>
            </div>

            <div class="feature-card p-7">
                <div class="feature-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19h16M8 19V9m4 10V5m4 14v-7"/></svg>
                </div>
                <h3 class="font-display text-xl mt-5" style="color: var(--ink)">Track Your Progress</h3>
                <p class="mt-2 text-sm leading-relaxed" style="color: var(--ink-dim)">
                    See your pass rate, score trends, and bookmarked questions — all in one dashboard.
                </p>
            </div>
        </div>
    </section>

    <!-- ===== CTA band ===== -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="rounded-3xl p-12 text-center" style="background: linear-gradient(160deg, var(--surface-2), var(--surface)); border: 1px solid var(--border);">
            <h2 class="font-display text-3xl md:text-4xl" style="color: var(--ink)">Ready to start practicing?</h2>
            <p class="mt-3" style="color: var(--ink-dim)">Create a free account — no card required.</p>
            @guest
                <a href="{{ route('register') }}" class="btn-gold inline-block mt-7 px-8 py-3.5 rounded-lg text-sm">Create free account</a>
            @endguest
        </div>
    </section>

    <!-- ===== Footer ===== -->
    <footer class="relative z-10 border-t" style="border-color: var(--border)">
        <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm" style="color: var(--ink-dim)">
            <span class="font-display" style="color: var(--ink)">CodeyHumayra</span>
            <span>&copy; {{ date('Y') }} CodeyHumayra. Built for students who don't leave prep to chance.</span>
        </div>
    </footer>

</body>
</html>