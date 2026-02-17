<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">

        {{-- toast --}}
        <template x-if="toast">
            <div class="fixed right-5 top-5 z-50 rounded-xl bg-green-600 px-4 py-3 text-sm font-semibold text-white shadow-lg"
                 x-text="toast"></div>
        </template>

        {{-- Flash (fallback) --}}
        @if(session('success'))
            <div class="rounded-xl bg-green-50 p-4 text-sm text-green-800 ring-1 ring-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            {{-- Left: Album settings --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white">Album settings</div>

                    <form class="mt-5 space-y-4" method="POST" action="{{ route('admin::albums.update',$album) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="pb-3">
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">TITLE</label>
                            <input name="title" value="{{ old('title',$album->title) }}"
                                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                            @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="pb-3">
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">SLUG</label>
                            <input name="slug" value="{{ old('slug',$album->slug) }}"
                                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                            @error('slug')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="pb-3">
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">SUBTITLE</label>
                            <input name="subtitle" value="{{ old('subtitle',$album->subtitle) }}"
                                   class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                        </div>

                        <div class="pb-3">
                            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">HERO IMAGE</label>

                            @if($album->hero_image)
                                <img class="mt-2 w-full rounded-xl object-cover ring-1 ring-black/10 dark:ring-white/10"
                                     src="{{ asset('storage/'.$album->hero_image) }}" alt="">
                            @endif

                            <input type="file" name="hero_image" accept="image/*"
                                   class="mt-3 block w-full text-sm text-gray-700 file:mr-4 file:rounded-xl file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-800
                                      dark:text-gray-200 dark:file:bg-white dark:file:text-gray-900 dark:hover:file:bg-gray-200">
                        </div>

                        <label class="flex items-center gap-3">
                            <input type="checkbox" name="is_published" value="1"
                                   class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900 dark:border-gray-700"
                                @checked(old('is_published',$album->is_published))>
                            <span class="text-sm text-gray-800 dark:text-gray-200">Published</span>
                        </label>

                        <div class="flex items-center justify-between">
{{--                            <a class="text-sm font-semibold text-gray-700 hover:underline dark:text-gray-200"--}}
{{--                               href="{{ route('share.show', optional($album->shares()->latest()->first())->token ?? 'x') }}"--}}
{{--                               onclick="return false;">--}}
{{--                                Public URL: /s/{token}--}}
{{--                            </a>--}}

                            <button class="rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                                Save
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Share Links --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Share links</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">No-login / revoke / view count</div>
                    </div>

                    {{-- Create share --}}
                    <form class="mt-5 space-y-3" method="POST" action="{{ route('admin::albums.shares.store',$album) }}">
                        @csrf
                        <div class="grid grid-cols-1 gap-3">
                            <div class="pb-3">
                                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">NAME (optional)</label>
                                <input name="name" value="{{ old('name') }}"
                                       class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white"
                                       placeholder="VIP / Agent / Staff">
                            </div>
                            <div class="pb-3">
                                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">EXPIRES AT (optional)</label>
                                <input type="datetime-local" name="expires_at"
                                       class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                            </div>
                        </div>

                        <button class="w-full rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                            Create share link
                        </button>
                    </form>

                    {{-- List shares --}}
                    <div class="mt-5 space-y-3">
                        @php $shares = $album->shares()->latest()->take(10)->get(); @endphp

                        @forelse($shares as $s)
                            @php
                                $url = route('share.show', $s->token);
                                $active = $s->isActive();
                            @endphp

                            <div class="rounded-xl border border-gray-200 p-3 dark:border-gray-800">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="pb-3">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $s->name ?: 'Share link' }}
                                            @if($active)
                                                <span class="ml-2 inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700 dark:bg-green-900/30 dark:text-green-200">
                                                Active
                                            </span>
                                            @else
                                                <span class="ml-2 inline-flex rounded-full bg-gray-100 px-2 py-0.5 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                                                Inactive
                                            </span>
                                            @endif
                                        </div>
                                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400 break-all">
                                            {{ $url }}
                                        </div>

                                        <div class="mt-2 flex flex-wrap gap-3 text-xs text-gray-600 dark:text-gray-300">
                                            <span>Views: <b>{{ number_format($s->view_count) }}</b></span>
                                            <span>Last: {{ $s->last_viewed_at?->format('d/m/Y H:i') ?: '-' }}</span>
                                            <span>Expires: {{ $s->expires_at?->format('d/m/Y H:i') ?: '-' }}</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <button type="button"
                                                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-semibold text-gray-800 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800"
                                                @click="copy('{{ $url }}')">
                                            Copy
                                        </button>

                                        @if($active)
                                            <form method="POST" action="{{ route('admin::shares.revoke',$s) }}">
                                                @csrf @method('PATCH')
                                                <button class="w-full rounded-lg bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700">
                                                    Revoke
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin::shares.restore',$s) }}">
                                                @csrf @method('PATCH')
                                                <button class="w-full rounded-lg bg-gray-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                                                    Restore
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('admin::shares.destroy',$s) }}" onsubmit="return confirm('Delete this share link?')">
                                            @csrf @method('DELETE')
                                            <button class="w-full rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-semibold text-gray-800 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-500 dark:text-gray-400">No share links yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right: Photos --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Upload photos --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">Photos</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Upload multiple images, manage caption/sort/publish</div>
                        </div>
                    </div>

                    <form class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center"
                          method="POST" action="{{ route('admin::albums.photos.store',$album) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-xl file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-800
                                  dark:text-gray-200 dark:file:bg-white dark:file:text-gray-900 dark:hover:file:bg-gray-200">
                        <button class="rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                            Upload
                        </button>
                    </form>
                    @error('images')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                    @error('images.*')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Photos grid --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Gallery</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Total: {{ $album->photos->count() }}</div>
                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                        @forelse($album->photos as $p)
                            <div class="group rounded-2xl border border-gray-200 p-2 dark:border-gray-800">
                                <div class="aspect-square overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-950">
                                    <img src="{{ asset('storage/'.$p->image_path) }}"
                                         class="h-full w-full object-cover transition group-hover:scale-105" alt="">
                                </div>

                                <form class="mt-2 space-y-2" method="POST" action="{{ route('admin::photos.update',$p) }}">
                                    @csrf @method('PATCH')

                                    <input name="caption" value="{{ old('caption',$p->caption) }}"
                                           placeholder="Caption"
                                           class="w-full rounded-lg border-gray-300 text-xs focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">

                                    <div class="flex items-center gap-2">
                                        <input name="sort_order" type="number" value="{{ old('sort_order',$p->sort_order) }}"
                                               class="w-full rounded-lg border-gray-300 text-xs focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white"
                                               placeholder="Sort">
                                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300">
                                            <input type="checkbox" name="is_published" value="1"
                                                   class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900 dark:border-gray-700"
                                                @checked(old('is_published',$p->is_published))>
                                            Show
                                        </label>
                                    </div>

                                    <button class="w-full rounded-lg bg-gray-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                                        Save
                                    </button>
                                </form>

                                <form class="mt-2" method="POST" action="{{ route('admin::photos.destroy',$p) }}" onsubmit="return confirm('Delete photo?')">
                                    @csrf @method('DELETE')
                                    <button class="w-full rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-semibold text-gray-800 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="col-span-full rounded-xl border border-dashed border-gray-300 p-10 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                No photos yet.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
