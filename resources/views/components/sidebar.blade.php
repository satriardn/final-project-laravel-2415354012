@props(['active' => ''])

<aside id="sidebar" class="w-64 bg-white border-r border-slate-200/80 flex flex-col min-h-screen transition-all duration-300">
    <div class="px-6 py-5 flex items-center justify-between sidebar-header">
        <div class="flex items-center gap-2">
            <span class="iconify text-emerald-600" data-icon="material-symbols:AppSettingsAltOutline" style="font-size: 28px;"></span>
            <span class="font-bold text-3xl text-emerald-600 tracking-tight sidebar-label">ERP </span>
            <span class="font-bold text-3xl text-slate-950 tracking-tight sidebar-label">Admin</span>
        </div>
    </div>

    <nav class="flex-1 px-3 mt-6 space-y-1">
        <a href="{{ route('customers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $active === 'customers' ? 'bg-emerald-50 text-emerald-800 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
            <span class="iconify {{ $active === 'customers' ? 'text-emerald-600' : 'text-slate-400' }}" data-icon="ic:baseline-people" style="font-size: 22px;"></span>
            <span class="sidebar-label">Customers</span>
        </a>
        <a href="{{ route('services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $active === 'services' ? 'bg-emerald-50 text-emerald-800 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
            <span class="iconify {{ $active === 'services' ? 'text-emerald-600' : 'text-slate-400' }}" data-icon="mdi:cube" style="font-size: 22px;"></span>
            <span class="sidebar-label">Services</span>
        </a>
        <a href="{{ route('subscriptions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $active === 'subscriptions' ? 'bg-emerald-50 text-emerald-800 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
            <span class="iconify {{ $active === 'subscriptions' ? 'text-emerald-600' : 'text-slate-400' }}" data-icon="material-symbols:note-rounded" style="font-size: 22px;"></span>
            <span class="sidebar-label">Subscription</span>
        </a>
    </nav>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', () => {


        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebar-toggle');

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            const header = sidebar.querySelector('.sidebar-header');
            header.classList.toggle('justify-between');
            header.classList.toggle('justify-center');
        });
    });
</script>
