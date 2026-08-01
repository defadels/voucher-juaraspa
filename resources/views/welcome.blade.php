<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Juara Spa | Welcome Home</title>
    <meta name="description" content="Juara Spa Medan. Tempat terbaik untuk treatment massage dan reflexology di Medan, Indonesia. Terapis profesional dengan layanan berkualitas tinggi.">

    <!-- Inline Font Face definitions -->
    <style>
        /* latin-ext */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://img1.wsimg.com/gfonts/s/lato/v25/S6uyw4BMUTPHjxAwXjeu.woff2) format('woff2');
          unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://img1.wsimg.com/gfonts/s/lato/v25/S6uyw4BMUTPHjx4wXg.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://img1.wsimg.com/gfonts/s/lato/v25/S6u9w4BMUTPHh6UVSwaPGR_p.woff2) format('woff2');
          unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://img1.wsimg.com/gfonts/s/lato/v25/S6u9w4BMUTPHh6UVSwiPGQ.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* latin */
        @font-face {
          font-family: 'Lusitana';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://img1.wsimg.com/gfonts/s/lusitana/v14/CSR84z9ShvucWzsMKyhdTOI.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
        /* latin */
        @font-face {
          font-family: 'Lusitana';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://img1.wsimg.com/gfonts/s/lusitana/v14/CSR74z9ShvucWzsMKyDmafctaNY.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: #F6EFDE;
            color: #2A2421;
        }
        .font-serif-juara {
            font-family: 'Lusitana', Georgia, serif;
        }
    </style>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#F6EFDE] text-[#2A2421] min-h-screen flex flex-col antialiased selection:bg-[#C5A059] selection:text-white">

    <!-- ── Top Announcement & Navigation Bar ── -->
    <header class="w-full bg-[#FAF6ED] border-b border-[#E8DFC9] sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="//img1.wsimg.com/isteam/ip/54b668da-c235-4693-bbbd-33ebef8f78e9/Juara%20General%20Big.png/:/rs=h:120/qt=q:95" 
                     alt="Juara Spa Logo" 
                     class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-105 duration-300">
                <div class="hidden sm:block">
                    <span class="block font-serif-juara text-lg sm:text-xl font-bold tracking-widest text-[#2A2421]">JUARA SPA</span>
                    <span class="block text-[10px] tracking-widest uppercase text-[#9E7B3B]">Medan, Indonesia</span>
                </div>
            </a>

            <!-- Quick Action Links -->
            <div class="flex items-center gap-2 sm:gap-4">
                @if (Route::has('pelanggan.login'))
                    <a href="{{ route('pelanggan.login') }}" 
                       class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-full border border-[#9E7B3B] text-[#9E7B3B] hover:bg-[#9E7B3B] hover:text-white transition-all duration-300 shadow-sm flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 012 2v3a2 2 0 000 4v3a2 2 0 01-2 2H5a2 2 0 01-2-2v-3a2 2 0 000-4V7a2 2 0 012-2z"/>
                        </svg>
                        <span>Portal Pelanggan / Voucher</span>
                    </a>
                @endif

                @if (Route::has('admin.login'))
                    <a href="{{ route('admin.login') }}" 
                       class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-full bg-[#2A2421] text-[#F6EFDE] hover:bg-[#4A3E3D] transition-all duration-300 shadow-sm flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Portal Admin</span>
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- ── Hero Banner Section ── -->
    <section class="relative w-full bg-[#FAF6ED] pt-8 pb-16 border-b border-[#E8DFC9]">
        <div class="max-w-5xl mx-auto px-4 text-center">
            
            <!-- Main Hero Image Banner Unsplash -->
            <div class="relative w-full max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-2xl mb-10 border border-[#E8DFC9]">
                <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1200&q=80" 
                     alt="Juara Spa Relaxing Aromatherapy Treatment" 
                     class="w-full h-[340px] sm:h-[480px] object-cover filter brightness-[0.95] hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-[#2A2421]/70 via-[#2A2421]/20 to-transparent flex items-end justify-center pb-8">
                    <span class="text-white text-xs sm:text-sm tracking-widest uppercase bg-black/40 px-5 py-2 rounded-full backdrop-blur-sm border border-white/20 shadow-md">
                        Juara Spa Medan • Ultimate Wellness Experience
                    </span>
                </div>
            </div>

            <!-- Welcome Text -->
            <h1 class="font-serif-juara text-3xl sm:text-5xl font-bold tracking-wider text-[#2A2421] uppercase mb-3">
                WELCOME HOME..
            </h1>
            
            <p class="font-serif-juara text-lg sm:text-2xl text-[#9E7B3B] italic mb-6">
                Relax | Refresh | Revitalize
            </p>

            <div class="max-w-2xl mx-auto text-[#635752] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    <span class="font-semibold text-[#2A2421]">'The City Escape'</span> or <span class="font-semibold text-[#2A2421]">'The New World'</span> - choice is all yours. We are just very excited to see you!
                </p>
                <p class="text-xs sm:text-sm italic text-[#877871] pt-2 border-t border-[#E8DFC9]/70 max-w-xl mx-auto">
                    Juara Spa was previously known as Ras Spa. We opened our doors to our customers in 2008 and we have since thrived to be the best in the industry. So we changed our brand name to <strong>'Juara'</strong> which means <em>'the victor'</em>, just as we truly are.
                </p>
            </div>

        </div>
    </section>

    <!-- ── Full Day Spa Feature Section ── -->
    <section class="py-16 bg-[#F6EFDE] border-b border-[#E8DFC9]">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-[#FAF6ED] rounded-2xl p-8 sm:p-12 border border-[#E8DFC9] shadow-lg flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1 space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#9E7B3B] bg-[#F6EFDE] px-3 py-1 rounded-full border border-[#E8DFC9]">
                        Exclusive Retreat
                    </span>
                    <h2 class="font-serif-juara text-2xl sm:text-3xl font-bold text-[#2A2421]">
                        The ultimate 'me' time at OUR NEW FACILITY
                    </h2>
                    <ul class="space-y-2.5 text-sm sm:text-base text-[#635752]">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#9E7B3B]"></span>
                            <span>One short drive away to escape to the new world.</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#9E7B3B]"></span>
                            <span>Full-day self pamper; all inclusive!</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#9E7B3B]"></span>
                            <span>Treatments, meals and drinks.</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#9E7B3B]"></span>
                            <span>Surrounded by nature and warm smiles.</span>
                        </li>
                        <li class="flex items-center gap-2 font-medium text-[#2A2421]">
                            <span class="w-2 h-2 rounded-full bg-[#9E7B3B]"></span>
                            <span>All arranged for you!</span>
                        </li>
                    </ul>
                    <div class="pt-4 flex flex-wrap gap-4">
                        @if (Route::has('pelanggan.login'))
                            <a href="{{ route('pelanggan.login') }}" class="px-6 py-3 bg-[#9E7B3B] hover:bg-[#85652D] text-white text-sm font-semibold rounded-full shadow-md transition-all">
                                Gunakan / Cek Voucher Spa
                            </a>
                        @endif
                        <a href="https://wa.me/6282168443614" target="_blank" class="px-6 py-3 bg-[#25D366] hover:bg-[#1EBE5A] text-white text-sm font-semibold rounded-full shadow-md transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-80 h-72 rounded-xl overflow-hidden shadow-md border border-[#E8DFC9] group relative">
                    <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80" 
                         alt="Juara Spa Nature Retreat" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- ── About Us Section ── -->
    <section class="py-16 bg-[#FAF6ED] border-b border-[#E8DFC9]">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="font-serif-juara text-3xl font-bold uppercase tracking-widest text-[#2A2421] mb-12">
                ABOUT US
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <!-- Card 1 -->
                <div class="bg-[#F6EFDE] p-6 rounded-xl border border-[#E8DFC9] shadow-sm space-y-3">
                    <h3 class="font-serif-juara font-bold text-lg text-[#2A2421] uppercase">
                        EXPERT THERAPISTS EXCELLENT SERVICE
                    </h3>
                    <p class="text-sm text-[#635752] leading-relaxed">
                        We're experts at what we do. But knowing the best techniques is only part of the process, we're also here to make you feel great. Whether you're here for a one-hour service or an entire day, your peace and joy is of utmost importance!
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-[#F6EFDE] p-6 rounded-xl border border-[#E8DFC9] shadow-sm space-y-3">
                    <h3 class="font-serif-juara font-bold text-lg text-[#2A2421] uppercase">
                        Relaxing Environments
                    </h3>
                    <p class="text-sm text-[#635752] leading-relaxed">
                        From the moment you walk in any of our doors, our focus is on your complete relaxation. From massage to reflexology, our services are a great way to take a step back from the bustle of everyday city life. Come take a break and leave our doors totally refreshed!
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-[#F6EFDE] p-6 rounded-xl border border-[#E8DFC9] shadow-sm space-y-3">
                    <h3 class="font-serif-juara font-bold text-lg text-[#2A2421] uppercase">
                        Best Treatment Products
                    </h3>
                    <p class="text-sm text-[#635752] leading-relaxed">
                        Many people underestimate the effect high-quality lotions and oils have on a spa treatment. We guarantee our all-natural products help you with that extra feeling of zen and complete revitalization of all your senses!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── In-Spa & Other Treatments Showcase ── -->
    <section class="py-16 bg-[#F6EFDE] border-b border-[#E8DFC9]">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-serif-juara text-3xl font-bold uppercase tracking-widest text-[#2A2421]">
                    SPA & MASSAGE TREATMENTS
                </h2>
                <p class="text-sm text-[#877871] mt-2 italic">
                    Perawatan tubuh terbaik untuk kesegaran raga dan ketenangan jiwa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Treatment 1 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-md hover:shadow-xl transition-all flex flex-col group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=600&q=80" 
                             alt="Juara Massage Treatment" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 text-xs bg-[#9E7B3B] text-white px-3 py-1 rounded-full font-semibold shadow">
                            2 Jam
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-juara text-xl font-bold text-[#2A2421] uppercase mb-1">JUARA MASSAGE</h3>
                            <p class="text-xs text-[#9E7B3B] mb-3 font-semibold">With Olive Oil</p>
                            <p class="text-sm text-[#635752] leading-relaxed mb-4">
                                Terinspirasi dari Javanese massage, treatment ini dipercaya dapat membantu mengurangi kelelahan pada otot serta membantu memperlancar peredaran darah.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-[#E8DFC9] flex justify-between items-center text-xs text-[#9E7B3B]">
                            <span>Rekomendasi: Twice a month</span>
                            <span class="font-bold">2x / Bulan</span>
                        </div>
                    </div>
                </div>

                <!-- Treatment 2 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-md hover:shadow-xl transition-all flex flex-col group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1591343393582-fc92b963b652?auto=format&fit=crop&w=600&q=80" 
                             alt="Thai Herbal Treatment" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 text-xs bg-[#9E7B3B] text-white px-3 py-1 rounded-full font-semibold shadow">
                            2 Jam
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-juara text-xl font-bold text-[#2A2421] uppercase mb-1">THAI HERBAL</h3>
                            <p class="text-xs text-[#9E7B3B] mb-3 font-semibold">1 Jam Oil Massage + 1 Jam Thai Herbal</p>
                            <p class="text-sm text-[#635752] leading-relaxed mb-4">
                                Perawatan massage yang diciptakan untuk Anda yang sedang mengalami masalah pernapasan & kelelahan tubuh. Aroma hangat memanjakan tubuh dan pikiran.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-[#E8DFC9] flex justify-between items-center text-xs text-[#9E7B3B]">
                            <span>Rekomendasi: Twice a month</span>
                            <span class="font-bold">2x / Bulan</span>
                        </div>
                    </div>
                </div>

                <!-- Treatment 3 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-md hover:shadow-xl transition-all flex flex-col group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1507652313519-d4e9174996dd?auto=format&fit=crop&w=600&q=80" 
                             alt="Warm Stone Treatment" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 text-xs bg-[#9E7B3B] text-white px-3 py-1 rounded-full font-semibold shadow">
                            2 Jam
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-juara text-xl font-bold text-[#2A2421] uppercase mb-1">WARM STONE</h3>
                            <p class="text-xs text-[#9E7B3B] mb-3 font-semibold">1 Jam Oil Massage + 1 Jam Warm Stone</p>
                            <p class="text-sm text-[#635752] leading-relaxed mb-4">
                                Menggunakan batu hangat pada titik-titik akupresur. Sangat cocok untuk melepaskan jet-lag atau kelelahan setelah perjalanan jauh.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-[#E8DFC9] flex justify-between items-center text-xs text-[#9E7B3B]">
                            <span>Rekomendasi: Twice a month</span>
                            <span class="font-bold">2x / Bulan</span>
                        </div>
                    </div>
                </div>

                <!-- Treatment 4 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-md hover:shadow-xl transition-all flex flex-col group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=600&q=80" 
                             alt="Body Scrub Treatment" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 text-xs bg-[#9E7B3B] text-white px-3 py-1 rounded-full font-semibold shadow">
                            2 Jam
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-juara text-xl font-bold text-[#2A2421] uppercase mb-1">BODY SCRUB</h3>
                            <p class="text-xs text-[#9E7B3B] mb-3 font-semibold">75 Min Massage + 45 Min Bengkoang Scrub</p>
                            <p class="text-sm text-[#635752] leading-relaxed mb-4">
                                Menggunakan bahan rempah bengkoang murni untuk mencerahkan kulit, mengangkat sel kulit mati, dan mempercepat regenerasi sel kulit baru.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-[#E8DFC9] flex justify-between items-center text-xs text-[#9E7B3B]">
                            <span>Rekomendasi: Once a month</span>
                            <span class="font-bold">1x / Bulan</span>
                        </div>
                    </div>
                </div>

                <!-- Treatment 5 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-md hover:shadow-xl transition-all flex flex-col group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1519824145371-296894a0da96?auto=format&fit=crop&w=600&q=80" 
                             alt="Reflexology Treatment" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 text-xs bg-[#9E7B3B] text-white px-3 py-1 rounded-full font-semibold shadow">
                            90 Menit
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-juara text-xl font-bold text-[#2A2421] uppercase mb-1">REFLEXOLOGY</h3>
                            <p class="text-xs text-[#9E7B3B] mb-3 font-semibold">Foot & Calf Reflexology</p>
                            <p class="text-sm text-[#635752] leading-relaxed mb-4">
                                Dikhususkan pada bagian titik refleks telapak kaki dan betis untuk meredakan ketegangan dan mengurangi rasa lelah pada kaki Anda.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-[#E8DFC9] flex justify-between items-center text-xs text-[#9E7B3B]">
                            <span>Rekomendasi: Twice a month</span>
                            <span class="font-bold">2x / Bulan</span>
                        </div>
                    </div>
                </div>

                <!-- Treatment 6 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-md hover:shadow-xl transition-all flex flex-col group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=600&q=80" 
                             alt="V-Spa Feminine Care" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 text-xs bg-[#9E7B3B] text-white px-3 py-1 rounded-full font-semibold shadow">
                            1.5 Jam
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-juara text-xl font-bold text-[#2A2421] uppercase mb-1">V-SPA</h3>
                            <p class="text-xs text-[#9E7B3B] mb-3 font-semibold">Traditional Feminine Care</p>
                            <p class="text-sm text-[#635752] leading-relaxed mb-4">
                                Perawatan khusus organ intim wanita menggunakan racikan rempah-rempah tradisional untuk menjaga kesegaran, kebersihan, dan kenyamanan.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-[#E8DFC9] flex justify-between items-center text-xs text-[#9E7B3B]">
                            <span>Rekomendasi: Once a month</span>
                            <span class="font-bold">1x / Bulan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Voucher Digital Feature Section ── -->
    <section class="py-14 bg-[#2A2421] text-[#F6EFDE] relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=1200&q=80" alt="Spa Background Texture" class="w-full h-full object-cover">
        </div>
        <div class="max-w-4xl mx-auto px-4 text-center space-y-6 relative z-10">
            <span class="text-xs font-semibold uppercase tracking-widest bg-[#9E7B3B] text-white px-3 py-1 rounded-full">
                Sistem E-Voucher Juara Spa
            </span>
            <h2 class="font-serif-juara text-3xl sm:text-4xl font-bold">
                Klaim & Gunakan Voucher Perawatan Anda Secara Digital
            </h2>
            <p class="text-sm sm:text-base text-[#D4C8B8] max-w-2xl mx-auto leading-relaxed">
                Nikmati kemudahan mengakses voucher spa digital milik Anda, cek riwayat penggunaan, dan tunjukkan QR Code voucher langsung ke staf resepsionis kami saat berkunjung.
            </p>
            <div class="pt-2 flex justify-center gap-4">
                @if (Route::has('pelanggan.login'))
                    <a href="{{ route('pelanggan.login') }}" class="px-8 py-3.5 bg-[#9E7B3B] hover:bg-[#C5A059] text-white text-sm font-semibold rounded-full shadow-lg transition-all">
                        Masuk Ke Portal Pelanggan
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ── Happy Customers (Testimonials) ── -->
    <section class="py-16 bg-[#FAF6ED] border-b border-[#E8DFC9]">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="font-serif-juara text-3xl font-bold uppercase tracking-widest text-[#2A2421] mb-12">
                HAPPY CUSTOMERS
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-[#F6EFDE] p-6 rounded-xl border border-[#E8DFC9] shadow-sm flex flex-col justify-between">
                    <p class="text-sm text-[#635752] italic mb-6 leading-relaxed">
                        "ONE OF THE BEST MASSAGES I'VE HAD IN A VERY LONG TIME."
                    </p>
                    <div class="pt-4 border-t border-[#E8DFC9] flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" 
                             alt="Ariska Putri Pertiwi" 
                             class="w-11 h-11 rounded-full object-cover border border-[#9E7B3B]">
                        <div class="text-left">
                            <p class="font-serif-juara font-bold text-sm text-[#2A2421]">Ariska Putri Pertiwi</p>
                            <p class="text-xs text-[#9E7B3B]">Miss Grand International 2016</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-[#F6EFDE] p-6 rounded-xl border border-[#E8DFC9] shadow-sm flex flex-col justify-between">
                    <p class="text-sm text-[#635752] italic mb-6 leading-relaxed">
                        "HAD A WONDERFUL MASSAGE AT JUARA SPA. FANTASTIC THERAPISTS."
                    </p>
                    <div class="pt-4 border-t border-[#E8DFC9] flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" 
                             alt="Reffy Nugraha" 
                             class="w-11 h-11 rounded-full object-cover border border-[#9E7B3B]">
                        <div class="text-left">
                            <p class="font-serif-juara font-bold text-sm text-[#2A2421]">Reffy Nugraha</p>
                            <p class="text-xs text-[#9E7B3B]">Medan, Indonesia</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-[#F6EFDE] p-6 rounded-xl border border-[#E8DFC9] shadow-sm flex flex-col justify-between">
                    <p class="text-sm text-[#635752] italic mb-6 leading-relaxed">
                        "DEFINITELY A NEW EXPERIENCE TO ESCAPE INTO A NEW WORLD IN SUCH A SHORT TRIP!"
                    </p>
                    <div class="pt-4 border-t border-[#E8DFC9] flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80" 
                             alt="Djohan Chandra" 
                             class="w-11 h-11 rounded-full object-cover border border-[#9E7B3B]">
                        <div class="text-left">
                            <p class="font-serif-juara font-bold text-sm text-[#2A2421]">Djohan Chandra</p>
                            <p class="text-xs text-[#9E7B3B]">Medan, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Visit Us / Locations ── -->
    <section class="py-16 bg-[#F6EFDE] border-b border-[#E8DFC9]">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="font-serif-juara text-3xl font-bold uppercase tracking-widest text-[#2A2421] mb-12">
                VISIT US
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <!-- Location 1 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-sm space-y-3">
                    <div class="h-40 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560750588-73207b1ef5b8?auto=format&fit=crop&w=600&q=80" alt="Flagship City Escape" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 pt-2 space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#9E7B3B] bg-[#F6EFDE] px-2.5 py-0.5 rounded-full border border-[#E8DFC9]">
                            FLAGSHIP
                        </span>
                        <h3 class="font-serif-juara font-bold text-lg text-[#2A2421] uppercase">
                            THE CITY ESCAPE
                        </h3>
                        <p class="text-xs text-[#635752] leading-relaxed">
                            Kompleks Graha Niaga Unit B6 - B8,<br>
                            Jalan Putri Hijau No. 20,<br>
                            Medan, Indonesia.
                        </p>
                    </div>
                </div>

                <!-- Location 2 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-sm space-y-3">
                    <div class="h-40 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=600&q=80" alt="Ringroad City Escape" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 pt-2 space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#9E7B3B] bg-[#F6EFDE] px-2.5 py-0.5 rounded-full border border-[#E8DFC9]">
                            RINGROAD
                        </span>
                        <h3 class="font-serif-juara font-bold text-lg text-[#2A2421] uppercase">
                            THE CITY ESCAPE
                        </h3>
                        <p class="text-xs text-[#635752] leading-relaxed">
                            Kompleks OCBC Unit 29 - 30,<br>
                            Jalan Gagak Hitam Ring Road,<br>
                            Medan, Indonesia.
                        </p>
                    </div>
                </div>

                <!-- Location 3 -->
                <div class="bg-[#FAF6ED] rounded-xl overflow-hidden border border-[#E8DFC9] shadow-sm space-y-3">
                    <div class="h-40 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1596178065887-1198b6148b2b?auto=format&fit=crop&w=600&q=80" alt="Escape to the New World" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 pt-2 space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#9E7B3B] bg-[#F6EFDE] px-2.5 py-0.5 rounded-full border border-[#E8DFC9]">
                            RETREAT
                        </span>
                        <h3 class="font-serif-juara font-bold text-lg text-[#2A2421] uppercase">
                            ESCAPE TO THE NEW WORLD
                        </h3>
                        <p class="text-xs text-[#635752] leading-relaxed">
                            Our newest facility! Just a short drive away from the busy city into heaven on earth surrounded by nature sounds & scents.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Contact & Footer ── -->
    <footer class="bg-[#2A2421] text-[#F6EFDE] pt-12 pb-8 border-t border-[#4A3E3D]">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 pb-10 border-b border-[#4A3E3D]">
            <!-- Contact Info -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <img src="//img1.wsimg.com/isteam/ip/54b668da-c235-4693-bbbd-33ebef8f78e9/Juara%20General%20Big.png/:/rs=h:120/qt=q:95" alt="Juara Spa" class="h-10 w-auto">
                    <span class="font-serif-juara text-2xl font-bold tracking-widest">JUARA SPA</span>
                </div>
                <p class="text-xs text-[#D4C8B8] leading-relaxed max-w-md">
                    The best place for massage and reflexology treatments in Medan, Indonesia. Professionally trained therapists & complete revitalization of all your senses.
                </p>
                <div class="space-y-1.5 text-xs text-[#D4C8B8] pt-2">
                    <p class="flex items-center gap-2">
                        <span class="font-semibold text-white">Telepon / WA:</span>
                        <a href="tel:082168443614" class="hover:text-[#C5A059] transition-colors">082168443614</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-semibold text-white">Email:</span>
                        <a href="mailto:hello@juaraspa.com" class="hover:text-[#C5A059] transition-colors">hello@juaraspa.com</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-semibold text-white">Instagram:</span>
                        <a href="https://www.instagram.com/juaraspa" target="_blank" class="hover:text-[#C5A059] transition-colors">@juaraspa</a>
                    </p>
                </div>
            </div>

            <!-- WhatsApp Direct Action -->
            <div class="bg-[#382F2D] p-6 rounded-xl border border-[#4A3E3D] flex flex-col justify-between space-y-4">
                <div>
                    <h3 class="font-serif-juara font-bold text-lg text-white mb-2">Reservasi & Pertanyaan Treatment</h3>
                    <p class="text-xs text-[#D4C8B8]">
                        Tim kami siap membantu penjadwalan treatment dan pertanyaan seputar paket voucher Juara Spa.
                    </p>
                </div>
                <a href="https://wa.me/6282168443614" target="_blank" class="w-full py-3 bg-[#25D366] hover:bg-[#1EBE5A] text-white text-xs sm:text-sm font-semibold rounded-full text-center transition-all flex items-center justify-center gap-2 shadow-lg">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>Message us on WhatsApp!</span>
                </a>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-[#877871]">
            <p>Copyright © 2026 Juara Spa - All Rights Reserved.</p>
            <p class="mt-2 sm:mt-0">Voucher Juara Spa Digital System</p>
        </div>
    </footer>

</body>
</html>
