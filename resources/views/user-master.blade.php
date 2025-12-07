<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Trading Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        :root {
            --primary: #ff8c00;
            --bg-dark: #121721;
            --card-bg: #1e2530;
            --border: #2d3748;
            --text: #e0e0e0;
            --sidebar-width: 260px;
        }
        body { background: var(--bg-dark); color: var(--text); font-family: 'Inter', sans-serif; min-height: 100vh; overflow-x: hidden; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #0f1419, #0d1117);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 30px 20px;
            border-right: 1px solid var(--border);
            transition: left 0.3s ease;
            overflow-y: auto;
        }
        .sidebar-logo img { height: 55px; filter: brightness(0) invert(1); }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 8px;
            cursor: pointer;
            color: #e6edf3;
            font-weight: 500;
            transition: all .3s;
        }
        .menu-item:hover { background: rgba(255,140,0,0.15); color: #fff; }
        .menu-item.active { background: rgba(255,140,0,0.25); color: #fff; font-weight: 600; box-shadow: 0 4px 15px rgba(255,140,0,0.2); }
        .menu-item i { width: 20px; text-align: center; }

        /* Main Content */
        .content { margin-left: var(--sidebar-width); transition: all .3s; }
        .main-wrapper { max-width: 1400px; margin: 0 auto; padding: 30px; }
        .card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); }

        /* Top Bar (Logo + Menu Button) - Only visible on mobile */
        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: #0d1117;
            border-bottom: 1px solid var(--border);
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 999;
        }
        .top-bar img { height: 45px; filter: brightness(0) invert(1); }
        .menu-btn {
            background: var(--primary);
            color: white;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            font-size: 20px;
            border: none;
            box-shadow: 0 6px 20px rgba(255,140,0,0.4);
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .top-bar { display: flex !important; }
            .sidebar { left: calc(-1 * var(--sidebar-width)); }
            .sidebar.show { left: 0; }
            .content { margin-left: 0 !important; }
            .main-wrapper { padding-top: 90px; padding-left: 15px; padding-right: 15px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- TOP BAR: Logo (Left) + Menu Button (Right) - Mobile Only -->
    <div class="top-bar">
        <img src="{{ asset('dlogo.png') }}" alt="Logo">
        <button class="menu-btn">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- Sidebar (Hidden on mobile until toggled) -->
    <div class="sidebar">
        <div class="text-center mb-5 pt-3">
            <a href="{{ url('/') }}"><img src="{{ asset('dlogo.png') }}" alt="Logo" class="sidebar-logo"></a>
        </div>

        <div class="menu-item {{ request()->is('overview') ? 'active' : '' }}" onclick="window.location='{{ route('overview') }}'">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </div>
        <div class="menu-item {{ request()->is('orders') ? 'active' : '' }}" onclick="window.location='{{ route('orders') }}'">
            <i class="fa-solid fa-shopping-cart"></i> Orders
        </div>
        <div class="menu-item {{ request()->is('trade-history') ? 'active' : '' }}" onclick="window.location='{{ route('trade.history') }}'">
            <i class="fa-solid fa-history"></i> Trade History
        </div>
        <div class="menu-item {{ request()->is('deposit-history') ? 'active' : '' }}" onclick="window.location='{{ route('deposit.history') }}'">
            <i class="fa-solid fa-wallet"></i> Plan Purchases
        </div>
        <div class="menu-item {{ request()->is('withdraw-history') ? 'active' : '' }}" onclick="window.location='{{ route('withdraw.history') }}'">
            <i class="fa-solid fa-money-bill-transfer"></i> Withdraw History
        </div>
        <div class="menu-item {{ request()->is('kyc') ? 'active' : '' }}" onclick="window.location='{{ route('kyc') }}'">
            <i class="fa-solid fa-id-card"></i> KYC
        </div>
        <div class="menu-item {{ request()->is('affiliation') ? 'active' : '' }}" onclick="window.location='{{ route('affiliation') }}'">
            <i class="fa-solid fa-users"></i> My Affiliation
        </div>
        <div class="menu-item {{ request()->is('calculator') ? 'active' : '' }}" onclick="window.location='{{ route('calculator') }}'">
            <i class="fa-solid fa-calculator"></i> Calculator
        </div>
        <div class="menu-item {{ request()->is('transactions') ? 'active' : '' }}" onclick="window.location='{{ route('transactions') }}'">
            <i class="fa-solid fa-exchange-alt"></i> Transactions
        </div>
        <div class="menu-item {{ request()->is('support') ? 'active' : '' }}" onclick="window.location='{{ route('tickets.create') }}'">
            <i class="fa-solid fa-headset"></i> Support
        </div>

        <div class="menu-item mt-5" style="background:rgba(239,68,68,0.2);color:#fca5a5;" onclick="window.location='{{ url('logout') }}'">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="main-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle sidebar on mobile
            $('.menu-btn').click(function(e) {
                e.stopPropagation();
                $('.sidebar').toggleClass('show');
            });

            // Close sidebar when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('.sidebar, .menu-btn').length) {
                    $('.sidebar').removeClass('show');
                }
            });

            // Close sidebar when clicking a menu item (mobile)
            $('.menu-item').click(function() {
                if ($(window).width() <= 992) {
                    $('.sidebar').removeClass('show');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
