<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'F Standard') – Trading Terminal</title>

    <!-- Fonts & Icons (only once, globally) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    :root {
      --bg-app: #0b0e11;
      --bg-panel: #15181c;
      --bg-hover: #1e2229;
      --border-subtle: #25282f;

      --text-primary: #f2f2f2;
      --text-secondary: #9ea4ac;
      --text-dim: #676e78;

      --green: #26a69a;
      --green-bg: rgba(38, 166, 154, 0.15);
      --red: #ef5350;
      --red-bg: rgba(239, 83, 80, 0.15);
      --blue: #3b82f6;
      --blue-accent: #2962ff;

      --font-main: 'Inter', sans-serif;
      --font-num: 'JetBrains Mono', monospace;
    }

    * { box-sizing: border-box; outline: none; -webkit-font-smoothing: antialiased; }

    body {
      margin: 0;
      background-color: var(--bg-app);
      color: var(--text-primary);
      font-family: var(--font-main);
      font-size: 13px;
      overflow-y: hidden;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* --- Typography & Utilities --- */
    .mono { font-family: var(--font-num); font-variant-numeric: tabular-nums; }
    .text-green { color: var(--green); }
    .text-red { color: var(--red); }
    .text-blue { color: var(--blue); cursor: pointer; }
    .text-muted { color: var(--text-secondary); }
    .fw-600 { font-weight: 600; }
    .flex-center { display: flex; align-items: center; }
    .flex-between { display: flex; justify-content: space-between; align-items: center; }

    /* --- Top Navigation --- */
    .top-nav {
      height: 60px;
      background: var(--bg-app);
      border-bottom: 1px solid var(--border-subtle);
      padding: 0 24px;
      flex-shrink: 0;
      z-index: 100;
    }
    .main-menu { gap: 32px; margin-left: 48px; height: 100%; }
    .menu-item {
      height: 100%;
      display: flex;
      align-items: center;
      color: var(--text-secondary);
      cursor: pointer;
      position: relative;
      font-weight: 500;
      transition: color 0.2s;
    }
    .menu-item:hover { color: white; }
    .menu-item.active { color: var(--blue-accent); font-weight: 600; }
    .menu-item.active::after {
      content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; background: var(--blue-accent);
    }

    /* --- Page Containers --- */
    .main-container { flex-grow: 1; overflow: hidden; position: relative; }
    .page { display: none; width: 100%; height: 100%; overflow-y: auto; padding: 20px 24px; }
    .page.active { display: block; }
    #page-wishlist.active { display: flex; padding: 0; overflow: hidden; }

    /* --- MARKETS PAGE STYLES --- */
    .sub-nav {
      display: flex; gap: 24px; border-bottom: 1px solid var(--border-subtle); padding-bottom: 0; margin-bottom: 20px;
    }
    .sub-link { padding: 10px 0; color: var(--text-secondary); cursor: pointer; font-size: 13px; border-bottom: 2px solid transparent; }
    .sub-link.active { color: var(--blue-accent); border-bottom-color: var(--blue-accent); }

    .panel { background: var(--bg-panel); border: 1px solid var(--border-subtle); border-radius: 12px; overflow: hidden; margin-bottom: 20px; }
    .panel-header { padding: 16px 20px; border-bottom: 1px solid var(--border-subtle); font-weight: 600; }

    .ticker-strip { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1px; background: var(--border-subtle); border: 1px solid var(--border-subtle); border-radius: 12px; overflow: hidden; margin-bottom: 20px; }
    .ticker-item { background: var(--bg-panel); padding: 12px 16px; }

    .discovery-grid { display: grid; grid-template-columns: 40% 60%; }
    .hl-bar-container { margin: 40px 0; position: relative; }
    .hl-bar { height: 6px; width: 100%; background: linear-gradient(90deg, #ef5350 0%, #ffb74d 50%, #26a69a 100%); border-radius: 3px; }
    .hl-marker { position: absolute; top: -6px; left: 65%; width: 0; height: 0; border-left: 6px solid transparent; border-right: 6px solid transparent; border-top: 8px solid #eaeaea; transform: translateX(-50%); }

    .heatmap-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 10px; padding: 20px; }
    .heat-box { aspect-ratio: 1.5; border-radius: 6px; display: flex; flex-direction: column; justify-content: center; align-items: center; cursor: pointer; }
    .heat-green { background: #26a69a; color: #000; }
    .heat-red { background: #ef5350; color: white; }

    .table-dark { width: 100%; border-collapse: collapse; }
    .table-dark th { text-align: left; padding: 12px; color: var(--text-secondary); font-weight: 500; border-bottom: 1px solid var(--border-subtle); font-size: 11px; }
    .table-dark td { padding: 12px; border-bottom: 1px solid var(--border-subtle); }
    .tag { padding: 2px 6px; border-radius: 3px; font-size: 9px; font-weight: 700; margin-left: 6px; }
    .tag-itm { background: rgba(38, 166, 154, 0.2); color: var(--green); }

    /* --- WISHLIST PAGE STYLES --- */
    .wishlist-layout { display: flex; width: 100%; height: 100%; }

    .wl-sidebar { width: 300px; background: var(--bg-panel); border-right: 1px solid var(--border-subtle); display: flex; flex-direction: column; flex-shrink: 0; }
    .wl-header-box { padding: 12px 16px; border-bottom: 1px solid var(--border-subtle); }
    .search-input { width: 100%; background: var(--bg-app); border: 1px solid var(--border-subtle); padding: 8px 12px; color: white; border-radius: 6px; }
    .wl-items-container { overflow-y: auto; flex: 1; }
    .wl-item { display: flex; justify-content: space-between; padding: 12px 16px; border-bottom: 1px solid var(--border-subtle); cursor: pointer; }
    .wl-item:hover, .wl-item.active { background: var(--bg-hover); }
    .wl-item.active { border-left: 3px solid var(--blue); }

    .chart-area { flex: 1; display: flex; flex-direction: column; background: var(--bg-app); }
    .chart-topbar { height: 48px; border-bottom: 1px solid var(--border-subtle); display: flex; align-items: center; padding: 0 16px; gap: 16px; background: var(--bg-panel); }
    .chart-wrapper { flex: 1; position: relative; }
    .tv-chart-container { width: 100%; height: 100%; }

    .floating-trade { position: absolute; top: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 1px; background: var(--bg-panel); border-radius: 6px; overflow: hidden; border: 1px solid var(--border-subtle); z-index: 10; }
    .trade-btn { padding: 6px 16px; border: none; color: white; cursor: pointer; display: flex; flex-direction: column; align-items: center; min-width: 90px; }
    .trade-buy { background: var(--green); color: #000; }
    .trade-sell { background: var(--red); }

    .section { display: none; }
    .section.active { display: block; }
    .flash-up { animation: flashGreen 0.5s; }
    .flash-down { animation: flashRed 0.5s; }
    @keyframes flashGreen { 0% { color: var(--green); } 50% { color: white; } 100% { color: var(--green); } }
  </style>
    <!-- All your custom CSS pushed from dashboard.blade.php -->
    @stack('styles')
</head>
<body class="h-full bg-[#0b0e11] text-white" style="margin:0; padding:0; overflow:hidden; font-family:'Inter',sans-serif;">

    <div class="h-full flex flex-col">
        @yield('content')
    </div>

    <!-- All JavaScript (charts, live prices, navigation) -->
    @stack('scripts')
</body>
</html>
