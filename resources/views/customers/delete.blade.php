<div class="modal fade" id="deleteDataModal" tabindex="-1" aria-labelledby="deleteDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px; width: 100%;">
        <div class="modal-content bg-white rounded-2xl p-6 shadow-xl border border-slate-100 text-center">
            <div class="flex justify-center mb-4">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center">
                    <span class="iconify" data-icon="ion:warning-outline" style="font-size: 28px;"></span>
                </div>
            </div>
            <h2 class="text-lg font-bold text-slate-900 mb-2">Delete Data</h2>
            <p class="text-slate-500 text-sm mb-6 leading-relaxed">Are you sure you want to delete <span id="delete_customer_name" class="font-semibold text-slate-800"></span>?<br>This action cannot be undone.</p>
            <form id="deleteCustomerForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-center gap-3">
                    <button type="button" data-bs-dismiss="modal" class="flex-1 px-5 py-2.5 border border-slate-200 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-5 py-2.5 bg-rose-600 hover:bg-rose-700 active:scale-[0.98] text-white rounded-xl font-semibold transition-all shadow-sm shadow-rose-600/10">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
