<form action="{{ route('subscriptions.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block font-semibold text-slate-700 text-sm mb-1.5">Customer</label>
        <div style="position: relative;">
            <input type="hidden" name="customer_id" class="custom-dropdown-value" value="{{ old('customer_id') }}">
            <div class="custom-dropdown-trigger w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 cursor-pointer user-select-none transition-all duration-200 focus:border-emerald-500" data-placeholder="Select customer" onclick="toggleDropdown(this)" style="min-height: 44px; line-height: 22px; color: #94a3b8;">
                Select customer
            </div>
            <svg style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; width: 18px; height: 18px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
            <div class="custom-dropdown-options" style="display: none; position: fixed; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05); z-index: 99999; max-height: 200px; overflow-y: auto; padding: 4px;">
                @foreach ($customers as $customer)
                    <div class="custom-dropdown-option" onclick="selectOption(this, '{{ $customer['id'] }}', '{{ $customer['name'] }}')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">{{ $customer['name'] }}</div>
                @endforeach
            </div>
        </div>
        @error('customer_id') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="block font-semibold text-slate-700 text-sm mb-1.5">Service</label>
        <div style="position: relative;">
            <input type="hidden" name="service_id" class="custom-dropdown-value" value="{{ old('service_id') }}">
            <div class="custom-dropdown-trigger w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 cursor-pointer user-select-none transition-all duration-200 focus:border-emerald-500" data-placeholder="Select service" onclick="toggleDropdown(this)" style="min-height: 44px; line-height: 22px; color: #94a3b8;">
                Select service
            </div>
            <svg style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; width: 18px; height: 18px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
            <div class="custom-dropdown-options" style="display: none; position: fixed; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05); z-index: 99999; max-height: 200px; overflow-y: auto; padding: 4px;">
                @foreach ($services as $service)
                    <div class="custom-dropdown-option" onclick="selectOption(this, '{{ $service['id'] }}', '{{ $service['name'] }}')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">{{ $service['name'] }}</div>
                @endforeach
            </div>
        </div>
        @error('service_id') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="block font-semibold text-slate-700 text-sm mb-1.5">Start Date</label>
        <div style="position: relative;">
            <input type="text" id="start_date" name="start_date" value="{{ old('start_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:outline-none transition-all duration-200" placeholder="Select start date" readonly>
            <span class="iconify text-slate-400" data-icon="ic:baseline-calendar-today" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 18px;"></span>
        </div>
        @error('start_date') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="block font-semibold text-slate-700 text-sm mb-1.5">End Date</label>
        <div style="position: relative;">
            <input type="text" id="end_date" name="end_date" value="{{ old('end_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:outline-none transition-all duration-200" placeholder="Select end date" readonly>
            <span class="iconify text-slate-400" data-icon="ic:baseline-calendar-today" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 18px;"></span>
        </div>
        @error('end_date') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
    </div>
    <div class="mb-6">
        <label class="block font-semibold text-slate-700 text-sm mb-1.5">Status</label>
        <div style="position: relative;">
            <input type="hidden" name="status" class="custom-dropdown-value" value="{{ old('status') }}">
            <div class="custom-dropdown-trigger w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 cursor-pointer user-select-none transition-all duration-200 focus:border-emerald-500" data-placeholder="Select Status" onclick="toggleDropdown(this)" style="min-height: 44px; line-height: 22px; color: {{ old('status') ? '#0f172a' : '#94a3b8' }};">
                {{ old('status') ? ucfirst(old('status')) : 'Select Status' }}
            </div>
            <svg style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; width: 18px; height: 18px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
            <div class="custom-dropdown-options" style="display: none; position: fixed; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05); z-index: 99999; max-height: 200px; overflow-y: auto; padding: 4px;">
                <div class="custom-dropdown-option" onclick="selectOption(this, 'active', 'Active')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">Active</div>
                <div class="custom-dropdown-option" onclick="selectOption(this, 'trial', 'Trial')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">Trial</div>
                <div class="custom-dropdown-option" onclick="selectOption(this, 'isolir', 'Isolir')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">Isolir</div>
                <div class="custom-dropdown-option" onclick="selectOption(this, 'dismantle', 'Dismantle')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">Dismantle</div>
            </div>
        </div>
        @error('status') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
    </div>
    <div class="flex items-center justify-end gap-3 mt-6">
        <button type="button" data-bs-dismiss="modal" class="px-5 py-2.5 border border-slate-200 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold transition-colors">
            Cancel
        </button>
        <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white rounded-xl font-semibold transition-all shadow-sm shadow-emerald-600/10">
            Submit
        </button>
    </div>
</form>
