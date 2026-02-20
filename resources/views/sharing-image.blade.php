<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>{{ $album->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-white text-gray-900">

{{-- ================= HERO SECTION ================= --}}
<section class="relative h-screen w-full overflow-hidden">

    {{-- Background --}}
    @if($album->hero_image)
        <img src="{{ asset('storage/'.$album->hero_image) }}"
             class="absolute inset-0 h-full w-full object-cover hidden md:block"
             alt="">
    @endif

    @if($album->mb_hero_image)
        <img src="{{ asset('storage/'.$album->mb_hero_image) }}"
             class="absolute inset-0 h-full w-full object-cover block md:hidden"
             alt="">
    @else
        {{-- Fallback to hero_image if mb_hero_image is not set --}}
        <img src="{{ asset('storage/'.$album->hero_image) }}"
             class="absolute inset-0 h-full w-full object-cover block md:hidden"
             alt="">
    @endif


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
        <h1 class="text-sm tracking-widest uppercase text-gray-900 font-bold">
            {{ $album->title }}
        </h1>
        <h2 class="mt-4 text-sm text-gray-900">
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
<footer class="relative bg-black text-white pt-4">

    <div class="absolute inset-0 bg-black/50 z-10"></div>

    <div class="relative max-w-full mx-auto px-6 z-50">

        {{-- Top Section --}}
        <div class="flex flex-col lg:flex-row lg:justify-between gap-10 pb-8 ">

            {{-- Company Info --}}
            <div class="space-y-1">
                <p class="text-sm font-semibold tracking-wide">
                    CITY DYNAMIC CO., LTD.
                </p>

                <span class="block whitespace-pre-line text-sm text-white/80 leading-relaxed text-xs">
Unit 6A, 6/F, 140 Wireless Building,
140 Wireless Road, Lumphini, Pathumwan,
Bangkok 10330, Thailand
                </span>

                <span class="block text-sm text-white/80">
                    Email: enquiry@uhresidencesbangkok.com
                </span>
            </div>

            {{-- Partnership --}}
            <div class="flex flex-col items-start lg:items-end">
                <p class="text-xs tracking-widest uppercase text-white">
                    A CREATIVE PARTNERSHIP BY
                </p>

                <div class="flex items-center gap-6 pt-6">
                    <img
                        class="w-32"
                        src="https://www.uhresidencesbangkok.com/wp-content/themes/citydynamic_theme/assets/image/ic-partner-1.png"
                        alt="Partner 1"
                    >

                    <img
                        class="w-32"
                        src="https://www.uhresidencesbangkok.com/wp-content/themes/citydynamic_theme/assets/image/ic-partner-2.png"
                        alt="Partner 2"
                    >
                </div>
            </div>

        </div>

    </div>
</footer>

</body>
</html>
