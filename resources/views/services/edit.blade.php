<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 650px; width: 100%; overflow: visible;">
        <div class="modal-content bg-white rounded-2xl p-6 shadow-xl border border-slate-100" style="overflow: visible;">
            <h2 class="text-xl font-bold text-slate-900 text-center mb-6">Edit Service</h2>
            <form id="editServiceForm" action="{{ session('edit_service_id') ? route('services.update', session('edit_service_id')) : '' }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block font-semibold text-slate-700 text-sm mb-1.5">Service Name</label>
                    <input type="text" id="edit_service_name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:outline-none transition-all duration-200" placeholder="Enter service name">
                    @error('name') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-slate-700 text-sm mb-1.5">Price</label>
                    <input type="text" id="edit_service_price" name="price" value="{{ old('price') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:outline-none transition-all duration-200" placeholder="Enter price">
                    @error('price') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-slate-700 text-sm mb-1.5">Description</label>
                    <textarea rows="3" id="edit_service_description" name="description" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 focus:outline-none transition-all duration-200 resize-none" placeholder="Enter description">{{ old('description') }}</textarea>
                    @error('description') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div class="mb-6">
                    <label class="block font-semibold text-slate-700 text-sm mb-1.5">Status</label>
                    <div style="position: relative;">
                        <input type="hidden" name="status" id="edit_service_status" class="custom-dropdown-value" value="{{ old('status') }}">
                        <div class="custom-dropdown-trigger w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 cursor-pointer user-select-none transition-all duration-200 focus:border-emerald-500" data-placeholder="Select Status" onclick="toggleDropdown(this)" style="min-height: 44px; line-height: 22px; color: {{ old('status') ? '#0f172a' : '#94a3b8' }};">
                            {{ old('status') ? ucfirst(old('status')) : 'Select Status' }}
                        </div>
                        <svg style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; width: 18px; height: 18px; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <div class="custom-dropdown-options" style="display: none; position: fixed; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05); z-index: 99999; max-height: 200px; overflow-y: auto; padding: 4px;">
                            <div class="custom-dropdown-option" onclick="selectOption(this, 'active', 'Active')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">Active</div>
                            <div class="custom-dropdown-option" onclick="selectOption(this, 'inactive', 'Inactive')" onmouseenter="this.style.backgroundColor='#ecfdf5'; this.style.color='#065f46'" onmouseleave="this.style.backgroundColor='white'; this.style.color='#334155'" style="padding: 10px 14px; cursor: pointer; border-radius: 8px; font-weight: 500; font-size: 13.5px; color: #334155; transition: all 0.2s;">Inactive</div>
                        </div>
                    </div>
                    @error('status') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div class="flex items-center justify-end gap-3">
                    <button type="button" data-bs-dismiss="modal" class="px-5 py-2.5 border border-slate-200 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white rounded-xl font-semibold transition-all shadow-sm shadow-emerald-600/10">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
