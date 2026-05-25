@extends('layouts.app')

@section('title', 'Subscriptions')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addDataModal" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white rounded-xl px-5 py-3 font-semibold transition-all shadow-sm shadow-emerald-600/10">
            <span class="iconify" data-icon="ic:baseline-add" style="font-size: 20px;"></span>
            <span>Add Data</span>
        </button>
    </div>

    <div class="border border-slate-200/60 rounded-xl bg-white shadow-sm overflow-hidden" style="overflow: visible;">
    <table class="w-full text-left border-collapse" style="overflow: visible;">
        <thead>
            <tr class="bg-slate-50/70 border-b border-slate-200/60">
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Customer Name</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Services</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Services Period</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Status</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscriptions as $subscription)
                <tr class="border-b border-slate-100 hover:bg-slate-50/40 transition-colors">
                    <td class="px-6 py-4 text-slate-900 font-semibold">{{ $subscription['customer']['name'] ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-900 font-medium">{{ $subscription['service']['name'] ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-500 font-medium">
                        {{ \Carbon\Carbon::parse($subscription['start_date'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($subscription['end_date'])->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $status = ucfirst($subscription['status']);
                            $statusStyles = match(strtolower($subscription['status'])) {
                                'active' => ['bg' => 'bg-emerald-50 text-emerald-700 border border-emerald-200/40', 'dot' => 'bg-emerald-500'],
                                'trial' => ['bg' => 'bg-amber-50 text-amber-700 border border-amber-200/40', 'dot' => 'bg-amber-500'],
                                'isolir' => ['bg' => 'bg-rose-50 text-rose-700 border border-rose-200/40', 'dot' => 'bg-rose-500'],
                                'dismantle' => ['bg' => 'bg-slate-50 text-slate-600 border border-slate-200/50', 'dot' => 'bg-slate-400'],
                                'inactive' => ['bg' => 'bg-rose-50 text-rose-700 border border-rose-200/40', 'dot' => 'bg-rose-500'],
                                default => ['bg' => 'bg-slate-50 text-slate-600 border border-slate-200/50', 'dot' => 'bg-slate-400'],
                            };
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $statusStyles['bg'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $statusStyles['dot'] }}"></span>
                            {{ $status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center" style="position: relative;">
                        <button class="flex justify-center w-full text-slate-400 hover:text-slate-600 transition-colors action-toggle">
                            <span class="iconify" data-icon="ic:baseline-menu" style="font-size: 20px;"></span>
                        </button>
                        <div class="action-dropdown" style="display: none; position: absolute; right: 16px; top: 100%; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05); z-index: 9999; min-width: 180px; padding: 6px;">
                            <form action="{{ route('subscriptions.activate', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; width: 100%; border: none; background: transparent; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                    <span class="iconify text-slate-400" data-icon="material-symbols:key" style="font-size: 18px;"></span>
                                    <span>Active</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.deactivate', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; width: 100%; border: none; background: transparent; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#f1f5f9'; this.style.color='#0f172a'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                    <span class="iconify text-slate-400" data-icon="material-symbols:key-off" style="font-size: 18px;"></span>
                                    <span>Deactivate</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.trial', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; width: 100%; border: none; background: transparent; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#fffbeb'; this.style.color='#78350f'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                    <span class="iconify text-slate-400" data-icon="material-symbols:hourglass-top" style="font-size: 18px;"></span>
                                    <span>Trial</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.isolir', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; width: 100%; border: none; background: transparent; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#fff1f2'; this.style.color='#9f1239'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                    <span class="iconify text-slate-400" data-icon="material-symbols:stop-circle-outline-rounded" style="font-size: 18px;"></span>
                                    <span>Isolir</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.dismantle', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; width: 100%; border: none; background: transparent; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#f1f5f9'; this.style.color='#0f172a'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                    <span class="iconify text-slate-400" data-icon="material-symbols:dangerous" style="font-size: 18px;"></span>
                                    <span>Dismantle</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 650px; width: 100%; overflow: visible;">
            <div class="modal-content bg-white rounded-2xl p-6 shadow-xl border border-slate-100" style="overflow: visible;">
                <h2 class="text-xl font-bold text-slate-900 text-center mb-6">Add Subscription</h2>
                @include('subscriptions.create')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function toggleDropdown(el) {
    const options = el.nextElementSibling.nextElementSibling;
    const isVisible = options.style.display === 'block';

    document.querySelectorAll('.custom-dropdown-options').forEach(o => o.style.display = 'none');

    if (!isVisible) {
        const triggerRect = el.getBoundingClientRect();
        const spaceBelow = window.innerHeight - triggerRect.bottom;

        options.style.position = 'fixed';
        options.style.width = triggerRect.width + 'px';
        options.style.left = triggerRect.left + 'px';
        options.style.zIndex = '99999';
        options.style.display = 'block';

        if (spaceBelow < 250) {
            options.style.top = 'auto';
            options.style.bottom = (window.innerHeight - triggerRect.top + 4) + 'px';
        } else {
            options.style.bottom = 'auto';
            options.style.top = (triggerRect.bottom + 4) + 'px';
        }
    }
}

function selectOption(el, value, label) {
    const wrapper = el.closest('[style*="position: relative"]');
    const trigger = wrapper.querySelector('.custom-dropdown-trigger');
    const input = wrapper.querySelector('.custom-dropdown-value');
    const options = wrapper.querySelector('.custom-dropdown-options');
    trigger.textContent = label;
    trigger.style.color = '#111827';
    input.value = value;
    options.style.display = 'none';
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.custom-dropdown-trigger')) {
        document.querySelectorAll('.custom-dropdown-options').forEach(el => {
            el.style.display = 'none';
        });
    }
    if (!e.target.closest('.action-toggle') && !e.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown').forEach(el => {
            el.style.display = 'none';
        });
    }
});

document.querySelectorAll('.action-toggle').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const dropdown = this.nextElementSibling;
        const isOpen = dropdown.style.display === 'block';

        document.querySelectorAll('.action-dropdown').forEach(el => { el.style.display = 'none'; });

        if (!isOpen) {
            const btnRect = this.getBoundingClientRect();
            const spaceBelow = window.innerHeight - btnRect.bottom;

            if (spaceBelow < 300) {
                dropdown.style.top = 'auto';
                dropdown.style.bottom = '100%';
            } else {
                dropdown.style.bottom = 'auto';
                dropdown.style.top = '100%';
            }

            dropdown.style.display = 'block';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addDataModal');

    modal.addEventListener('show.bs.modal', function() {
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');

        if (startInput._flatpickr) startInput._flatpickr.destroy();
        if (endInput._flatpickr) endInput._flatpickr.destroy();

        document.querySelectorAll('.flatpickr-calendar').forEach(el => el.remove());

        flatpickr(startInput, { dateFormat: 'd/m/Y', appendTo: modal });
        flatpickr(endInput, { dateFormat: 'd/m/Y', appendTo: modal });
    });

    modal.addEventListener('hidden.bs.modal', function() {
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');

        if (startInput._flatpickr) startInput._flatpickr.destroy();
        if (endInput._flatpickr) endInput._flatpickr.destroy();

        document.querySelectorAll('.flatpickr-calendar').forEach(el => el.remove());

        startInput.value = '';
        endInput.value = '';

        modal.querySelectorAll('input[type="text"], input[type="email"]').forEach(el => el.value = '');
        modal.querySelectorAll('.custom-dropdown-value').forEach(el => el.value = '');
        modal.querySelectorAll('.custom-dropdown-trigger').forEach(el => {
            el.style.color = '#6b7280';
            const placeholder = el.getAttribute('data-placeholder');
            if (placeholder) el.textContent = placeholder;
        });
    });
});

function clearErrors(modal) {
    modal.querySelectorAll('.field-error').forEach(el => el.remove());
    modal.querySelectorAll('[style*="border: 1px solid #ef4444"]').forEach(el => {
        el.style.border = 'none';
    });
    modal.querySelectorAll('.custom-dropdown-trigger[style*="border: 1px solid #ef4444"]').forEach(el => {
        el.style.border = 'none';
    });
}

function showFieldError(field, message) {
    const existing = field.parentElement.querySelector('.field-error');
    if (existing) existing.remove();
    const err = document.createElement('div');
    err.className = 'field-error';
    err.style.cssText = 'color: #ef4444; font-size: 13px; margin-top: 4px;';
    err.textContent = message;
    field.style.border = '1px solid #ef4444';
    field.parentElement.appendChild(err);
}

function attachInputListeners(modal) {
    modal.querySelectorAll('input[type="text"]').forEach(el => {
        el.addEventListener('input', function() {
            this.style.border = 'none';
            const err = this.parentElement.querySelector('.field-error');
            if (err) err.remove();
        }, { once: true });
    });
}
</script>
@endpush
