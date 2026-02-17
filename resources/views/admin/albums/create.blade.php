<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sharing Image') }}
        </h2>
    </x-slot>
    <div class="mx-auto max-w-4xl py-12">

        <form method="POST" action="{{ route('admin::albums.store') }}" enctype="multipart/form-data"
              class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
            @csrf

            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Album</h1>

            <div class="space-y-5">
                <div class="pb-3">
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">TITLE</label>
                    <input name="title" value="{{ old('title') }}"
                           class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                    @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="pb-3">
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">SLUG (optional)</label>
                    <input name="slug" value="{{ old('slug') }}"
                           class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">If empty, auto-generate from title.</p>
                    @error('slug')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="pb-3">
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">SUBTITLE</label>
                    <input name="subtitle" value="{{ old('subtitle') }}"
                           class="mt-1 w-full rounded-xl border-gray-300 focus:border-gray-900 focus:ring-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                </div>

                <div class="pb-3">
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300">HERO IMAGE</label>
                    <input type="file" name="hero_image" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:rounded-xl file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-800
                              dark:text-gray-200 dark:file:bg-white dark:file:text-gray-900 dark:hover:file:bg-gray-200">
                    @error('hero_image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <label class="flex items-center gap-3">
                    <input type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900 dark:border-gray-700">
                    <span class="text-sm text-gray-800 dark:text-gray-200">Publish now</span>
                </label>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('admin::albums.index') }}"
                   class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800">
                    Cancel
                </a>
                <button class="rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                    Create
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
