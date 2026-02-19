<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>{{ $album->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        /* theme รวม */
        .lg-event-theme .lg-backdrop {
            background: rgba(0, 0, 0, 0.92);
        }

        /* ซ่อนพื้นหลังแถบ caption เดิม แล้วทำของเราเอง */
        .lg-event-theme .lg-sub-html {
            background: transparent;
            padding: 0;
        }

        /* ทำ caption block ให้อยู่ล่างกลางเหมือนในรูป */
        .lg-event-theme .lg-event-caption {
            width: min(900px, calc(100vw - 48px));
            margin: 0 auto 1rem;
            text-align: center;
            color: rgba(255,255,255,0.9);
        }

        /* ตัวอักษรหัวเรื่อง */
        .lg-event-theme .lg-event-title {
            font-size: 12px;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* ตัวอักษรย่อย */
        .lg-event-theme .lg-event-sub {
            margin-top: 8px;
            font-size: 12px;
            color: rgba(255,255,255,0.65);
        }

        /* ปุ่ม 2 ปุ่มตรงกลาง */
        .lg-event-theme .lg-event-actions {
            margin-top: 16px;
            display: flex;
            justify-content: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        /* สไตล์ปุ่ม */
        .lg-event-theme .lg-event-actions button {
            border-bottom: 1px solid #ffffff;
            background: transparent;
            color: rgba(255,255,255,0.85);
            padding: 0;
            font-size: 11px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            cursor: pointer;
        }

        .lg-event-theme .lg-event-actions button:hover {
            border-color: rgba(255,255,255,0.7);
            color: rgba(255,255,255,1);
        }

        /* ให้ภาพอยู่กลาง + มีพื้นที่ด้านล่างพอให้ caption */
        .lg-event-theme .lg-inner {
            align-items: center;
        }
        .lg-event-theme .lg-outer {
            padding-bottom: 110px; /* กัน caption บังภาพ */
        }

        /* ปุ่มปิด/ลูกศรให้ดู minimal */
        .lg-event-theme .lg-toolbar,
        .lg-event-theme .lg-prev,
        .lg-event-theme .lg-next {
            background: transparent;
        }
        .lg-outer .lg-object.lg-image{
            object-fit: contain;
            max-height: 500px;
        }
    </style>
</head>

<body class="bg-white text-gray-900">

{{-- ================= HERO SECTION ================= --}}
<section class="relative h-screen w-full overflow-hidden">

    {{-- Background --}}
    @if($album->hero_image)
        <img src="{{ asset('storage/'.$album->hero_image) }}"
             class="absolute inset-0 h-full w-full object-cover"
             alt="">
    @endif

    {{-- Dark overlay --}}
    <div class="absolute inset-0 bg-black/50"></div>

    {{-- Content --}}
    <div class="relative z-10 flex h-full flex-col items-center justify-center text-center text-white px-6">

        {{-- Scroll Down --}}
        <a href="#gallery" class="absolute bottom-5 left-1/2 -translate-x-1/2  animate-bounce text-white/80">
            <img src="{{asset('assets/images/icon-down.svg')}}" alt="icon bounce" class="w-5">
        </a>
    </div>
</section>

{{-- ================= THANK YOU SECTION ================= --}}
<section class="bg-gray-100 py-16 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <h1 class="text-sm tracking-widest uppercase text-gray-800">
            {{ $album->title }}
        </h1>
        <h2 class="mt-4 text-sm text-gray-600">
            {{ $album->subtitle }}
        </h2>
    </div>
</section>

{{-- ================= GALLERY GRID ================= --}}
<section id="gallery" class="bg-gray-100 pb-24">
    <div class="max-w-6xl mx-auto px-6">

        <div id="eventGallery" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">

            @forelse($album->photos as $photo)
                <a href="{{ asset('storage/'.$photo->image_path) }}"
                   class="gallery-item group relative aspect-square overflow-hidden bg-gray-200"
                   data-sub-html='
                    <div class="lg-event-caption">
                      <div class="lg-event-title">YOUR PRESENCE MADE THE EVENING SPECIAL</div>
                      <div class="lg-event-sub">We hope this moment stays with you.</div>

                      <div class="lg-event-actions">
                        <button class="lg-btn-one" data-action="save-one" data-id="{{ $photo->id }}">SAVE THIS ONE</button>
                      </div>
                    </div>
                  '
                >

                    <img src="{{ asset('storage/'.$photo->image_path) }}"
                         class="h-full w-full object-cover transition duration-500 group-hover:scale-110"
                         alt="">

                    {{-- Optional caption overlay --}}
                    @if($photo->caption)
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-end p-4">
                            <p class="text-xs text-white">
                                {{ $photo->caption }}
                            </p>
                        </div>
                    @endif

                </a>
            @empty
                <div class="col-span-full text-center text-gray-500 py-20">
                    No photos available.
                </div>
            @endforelse

        </div>

    </div>
</section>

{{-- ================= FOOTER ================= --}}
<footer class="bg-black text-white py-10">
    <div class="max-w-6xl mx-auto px-6 text-center text-xs tracking-wide opacity-70">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
</footer>

</body>
</html>
