<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .flatpickr-day.selected,
        .flatpickr-day.selected:hover {
            background: #059669;
            border-color: #059669;
        }

        @keyframes slideIn {
            from { transform: translateX(120%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(120%); opacity: 0; }
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
        }

        .modal.show {
            display: block;
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-backdrop.fade {
            opacity: 0;
        }

        .modal-backdrop.show {
            opacity: 0.5;
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: 1.75rem auto;
            max-width: 500px;
            pointer-events: none;
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
        }

        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translateY(-50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }
    </style>
</head>
<body class="font-sans antialiased text-[14px] leading-relaxed tracking-normal text-slate-700 bg-slate-50/50" style="font-weight: 500;">
    <div class="flex min-h-screen">
        <x-sidebar :active="$active ?? ''" />
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-slate-200/80 px-8 py-5 flex justify-between items-center">
                <h1 class="font-semibold text-xl text-slate-900">@yield('title')</h1>
                @yield('header_action')
            </header>
            <main class="flex-1 p-8 bg-slate-50/50">
                @yield('content')
            </main>
        </div>
    </div>

    <div id="toast-container" style="position: fixed; top: 24px; right: 24px; z-index: 99999; display: flex; flex-direction: column; gap: 12px;"></div>

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
            const bgColor = type === 'success' ? '#22c55e' : type === 'error' ? '#ef4444' : '#f97316';
            const icon = type === 'success' ? 'ic:baseline-check-circle' : type === 'error' ? 'ic:baseline-error' : 'ic:baseline-warning';

            toast.style.cssText = 'display:flex; align-items:center; gap:12px; background:white; border-left:4px solid ' + bgColor + '; border-radius:8px; padding:16px 20px; box-shadow:0 4px 12px rgba(0,0,0,0.15); min-width:300px; animation:slideIn 0.3s ease;';
            toast.innerHTML =
                '<span class="iconify" data-icon="' + icon + '" style="font-size:22px; color:' + bgColor + '; flex-shrink:0;"></span>' +
                '<span style="font-weight:600; color:#111827; flex:1;">' + message + '</span>' +
                '<button onclick="closeToast(this)" style="background:none; border:none; cursor:pointer; color:#9ca3af; font-size:18px; font-weight:bold; padding:0 0 0 12px; line-height:1;">×</button>';

            container.appendChild(toast);

            const timer = setTimeout(() => removeToast(toast), 3000);
            toast.dataset.timer = timer;
        }

        function closeToast(btn) {
            const toast = btn.parentElement;
            removeToast(toast);
        }

        function removeToast(toast) {
            if (toast._removing) return;
            toast._removing = true;
            clearTimeout(Number(toast.dataset.timer));
            toast.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => toast.remove(), 300);
        }
    </script>
    @stack('scripts')
</body>
</html>
