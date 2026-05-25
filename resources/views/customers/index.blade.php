@extends('layouts.app')

@section('title', 'Customers')

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
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Customer ID</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Customer Name</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Email</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Address</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Status</th>
                <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr class="border-b border-slate-100 hover:bg-slate-50/40 transition-colors">
                    <td class="px-6 py-4 text-slate-900 font-semibold">{{ $customer['customer_id'] }}</td>
                    <td class="px-6 py-4 text-slate-900 font-medium">{{ $customer['name'] }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $customer['email'] }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $customer['address'] }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $customer['status'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/40' : 'bg-rose-50 text-rose-700 border border-rose-200/40' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $customer['status'] ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                            {{ $customer['status'] ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center" style="position: relative; overflow: visible;">
                        <button class="flex justify-center w-full text-slate-400 hover:text-slate-600 transition-colors action-toggle">
                            <span class="iconify" data-icon="ic:baseline-menu" style="font-size: 20px;"></span>
                        </button>
                        <div class="action-dropdown" data-id="{{ $customer['id'] }}" data-customer-id="{{ $customer['customer_id'] }}" data-name="{{ $customer['name'] }}" data-email="{{ $customer['email'] }}" data-phone="{{ $customer['phone'] ?? '' }}" data-address="{{ $customer['address'] }}" data-status="{{ $customer['status'] ? 'active' : 'inactive' }}" style="display: none; position: absolute; right: 16px; top: 100%; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05); z-index: 9999; min-width: 180px; padding: 6px;">
                            <form action="{{ route('customers.activate', $customer['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; width: 100%; border: none; background: transparent; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                    <span class="iconify text-slate-400" data-icon="material-symbols:key" style="font-size: 18px;"></span>
                                    <span>Activate</span>
                                </button>
                            </form>
                            <form action="{{ route('customers.deactivate', $customer['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; width: 100%; border: none; background: transparent; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#f1f5f9'; this.style.color='#0f172a'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                    <span class="iconify text-slate-400" data-icon="material-symbols:key-off" style="font-size: 18px;"></span>
                                    <span>Deactivate</span>
                                </button>
                            </form>
                            <div onclick="openEditModal(this)" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #334155; white-space: nowrap; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#f1f5f9'; this.style.color='#0f172a'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#334155'">
                                <span class="iconify text-slate-400" data-icon="boxicons:edit" style="font-size: 18px;"></span>
                                <span>Edit</span>
                            </div>
                            <div class="my-1 border-t border-slate-100"></div>
                            <div onclick="openDeleteModal(this)" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-weight: 500; font-size: 13px; color: #ef4444; white-space: nowrap; border-radius: 8px; transition: all 0.2s;" onmouseenter="this.style.backgroundColor='#fff1f2'; this.style.color='#9f1239'" onmouseleave="this.style.backgroundColor='transparent'; this.style.color='#ef4444'">
                                <span class="iconify" data-icon="material-symbols:delete" style="font-size: 18px;"></span>
                                <span>Delete</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    @include('customers.create')
    @include('customers.edit')
    @include('customers.delete')
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

        if (spaceBelow < 120) {
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

document.getElementById('addDataModal').addEventListener('hidden.bs.modal', function() {
    const modal = this;
    modal.querySelectorAll('input[type="text"], input[type="email"]').forEach(el => { el.value = ''; });
    modal.querySelectorAll('.custom-dropdown-value').forEach(el => { el.value = ''; });
    modal.querySelectorAll('.custom-dropdown-trigger').forEach(el => {
        el.style.color = '#6b7280';
        const placeholder = el.getAttribute('data-placeholder');
        if (placeholder) el.textContent = placeholder;
    });
});

function openEditModal(el) {
    const dropdown = el.closest('.action-dropdown');
    document.getElementById('edit_customer_db_id').value = dropdown.dataset.id;
    document.getElementById('edit_customer_id').value = dropdown.dataset.customerId;
    document.getElementById('edit_customer_name').value = dropdown.dataset.name;
    document.getElementById('edit_customer_email').value = dropdown.dataset.email;
    document.getElementById('edit_customer_phone').value = dropdown.dataset.phone;
    document.getElementById('edit_customer_address').value = dropdown.dataset.address;
    const status = dropdown.dataset.status;
    const statusInput = document.getElementById('edit_customer_status');
    statusInput.value = status;
    const trigger = statusInput.nextElementSibling;
    trigger.textContent = status === 'active' ? 'Active' : 'Inactive';
    trigger.style.color = '#111827';

    document.getElementById('editCustomerForm').action = '/customers/' + dropdown.dataset.id;

    dropdown.style.display = 'none';
    new bootstrap.Modal(document.getElementById('editDataModal')).show();
}

function openDeleteModal(el) {
    const dropdown = el.closest('.action-dropdown');
    document.getElementById('delete_customer_name').textContent = dropdown.dataset.name;
    document.getElementById('deleteCustomerForm').action = '/customers/' + dropdown.dataset.id;
    dropdown.style.display = 'none';
    new bootstrap.Modal(document.getElementById('deleteDataModal')).show();
}

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
    modal.querySelectorAll('input[type="text"], input[type="email"]').forEach(el => {
        el.addEventListener('input', function() {
            this.style.border = 'none';
            const err = this.parentElement.querySelector('.field-error');
            if (err) err.remove();
        }, { once: true });
    });
}
</script>
@endpush
