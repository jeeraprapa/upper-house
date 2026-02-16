<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Quick panel --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10 mb-6">
                <div class="text-sm font-semibold text-gray-900 dark:text-white">Quick actions</div>
                <div class="mt-4 space-y-3">
                    <a href="{{ route('admin::questionnaire') }}"
                       class="block rounded-xl border border-gray-200 p-4 hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-800/40">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Manage questionnaires</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Search, view, export</div>
                    </a>

                    <a href="{{ route('questionnaire.create') }}"
                       class="block rounded-xl border border-gray-200 p-4 hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-800/40">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Create new entry</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Manual registration</div>
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="block rounded-xl border border-gray-200 p-4 hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-800/40">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Profile & security</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Change password, etc.</div>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Stats cards --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                        @php
                            $cards = [
                                ['label' => 'Total registrations', 'value' => $stats['total'], 'hint' => 'All time'],
                                ['label' => 'Today', 'value' => $stats['today'], 'hint' => 'Since 00:00'],
                                ['label' => 'This month', 'value' => $stats['month'], 'hint' => now()->format('M Y')],
                                ['label' => 'With email', 'value' => $stats['with_email'], 'hint' => 'Contactable'],
                            ];
                        @endphp

                        @foreach($cards as $c)
                            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $c['label'] }}</div>
                                <div class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ number_format($c['value']) }}
                                </div>
                                <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">{{ $c['hint'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Recent table --}}
                    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10">
                        <div class="flex items-center justify-between p-5">
                            <div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-white">Recent registrations</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Last 10 submissions</div>
                            </div>
                            <a href="{{ route('admin::questionnaire') }}"
                               class="text-sm font-semibold text-gray-900 hover:underline dark:text-white">
                                View all
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-800">
                                <thead class="bg-gray-50 text-left dark:bg-gray-950">
                                <tr>
                                    <th class="px-5 py-3 font-semibold text-gray-600 dark:text-gray-300">Name</th>
                                    <th class="px-5 py-3 font-semibold text-gray-600 dark:text-gray-300">Email</th>
                                    <th class="px-5 py-3 font-semibold text-gray-600 dark:text-gray-300">Country</th>
                                    <th class="px-5 py-3 font-semibold text-gray-600 dark:text-gray-300">Registered</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($recent as $r)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40">
                                        <td class="px-5 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ trim($r->first_name.' '.$r->last_name) ?: '-' }}
                                        </td>
                                        <td class="px-5 py-3 text-gray-600 dark:text-gray-300">
                                            {{ $r->email ?: '-' }}
                                        </td>
                                        <td class="px-5 py-3 text-gray-600 dark:text-gray-300">
                                            {{ $r->country_of_residence ?: '-' }}
                                        </td>
                                        <td class="px-5 py-3 text-gray-600 dark:text-gray-300">
                                            {{ optional($r->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-8 text-center text-gray-500 dark:text-gray-400">
                                            No data yet
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
