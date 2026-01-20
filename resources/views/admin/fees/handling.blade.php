@extends('admin.layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Handling Fee</h1>
            <p class="text-sm text-gray-500 mt-1">Manage platform handling fee (percentage of subtotal)</p>
        </div>
    </div>

    {{-- @if (session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-xl">
            <p class="text-sm font-bold text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-xl">
            <p class="text-sm font-bold text-red-700 mb-2">Please fix the following:</p>
            <ul class="text-sm text-red-600 list-disc list-inside">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-50">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-[260px]">
                            Name
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-[180px]">
                            Type
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-[160px]">
                            Value
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-[160px]">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                            Last Updated
                        </th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50 text-gray-800">
                    <tr class="group hover:bg-[#D4AF37]/5 transition-colors">
                        {{-- Name --}}
                        <td class="px-6 py-4 font-bold text-gray-900 group-hover:text-[#8f6a10]">
                            {{ $label ?: 'Handling Fee' }}
                        </td>

                        {{-- Type --}}
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                                       text-[11px] font-bold bg-gray-50 text-gray-500
                                       border border-gray-100 uppercase tracking-wider">
                                SUBTOTAL %
                            </span>
                        </td>

                        {{-- Value --}}
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-900">
                                {{ number_format((float) $percent, 2) }}%
                            </span>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @if ($enabled)
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                                           bg-green-50 text-green-700 border border-green-200
                                           text-[11px] font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Active
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                                           bg-gray-50 text-gray-500 border border-gray-200
                                           text-[11px] font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        {{-- Last Updated --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ $updatedAt ? \Carbon\Carbon::parse($updatedAt)->format('d M Y H:i A') : '—' }}
                        </td>

                        {{-- Action --}}
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                    class="p-2 rounded-lg text-gray-400 hover:text-[#8f6a10]
                                           hover:bg-[#D4AF37]/10 transition-all"
                                    title="Edit" data-open-handling-modal data-enabled="{{ $enabled ? '1' : '0' }}"
                                    data-percent="{{ (float) $percent }}" data-label="{{ $label }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                                a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- =========================
        Modal
    ========================== --}}
    <div id="handlingModal" class="fixed inset-0 z-[80] hidden">
        <div class="absolute inset-0 bg-black/40" data-close-handling-modal></div>

        <div class="relative h-screen flex items-center justify-center p-4">

            <div class="w-full max-w-lg bg-white rounded-3xl border border-gray-100 shadow-2xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-gray-900">Edit Handling Fee</h3>
                        <p class="text-xs text-gray-500 mt-1">Enable/disable and adjust percentage (subtotal based).</p>
                    </div>

                    <button type="button" class="p-2 rounded-xl hover:bg-gray-50 text-gray-400 hover:text-gray-700"
                        data-close-handling-modal>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.fees.handling.update') }}" class="p-6 space-y-5">
                    @csrf

                    <div class="bg-gray-50/60 border border-gray-100 rounded-2xl p-4">
                        <label class="flex items-center justify-between gap-4 cursor-pointer select-none">
                            <div>
                                <p class="text-sm font-black text-gray-900">Active</p>
                                <p class="text-xs text-gray-500">If inactive, fee will not be added to checkout.</p>
                            </div>

                            <input type="checkbox" name="enabled" value="1" id="handlingEnabled"
                                class="h-5 w-5 text-[#D4AF37] border-gray-300 focus:ring-[#D4AF37] rounded">
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-2 uppercase">Label</label>
                            <input type="text" name="label" id="handlingLabel" placeholder="Handling Fee"
                                class="w-full px-4 py-3 rounded-2xl border-gray-200 focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition-all text-sm shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-2 uppercase">Percent (%)</label>
                            <input type="number" step="0.01" min="0" max="100" name="percent"
                                id="handlingPercent"
                                class="w-full px-4 py-3 rounded-2xl border-gray-200 focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition-all text-sm shadow-sm"
                                required>
                            <p class="text-[11px] text-gray-500 mt-2">Example: 10 = 10% of subtotal</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" data-close-handling-modal
                            class="px-5 py-3 rounded-2xl bg-white border border-gray-200 text-sm font-bold text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-5 py-3 rounded-2xl bg-gray-900 text-white text-sm font-bold hover:bg-black transition shadow-md active:scale-[0.98]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('handlingModal');
            const btn = document.querySelector('[data-open-handling-modal]');
            const closeBtns = document.querySelectorAll('[data-close-handling-modal]');

            const enabledEl = document.getElementById('handlingEnabled');
            const percentEl = document.getElementById('handlingPercent');
            const labelEl = document.getElementById('handlingLabel');

            function openModal(fromBtn) {
                if (!modal) return;

                // fill values
                const enabled = (fromBtn?.dataset.enabled || '0') === '1';
                const percent = fromBtn?.dataset.percent || '0';
                const label = fromBtn?.dataset.label || 'Handling Fee';

                if (enabledEl) enabledEl.checked = enabled;
                if (percentEl) percentEl.value = percent;
                if (labelEl) labelEl.value = label;

                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal() {
                if (!modal) return;
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            btn?.addEventListener('click', () => openModal(btn));
            closeBtns.forEach(b => b.addEventListener('click', closeModal));

            // ESC close
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
