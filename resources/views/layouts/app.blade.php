<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        /* Custom Premium Flatpickr Theme */
        .flatpickr-calendar {
            background: #ffffff !important;
            border: 1px solid #e2e8f0/80 !important;
            box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.08), 0 8px 10px -6px rgba(16, 185, 129, 0.04) !important;
            border-radius: 20px !important;
            padding: 8px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .flatpickr-day.selected,
        .flatpickr-day.selected:hover,
        .flatpickr-day.selected:focus {
            background: #10b981 !important;
            border-color: #10b981 !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
        }
        .flatpickr-day:hover {
            background: #ecfdf5 !important;
            color: #047857 !important;
            border-radius: 12px !important;
            border-color: transparent !important;
        }
        .flatpickr-day.today {
            border-color: #10b981 !important;
            color: #059669 !important;
            border-radius: 12px !important;
        }
        .flatpickr-months .flatpickr-month {
            color: #0f172a !important;
        }
        .flatpickr-current-month .numInputWrapper span.arrowUp:after {
            border-bottom-color: #10b981 !important;
        }
        .flatpickr-current-month .numInputWrapper span.arrowDown:after {
            border-top-color: #10b981 !important;
        }
        .flatpickr-day.flatpickr-disabled,
        .flatpickr-day.flatpickr-disabled:hover {
            color: #cbd5e1 !important;
            background: transparent !important;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px) scale(0.9); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        @keyframes slideOut {
            from { transform: scale(1); opacity: 1; }
            to { transform: scale(0.9); opacity: 0; }
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
            backdrop-filter: blur(4px);
            background-color: rgba(15, 23, 42, 0.3);
        }

        .modal.show {
            display: block;
        }

        .modal-backdrop {
            display: none !important; /* Managed by modal container backdrop-filter */
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: 1.75rem auto;
            max-width: 500px;
            pointer-events: none;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 3.5rem);
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            border-radius: 24px;
        }

        .modal.fade .modal-dialog {
            transform: scale(0.95) translateY(-10px);
            opacity: 0;
        }

        .modal.show .modal-dialog {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    </style>
</head>
<body class="antialiased text-[14px] leading-relaxed tracking-normal text-slate-700 bg-slate-50/50" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500;">
    <div class="flex min-h-screen">
        <x-sidebar :active="$active ?? ''" />
        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/60 px-8 py-5 flex justify-between items-center sticky top-0 z-40">
                <h1 class="font-bold text-2xl text-slate-900 tracking-tight" style="font-family: 'Outfit', sans-serif;">@yield('title')</h1>
                @yield('header_action')
            </header>
            <main class="flex-1 p-8 bg-slate-50/50">
                @yield('content')
            </main>
        </div>
    </div>

    <div id="toast-container" style="position: fixed; bottom: 24px; right: 24px; z-index: 99999; display: flex; flex-direction: column; gap: 12px;"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('toast_success'))
                showToast("{{ session('toast_success') }}", 'success');
            @endif
            @if(session('toast_error'))
                showToast("{{ session('toast_error') }}", 'error');
            @endif
            @if(session('open_modal'))
                var modalEl = document.getElementById("{{ session('open_modal') }}");
                if (modalEl) {
                    new bootstrap.Modal(modalEl).show();
                }
            @endif
        });
    </script>
    <script>
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            let bgColor, iconColor, shadowColor, icon;
            if (type === 'success') {
                bgColor = '#ecfdf5';
                iconColor = '#10b981';
                shadowColor = 'rgba(16, 185, 129, 0.12)';
                icon = 'ic:baseline-check-circle';
            } else if (type === 'error') {
                bgColor = '#fef2f2';
                iconColor = '#ef4444';
                shadowColor = 'rgba(239, 68, 68, 0.12)';
                icon = 'ic:baseline-error';
            } else {
                bgColor = '#fffbeb';
                iconColor = '#f59e0b';
                shadowColor = 'rgba(245, 158, 11, 0.12)';
                icon = 'ic:baseline-warning';
            }

            toast.style.cssText = `
                display: flex;
                align-items: center;
                gap: 14px;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(12px);
                border: 1px solid ${iconColor}20;
                border-left: 5px solid ${iconColor};
                border-radius: 18px;
                padding: 16px 20px;
                box-shadow: 0 10px 25px -5px ${shadowColor}, 0 8px 10px -6px rgba(0,0,0,0.03);
                min-width: 320px;
                animation: slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            `;

            toast.innerHTML = `
                <div style="display:flex; align-items:center; justify-content:center; width:32px; height:32px; background:${bgColor}; border-radius:10px; flex-shrink:0;">
                    <span class="iconify" data-icon="${icon}" style="font-size:20px; color:${iconColor};"></span>
                </div>
                <span style="font-weight:600; color:#1e293b; flex:1; font-size:13.5px; letter-spacing:-0.01em;">${message}</span>
                <button onclick="closeToast(this)" style="background:none; border:none; cursor:pointer; color:#94a3b8; font-size:20px; padding:4px; line-height:1; transition:color 0.2s; display:flex; align-items:center;" onmouseenter="this.style.color='#475569'" onmouseleave="this.style.color='#94a3b8'">×</button>
            `;

            container.appendChild(toast);

            const timer = setTimeout(() => removeToast(toast), 4000);
            toast.dataset.timer = timer;
        }

        function closeToast(btn) {
            const toast = btn.closest('[style*="display: flex"]');
            removeToast(toast);
        }

        function removeToast(toast) {
            if (toast._removing) return;
            toast._removing = true;
            clearTimeout(Number(toast.dataset.timer));
            toast.style.animation = 'slideOut 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards';
            setTimeout(() => toast.remove(), 300);
        }
    </script>
    @stack('scripts')
</body>
</html>
