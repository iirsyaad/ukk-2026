@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Sakuci v1.0.0</span>

        <h1 class="display-5 fw-bold mb-3">
         Aplikasi Peminjaman Alat<br class="d-none d-md-inline">
            <span class="text@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- ============ TEMA & GAYA HALAMAN ============ --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --sky-50:  #F0F9FF;
            --sky-100: #E0F2FE;
            --sky-300: #7DD3FC;
            --sky-400: #38BDF8;
            --sky-500: #0EA5E9;
            --sky-600: #0284C7;
            --sky-700: #0369A1;
            --navy-900:#0C4A6E;
            --navy-950:#082F49;
            --amber-400:#FBBF24;
            --amber-500:#F59E0B;
            --white:   #FFFFFF;
            --font-head: 'Archivo Black', 'Plus Jakarta Sans', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
        }

        body{ background: var(--sky-50); font-family: var(--font-body); }
        h1, h2, h3{ font-family: var(--font-head); letter-spacing: -0.01em; }

        /* ================= HERO ================= */
        .hero-sport{
            position: relative;
            overflow: hidden;
            border-radius: 26px;
            background: var(--sky-500);
            isolation: isolate;
            padding: 3.2rem 1.5rem 0;
        }
        /* diagonal navy energy panel */
        .hero-sport::before{
            content: "";
            position: absolute;
            inset: 0;
            background: var(--navy-950);
            clip-path: polygon(0 38%, 100% 0%, 100% 100%, 0% 100%);
            z-index: 0;
        }
        /* halftone dot texture on the blue portion */
        .hero-sport::after{
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.35) 1.5px, transparent 1.5px);
            background-size: 16px 16px;
            clip-path: polygon(0 0, 100% 0, 100% 38%, 0 62%);
            z-index: 0;
        }

        .hero-inner{
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 2rem;
            align-items: center;
        }
        @media (max-width: 991px){
            .hero-inner{ grid-template-columns: 1fr; text-align: center; }
        }

        .kicker-tag{
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--amber-400);
            color: var(--navy-950);
            font-weight: 800;
            font-size: .78rem;
            padding: .35rem .9rem;
            border-radius: 999px;
            margin-bottom: 1.1rem;
        }
        .kicker-tag .dot{ width: 7px; height: 7px; border-radius: 50%; background: var(--navy-950); }

        .hero-sport h1{
            color: var(--white);
            font-size: clamp(2.1rem, 4.2vw, 3.4rem);
            line-height: 1.05;
            margin-bottom: 1rem;
        }
        .hero-sport h1 .accent{ color: var(--amber-400); }

        .hero-sport .lead{
            color: rgba(255,255,255,.82);
            font-size: 1.08rem;
            max-width: 480px;
            margin-bottom: 1.6rem;
        }
        @media (max-width: 991px){ .hero-sport .lead{ margin-inline: auto; } }

        .btn-brand{
            background: var(--amber-400);
            color: var(--navy-950);
            border: none;
            font-weight: 700;
            border-radius: 12px;
            padding: .75rem 1.6rem;
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .btn-brand:hover{ transform: translateY(-2px); box-shadow: 0 10px 22px rgba(251,191,36,.35); color: var(--navy-950); }

        .btn-outline-brand{
            background: transparent;
            color: var(--white);
            border: 1.5px solid rgba(255,255,255,.55);
            font-weight: 700;
            border-radius: 12px;
            padding: .75rem 1.6rem;
            transition: background .15s ease, transform .15s ease;
        }
        .btn-outline-brand:hover{ background: rgba(255,255,255,.14); color: var(--white); transform: translateY(-2px); }

        .hero-note{ color: rgba(255,255,255,.65); font-size: .85rem; margin-top: 1rem; }
        .hero-note code{ background: rgba(255,255,255,.15); color: #fff; padding: .1rem .4rem; border-radius: 6px; }

        /* ---- badge collage ---- */
        .badge-collage{
            position: relative;
            height: 320px;
        }
        @media (max-width: 991px){ .badge-collage{ height: 220px; max-width: 340px; margin-inline: auto; } }

        .sport-badge{
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 14px 24px rgba(0,0,0,.25);
        }
        .sport-badge svg{ width: 46%; height: 46%; }

        .badge-ball    { width: 150px; height: 150px; background: var(--white); color: var(--sky-600); top: 4%;  left: 6%;  transform: rotate(-8deg); }
        .badge-whistle { width: 96px;  height: 96px;  background: var(--amber-400); color: var(--navy-950); top: 0; right: 8%; transform: rotate(10deg); }
        .badge-racket  { width: 110px; height: 110px; background: var(--sky-300); color: var(--navy-950); bottom: 10%; left: 0; transform: rotate(6deg); }
        .badge-dumbbell{ width: 128px; height: 128px; background: var(--navy-900); color: var(--white); bottom: 0; right: 4%; transform: rotate(-6deg); }

        .stat-float{
            position: absolute;
            left: 50%;
            bottom: 6%;
            transform: translateX(-50%);
            background: var(--white);
            border-radius: 16px;
            padding: .85rem 1.3rem;
            box-shadow: 0 16px 30px rgba(8,47,73,.28);
            text-align: center;
            min-width: 150px;
        }
        @media (max-width: 991px){ .stat-float{ position: static; transform: none; margin: 1rem auto 0; } }
        .stat-float .num{ font-family: var(--font-head); font-size: 1.6rem; color: var(--sky-600); line-height: 1; }
        .stat-float .label{ font-size: .75rem; color: var(--navy-900); font-weight: 600; }

        /* ================= SCOREBOARD STRIP ================= */
        .scoreboard{
            position: relative;
            z-index: 1;
            background: var(--navy-950);
            border-radius: 18px;
            margin-top: -1.6rem;
            padding: 1.4rem 1rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: .5rem;
        }
        @media (max-width: 767px){ .scoreboard{ grid-template-columns: repeat(2, 1fr); row-gap: 1.2rem; } }
        .scoreboard .item{ text-align: center; border-right: 1px solid rgba(255,255,255,.12); padding: 0 .5rem; }
        .scoreboard .item:last-child, .scoreboard .item:nth-child(2){ border-right: none; }
        @media (min-width: 768px){ .scoreboard .item:nth-child(2){ border-right: 1px solid rgba(255,255,255,.12); } }
        .scoreboard .item .num{ font-family: var(--font-head); color: var(--amber-400); font-size: 1.7rem; }
        .scoreboard .item .label{ color: rgba(255,255,255,.75); font-size: .78rem; font-weight: 500; }

        /* single orchestrated entrance for the hero block */
        @media (prefers-reduced-motion: no-preference){
            .hero-inner, .scoreboard{ animation: rise .6s ease-out both; }
            .scoreboard{ animation-delay: .1s; }
            @keyframes rise{ from{ opacity: 0; transform: translateY(14px); } to{ opacity: 1; transform: translateY(0); } }
        }

        /* ================= SECTION HEADERS ================= */
        .section-head{
            display: flex;
            align-items: baseline;
            gap: .6rem;
            margin-bottom: 1.4rem;
        }
        .section-head .tag-num{
            font-family: var(--font-head);
            color: var(--white);
            background: var(--sky-500);
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }
        .section-head h2{ font-size: 1.35rem; color: var(--navy-950); margin: 0; }

        /* ================= CARDS ================= */
        .card{ border-radius: 18px; }
        .card.border-0.shadow-sm{ box-shadow: 0 8px 24px rgba(2,132,199,.1) !important; }

        .step-number{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px; height: 34px;
            border-radius: 10px;
            background: var(--sky-100);
            color: var(--sky-700);
            font-family: var(--font-head);
            font-size: .95rem;
            flex-shrink: 0;
        }

        pre.code{
            background: var(--navy-950);
            color: #E0F2FE;
            border-radius: 14px;
            padding: 1rem 1.1rem;
            font-size: .85rem;
            overflow-x: auto;
        }
        pre.code .cmt{ color: var(--sky-300); }
        code.inline{
            background: var(--sky-100);
            color: var(--sky-700);
            padding: .15rem .4rem;
            border-radius: 6px;
            font-size: .85em;
        }

        .pillar-card{
            position: relative;
            border-top: none !important;
            overflow: hidden;
        }
        .pillar-card::before{
            content: attr(data-index);
            position: absolute;
            top: 0; right: 0;
            width: 44px; height: 44px;
            background: var(--amber-400);
            color: var(--navy-950);
            font-family: var(--font-head);
            font-size: 1rem;
            display: flex; align-items: center; justify-content: center;
            clip-path: polygon(0 0, 100% 0, 100% 100%);
        }
    </style>

    {{-- Hero --}}
    <section class="hero-sport mb-0">
        <div class="hero-inner">
            <div>
                <span class="kicker-tag"><span class="dot"></span>Sakuci v1.0.0</span>

                <h1>
                    Pinjam Alat Olahraga,<br>
                    <span class="accent">Tanpa Ribet.</span>
                </h1>

                <p class="lead">
                    Icud Hodakss nyediain alat olahraga lengkap yang bisa kamu pinjam kapan aja —
                    bola, raket, sampai alat fitness. Cek stok, booking, kembalikan, semua tercatat rapi dalam satu sistem.
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-brand btn-lg" href="{{route('login')}}">Masuk</a>
                    <a class="btn btn-outline-brand btn-lg" href="{{route('alat.index')}}" target="_blank">Lihat Alat</a>
                </div>

                <p class="hero-note">
                    Panduan langkah demi langkah ada di berkas <code>TUTORIAL.md</code>
                </p>
            </div>

            <div class="badge-collage">
                <div class="sport-badge badge-ball" aria-hidden="true">
                    <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="4">
                        <circle cx="50" cy="50" r="42"/>
                        <path d="M50 8 C 32 30, 32 70, 50 92"/>
                        <path d="M50 8 C 68 30, 68 70, 50 92"/>
                        <path d="M10 38 C 32 46, 68 46, 90 38"/>
                        <path d="M10 62 C 32 54, 68 54, 90 62"/>
                    </svg>
                </div>
                <div class="sport-badge badge-whistle" aria-hidden="true">
                    <svg viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="5">
                        <circle cx="26" cy="30" r="22"/>
                        <rect x="44" y="18" width="48" height="24" rx="12"/>
                        <line x1="26" y1="8" x2="26" y2="16"/>
                    </svg>
                </div>
                <div class="sport-badge badge-racket" aria-hidden="true">
                    <svg viewBox="0 0 60 110" fill="none" stroke="currentColor" stroke-width="4">
                        <ellipse cx="30" cy="32" rx="22" ry="28"/>
                        <line x1="30" y1="60" x2="30" y2="104"/>
                        <line x1="15" y1="18" x2="45" y2="46"/>
                        <line x1="15" y1="46" x2="45" y2="18"/>
                    </svg>
                </div>
                <div class="sport-badge badge-dumbbell" aria-hidden="true">
                    <svg viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="5">
                        <rect x="4" y="18" width="16" height="24" rx="3"/>
                        <rect x="80" y="18" width="16" height="24" rx="3"/>
                        <line x1="20" y1="30" x2="80" y2="30"/>
                    </svg>
                </div>

                <div class="stat-float">
                    <div class="num">120+</div>
                    <div class="label">Alat Siap Pinjam</div>
                </div>
            </div>
        </div>

        <div class="scoreboard">
            <div class="item"><div class="num">120+</div><div class="label">Alat Tersedia</div></div>
            <div class="item"><div class="num">8</div><div class="label">Kategori Olahraga</div></div>
            <div class="item"><div class="num">24/7</div><div class="label">Booking Online</div></div>
            <div class="item"><div class="num">3 Menit</div><div class="label">Proses Pinjam</div></div>
        </div>
    </section>

    <div style="height: 2.2rem;"></div>

    {{-- Instalasi --}}
    <section class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="section-head">
                    <span class="tag-num">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M12 3v12m0 0l-4-4m4 4l4-4M4 21h16"/></svg>
                    </span>
                    <h2>Instalasi</h2>
                </div>

                <p class="text-secondary mb-3">Pilih salah satu cara untuk memulai:</p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <h3 class="h6 fw-medium mb-2">Dari GitHub</h3>
                        <pre class="code"><span class="cmt"># Clone repository</span>
git clone https://github.com/indrabsus/sakuci-framework.git
cd sakuci-framework

<span class="cmt"># Siapkan .env</span>
cp .env.example .env

<span class="cmt"># Jalankan server</span>
php sakuci serve</pre>
                    </div>

                    <div class="col-md-6">
                        <h3 class="h6 fw-medium mb-2">Manual</h3>
                        <ol class="mb-0 ps-4">
                            <li>Download folder dari <a href="https://github.com/indrabsus/sakuci-framework" target="_blank">GitHub</a></li>
                            <li>Ekstrak ke folder proyek</li>
                            <li>Salin <code class="inline">.env.example</code> jadi <code class="inline">.env</code></li>
                            <li>Jalankan <code class="inline">php sakuci serve</code></li>
                            <li>Buka <code class="inline">http://127.0.0.1:8000</code></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Langkah berikutnya --}}
    <section id="langkah" class="row g-4 align-items-start mb-5">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="section-head">
                        <span class="tag-num">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M9 18l6-6-6-6"/></svg>
                        </span>
                        <h2>Langkah berikutnya</h2>
                    </div>

                    <ul class="list-unstyled d-grid gap-3 mb-0">
                        <li class="d-flex gap-3">
                            <span class="step-number">1</span>
                            <div>
                                <div class="fw-medium">Atur koneksi database</div>
                                <div class="text-secondary small">
                                    Edit berkas <code class="inline">.env</code>, lalu uji dengan
                                    <code class="inline">php sakuci db:check</code>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex gap-3">
                            <span class="step-number">2</span>
                            <div>
                                <div class="fw-medium">Buat tabel</div>
                                <div class="text-secondary small">
                                    <code class="inline">php sakuci make:migration create_buku_table</code>
                                    lalu <code class="inline">php sakuci migrate</code>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex gap-3">
                            <span class="step-number">3</span>
                            <div>
                                <div class="fw-medium">Buat model, controller, dan view</div>
                                <div class="text-secondary small">
                                    <code class="inline">make:model</code>,
                                    <code class="inline">make:controller</code>,
                                    <code class="inline">make:view</code>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex gap-3">
                            <span class="step-number">4</span>
                            <div>
                                <div class="fw-medium">Daftarkan route</div>
                                <div class="text-secondary small">
                                    Tulis di <code class="inline">routes/web.php</code>, cek dengan
                                    <code class="inline">php sakuci route:list</code>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="section-head">
                        <span class="tag-num">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M4 17V7a2 2 0 012-2h12a2 2 0 012 2v10M4 17l2 3h12l2-3M4 17h16"/></svg>
                        </span>
                        <h2>Perintah favorit</h2>
                    </div>

                    <pre class="code"><span class="cmt"># jalankan server</span>
php sakuci serve

<span class="cmt"># uji koneksi database</span>
php sakuci db:check

<span class="cmt"># lihat semua route</span>
php sakuci route:list

<span class="cmt"># bantuan lengkap</span>
php sakuci</pre>
                </div>
            </div>
        </div>
    </section>

    {{-- Empat pilar --}}
    <section class="mb-4">
        <div class="section-head">
            <span class="tag-num">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            </span>
            <h2>Empat pilar</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card pillar-card border-0 shadow-sm h-100" data-index="01">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Route</span>
                        <span class="text-secondary small ms-1">routes/web.php</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">Route::get('/buku',
    [BukuController::class, 'index'])
    ->name('buku.index');

<span class="cmt">// 7 route CRUD sekaligus</span>
Route::resource('buku',
    BukuController::class);</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card pillar-card border-0 shadow-sm h-100" data-index="02">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Controller</span>
                        <span class="text-secondary small ms-1">app/Controllers</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">class BukuController extends Controller
{
    public function index()
    {
        return view('buku.index', [
            'buku' => Buku::all(),
        ]);
    }
}</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card pillar-card border-0 shadow-sm h-100" data-index="03">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Model</span>
                        <span class="text-secondary small ms-1">app/Models</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">Buku::all();
Buku::find(1);
Buku::where('stok', '>', 0)
    ->latest()
    ->paginate(10);

Buku::create(['judul' => 'PHP']);</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card pillar-card border-0 shadow-sm h-100" data-index="04">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">View</span>
                        <span class="text-secondary small ms-1">resources/views</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">@@extends('layouts.app')

@@section('content')
    @@foreach ($buku as $b)
        &lt;h2&gt;&#123;&#123; $b-&gt;judul &#125;&#125;&lt;/h2&gt;
    @@endforeach
@@endsection</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection-brand">by Icud Hodakss.</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
           kalian bingung mau pinjam alat olahraga? di Icud hodakss aja, kenapa harus di icud hodakss karena di icud hodakss menyediakan alah olahrga sangat lengkap
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand btn-lg px-4" href="{{route('login')}}">Login</a>
            <a class="btn btn-outline-brand btn-lg px-4" href="{{route('alat.index')}}" target="_blank">Alat</a>
        </div>

        <p class="text-secondary small mt-3 mb-0">
            Panduan langkah demi langkah ada di berkas
            <code class="inline">TUTORIAL.md</code>
        </p>
    </section>

    {{-- Instalasi --}}
    <section class="row g-4 align-items-start mb-5">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">📥 Instalasi</h2>

                    <p class="text-secondary mb-3">Pilih salah satu cara untuk memulai:</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <h3 class="h6 fw-medium mb-2">Dari GitHub</h3>
                            <pre class="code"><span class="cmt"># Clone repository</span>
git clone https://github.com/indrabsus/sakuci-framework.git
cd sakuci-framework

<span class="cmt"># Siapkan .env</span>
cp .env.example .env

<span class="cmt"># Jalankan server</span>
php sakuci serve</pre>
                        </div>

                        <div class="col-md-6">
                            <h3 class="h6 fw-medium mb-2">Manual</h3>
                            <ol class="mb-0 ps-4">
                                <li>Download folder dari <a href="https://github.com/indrabsus/sakuci-framework" target="_blank">GitHub</a></li>
                                <li>Ekstrak ke folder proyek</li>
                                <li>Salin <code class="inline">.env.example</code> jadi <code class="inline">.env</code></li>
                                <li>Jalankan <code class="inline">php sakuci serve</code></li>
                                <li>Buka <code class="inline">http://127.0.0.1:8000</code></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Langkah berikutnya --}}
    <section id="langkah" class="row g-4 align-items-start mb-5">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">Langkah berikutnya</h2>

                    <ul class="list-unstyled d-grid gap-3 mb-0">
                        <li class="d-flex gap-3">
                            <span class="step-number">1</span>
                            <div>
                                <div class="fw-medium">Atur koneksi database</div>
                                <div class="text-secondary small">
                                    Edit berkas <code class="inline">.env</code>, lalu uji dengan
                                    <code class="inline">php sakuci db:check</code>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex gap-3">
                            <span class="step-number">2</span>
                            <div>
                                <div class="fw-medium">Buat tabel</div>
                                <div class="text-secondary small">
                                    <code class="inline">php sakuci make:migration create_buku_table</code>
                                    lalu <code class="inline">php sakuci migrate</code>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex gap-3">
                            <span class="step-number">3</span>
                            <div>
                                <div class="fw-medium">Buat model, controller, dan view</div>
                                <div class="text-secondary small">
                                    <code class="inline">make:model</code>,
                                    <code class="inline">make:controller</code>,
                                    <code class="inline">make:view</code>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex gap-3">
                            <span class="step-number">4</span>
                            <div>
                                <div class="fw-medium">Daftarkan route</div>
                                <div class="text-secondary small">
                                    Tulis di <code class="inline">routes/web.php</code>, cek dengan
                                    <code class="inline">php sakuci route:list</code>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">Perintah yang sering dipakai</h2>

                    <pre class="code"><span class="cmt"># jalankan server</span>
php sakuci serve

<span class="cmt"># uji koneksi database</span>
php sakuci db:check

<span class="cmt"># lihat semua route</span>
php sakuci route:list

<span class="cmt"># bantuan lengkap</span>
php sakuci</pre>
                </div>
            </div>
        </div>
    </section>

    {{-- Empat pilar --}}
    <section>
        <h2 class="h5 fw-semibold mb-3">Empat pilar</h2>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Route</span>
                        <span class="text-secondary small ms-1">routes/web.php</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">Route::get('/buku',
    [BukuController::class, 'index'])
    ->name('buku.index');

<span class="cmt">// 7 route CRUD sekaligus</span>
Route::resource('buku',
    BukuController::class);</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Controller</span>
                        <span class="text-secondary small ms-1">app/Controllers</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">class BukuController extends Controller
{
    public function index()
    {
        return view('buku.index', [
            'buku' => Buku::all(),
        ]);
    }
}</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Model</span>
                        <span class="text-secondary small ms-1">app/Models</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">Buku::all();
Buku::find(1);
Buku::where('stok', '>', 0)
    ->latest()
    ->paginate(10);

Buku::create(['judul' => 'PHP']);</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">View</span>
                        <span class="text-secondary small ms-1">resources/views</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">@@extends('layouts.app')

@@section('content')
    @@foreach ($buku as $b)
        &lt;h2&gt;&#123;&#123; $b-&gt;judul &#125;&#125;&lt;/h2&gt;
    @@endforeach
@@endsection</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
