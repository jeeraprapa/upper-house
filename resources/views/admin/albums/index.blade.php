<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sharing Image') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="rounded-xl bg-green-50 p-4 text-sm text-green-800 ring-1 ring-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">Albums</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Manage event landing pages & photos</div>
                </div>

                <a href="{{ route('admin::albums.create') }}"
                   class="rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                    + New Album
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-800">
                        <thead class="bg-gray-50 dark:bg-gray-950">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Title</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Slug</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Status</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Created</th>
                            <th class="px-5 py-3 text-right font-semibold text-gray-600 dark:text-gray-300">Action</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($albums as $a)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40">
                                <td class="px-5 py-3 font-medium text-gray-900 dark:text-white">{{ $a->title }}</td>
                                <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $a->slug }}</td>
                                <td class="px-5 py-3">
                                    @if($a->is_published)
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700 ring-1 ring-green-200 dark:bg-green-900/30 dark:text-green-200 dark:ring-green-900/40">
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700 ring-1 ring-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:ring-gray-700">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $a->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-5 py-3 text-right space-x-3">
                                    <a class="font-semibold text-gray-900 hover:underline dark:text-white"
                                       href="{{ route('admin::albums.edit', $a) }}">
                                        Edit
                                    </a>
                                    <form class="inline" method="POST" action="{{ route('admin::albums.destroy', $a) }}" onsubmit="return confirm('Delete this album?')">
                                        @csrf @method('DELETE')
                                        <button class="font-semibold text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-10 text-center text-gray-500 dark:text-gray-400">No albums</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $albums->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
