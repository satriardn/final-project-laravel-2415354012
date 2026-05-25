@props(['active' => ''])

<aside id="sidebar" class="w-68 bg-white/95 backdrop-blur-md border-r border-slate-200/60 flex flex-col min-h-screen transition-all duration-300 relative z-30">
    <div class="px-6 py-6 flex items-center justify-between sidebar-header border-b border-slate-100/80">
        <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0 relative">
                <span class="iconify text-emerald-600" data-icon="material-symbols:AppSettingsAltOutline" style="font-size: 24px;"></span>
                <span class="absolute top-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-white animate-pulse"></span>
            </div>
            <div class="flex items-baseline tracking-tight sidebar-label">
                <span class="font-extrabold text-2xl text-emerald-600 font-sans" style="font-family: 'Outfit', sans-serif;">ERP</span>
                <span class="font-extrabold text-2xl text-slate-900 font-sans ml-1" style="font-family: 'Outfit', sans-serif;">Admin</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 mt-8 space-y-2">
        <div class="relative group">
            @if($active === 'customers')
                <div class="absolute left-0 top-1.5 bottom-1.5 w-1.25 bg-emerald-500 rounded-r-full"></div>
            @endif
            <a href="{{ route('customers.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ $active === 'customers' ? 'bg-emerald-500/10 text-emerald-900 font-bold shadow-sm shadow-emerald-500/5' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                <span class="iconify {{ $active === 'customers' ? 'text-emerald-600' : 'text-slate-400 group-hover:text-slate-600' }} transition-colors" data-icon="fluent:people-16-filled" style="font-size: 22px;"></span>
                <span class="sidebar-label text-[14px]">Customers</span>
            </a>
        </div>

        <div class="relative group">
            @if($active === 'services')
                <div class="absolute left-0 top-1.5 bottom-1.5 w-1.25 bg-emerald-500 rounded-r-full"></div>
            @endif
            <a href="{{ route('services.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ $active === 'services' ? 'bg-emerald-500/10 text-emerald-900 font-bold shadow-sm shadow-emerald-500/5' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                <span class="iconify {{ $active === 'services' ? 'text-emerald-600' : 'text-slate-400 group-hover:text-slate-600' }} transition-colors" data-icon="mdi:cube" style="font-size: 22px;"></span>
                <span class="sidebar-label text-[14px]">Services</span>
            </a>
        </div>

        <div class="relative group">
            @if($active === 'subscriptions')
                <div class="absolute left-0 top-1.5 bottom-1.5 w-1.25 bg-emerald-500 rounded-r-full"></div>
            @endif
            <a href="{{ route('subscriptions.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ $active === 'subscriptions' ? 'bg-emerald-500/10 text-emerald-900 font-bold shadow-sm shadow-emerald-500/5' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                <span class="iconify {{ $active === 'subscriptions' ? 'text-emerald-600' : 'text-slate-400 group-hover:text-slate-600' }} transition-colors" data-icon="material-symbols:note-rounded" style="font-size: 22px;"></span>
                <span class="sidebar-label text-[14px]">Subscription</span>
            </a>
        </div>
    </nav>
</aside>

