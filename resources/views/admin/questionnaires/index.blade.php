<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Questionnaires') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">
                        All Questionnaires
                    </h2>

                    <div class="flex gap-2">
                        <a href="{{ route('questionnaire.create') }}" target="_blank"
                           class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 bg-blue-600">
                            + New Questionnaire
                        </a>
                        <a href="{{ route('admin::questionnaire.export') }}"
                           class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 bg-green-600">
                            Export
                        </a>

                    </div>

                </div>

                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-600">#</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-600">Name</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-600">Email</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-600">Units</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-600">Contact number</th>
                                <th class="px-4 py-3 text-right font-medium text-gray-600">Country</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-600">Created</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($questionnaires as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-500">
                                        {{ $item->id }}
                                    </td>

                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        {{ $item->first_name }} {{ $item->last_name }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $item->email }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        @if(is_array($item->unit_interest))
                                            {{ implode(', ', str_replace('_',' ',$item->unit_interest)) }}
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $item->contact_number }}
                                    </td>

                                    <td class="px-4 py-3 text-right space-x-2">
                                        {{ $item->country_of_residence }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-500">
                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                        No data found
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $questionnaires->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
