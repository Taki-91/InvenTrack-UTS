<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | InvenTrack</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --maroon:#35101f; --maroon2:#4a1b2d; --accent:#84344f; --accent2:#a44765;
            --bg:#f8f4f5; --text:#2d1b23; --muted:#95838b; --border:#eee3e8;
            --white:#fff; --green:#198568; --red:#d84b5b; --orange:#d88a35;
        }
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:var(--text);font:13px 'Inter',sans-serif}
        a{color:inherit;text-decoration:none} button,input{font:inherit}
        .sidebar{position:fixed;inset:0 auto 0 0;width:245px;padding:27px 17px;background:linear-gradient(180deg,var(--maroon),#24101a);color:#fff;display:flex;flex-direction:column;z-index:10;overflow-y:auto}
        .brand{display:flex;align-items:center;gap:12px;padding:0 10px;margin-bottom:37px}
        .brand-icon{width:40px;height:40px;border-radius:13px;display:grid;place-items:center;background:linear-gradient(135deg,#b65b79,#762d46);font-size:19px;font-weight:800;box-shadow:0 7px 20px #84344f55}
        .brand-name{font-size:17px;font-weight:800;letter-spacing:-.5px}.brand-sub{color:#c5aab5;font-size:10px;margin-top:4px}
        .nav-label{padding:0 12px;margin:0 0 10px;color:#b08a9a;font-size:10px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase}
        .nav{display:grid;gap:5px;margin-bottom:28px}
        .nav a{min-height:43px;display:flex;align-items:center;gap:12px;padding:0 13px;border-radius:10px;color:#d7c2cb;font-weight:500;transition:.2s}
        .nav a:hover{background:#ffffff12;color:#fff}
        .nav a.active{color:#fff;background:linear-gradient(100deg,var(--accent),var(--accent2));box-shadow:0 5px 16px #84344f40}
        .nav-icon{width:20px;text-align:center;font-size:16px}
        .sidebar-bottom{margin-top:auto}.profile{display:flex;align-items:center;gap:10px;padding:15px 8px 0;border-top:1px solid #ffffff20}
        .avatar{width:37px;height:37px;border-radius:12px;display:grid;place-items:center;background:#6c354b;color:#ffeaf1;font-weight:800;flex-shrink:0}
        .profile-name{font-weight:600;font-size:12px}.profile-role{color:#c5aab5;font-size:10px;margin-top:5px}
        .logout{width:100%;margin-top:13px;padding:11px;border:1px solid #ffffff28;border-radius:9px;background:transparent;color:#e1cbd4;cursor:pointer;text-align:left}
        .logout:hover{background:#ffffff12;color:#fff}
        .main{margin-left:245px;padding:29px 32px 35px;max-width:1800px}
        .topbar{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:27px}
        .eyebrow{color:var(--accent);text-transform:uppercase;letter-spacing:1.5px;font-size:10px;font-weight:800;margin-bottom:8px}
        h1{margin:0;font-size:26px;letter-spacing:-.8px}.subtitle{color:var(--muted);margin-top:8px;line-height:1.6}
        .top-right{display:flex;align-items:center;gap:12px}.date-chip{padding:11px 14px;border:1px solid var(--border);border-radius:11px;background:#fff;color:#69515c;font-size:11px;white-space:nowrap}
        .role-chip{padding:9px 12px;border-radius:9px;color:#762d46;background:#f3e3e9;font-weight:800;font-size:10px;white-space:nowrap}
        .welcome{position:relative;overflow:hidden;display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:23px;padding:24px 27px;border-radius:17px;background:linear-gradient(115deg,#35101f,#84344f);color:#fff;box-shadow:0 10px 26px #4a1b2d20}
        .welcome:after{content:"";position:absolute;width:210px;height:210px;border:35px solid #ffffff0b;border-radius:50%;right:7%;top:-110px}
        .welcome h2{margin:0 0 9px;font-size:20px}.welcome p{margin:0;color:#f0dce4;line-height:1.7;font-size:12px}.welcome-mark{font-size:42px;opacity:.9;z-index:1}
        .section-heading{display:flex;justify-content:space-between;align-items:center;gap:12px;margin:27px 0 14px}
        .section-heading h2{margin:0;font-size:15px;font-weight:800}.section-heading p{margin:5px 0 0;color:var(--muted);font-size:11px}
        .stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:15px}
        .stat{background:#fff;border:1px solid var(--border);border-radius:14px;padding:18px;min-width:0;transition:transform .2s,box-shadow .2s}
        .stat:hover{transform:translateY(-3px);box-shadow:0 9px 24px #4a1b2d0c}
        .stat-top{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:17px}
        .stat-icon{width:40px;height:40px;display:grid;place-items:center;border-radius:12px;font-size:18px}
        .icon-blue{background:#f3e3e9;color:#84344f}.icon-green{background:#e8f8f1;color:#198568}.icon-orange{background:#fff3e4;color:#df8b1b}.icon-purple{background:#f1ecff;color:#7955db}.icon-red{background:#fff0f0;color:#d84b5b}
        .stat-tag{padding:6px 8px;background:#faf5f7;color:#927b86;border-radius:7px;font-size:9px;font-weight:700}
        .stat-label{color:#7b6871;font-size:11px;font-weight:600}.stat-value{margin-top:8px;font-size:clamp(19px,2vw,27px);letter-spacing:-.8px;font-weight:800;overflow-wrap:anywhere}
        .stat-note{margin-top:9px;color:#a3949c;font-size:10px}
        .grid-main{display:grid;grid-template-columns:minmax(0,1.65fr) minmax(270px,1fr);gap:17px;align-items:stretch}
        .panel{min-width:0;background:#fff;border:1px solid var(--border);border-radius:15px;padding:21px}
        .panel-header{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:20px}
        .panel-title{font-weight:800;font-size:13px}.panel-subtitle{color:var(--muted);font-size:10px;margin-top:6px}
        .chart-total{font-size:21px;font-weight:800;margin-top:13px;letter-spacing:-.5px}.chart-total small{font-size:10px;color:var(--muted);font-weight:500}
        .chart{height:200px;display:flex;gap:12px;align-items:stretch;padding-top:15px;border-bottom:1px solid var(--border);background:repeating-linear-gradient(to bottom,transparent 0,transparent 48px,#edf1f7 49px,transparent 50px)}
        .chart-column{flex:1;min-width:0;display:flex;flex-direction:column;align-items:center;justify-content:flex-end;gap:9px}
        .bar-area{width:100%;height:155px;display:flex;align-items:flex-end;justify-content:center}
        .bar{width:min(27px,72%);min-height:3px;border-radius:7px 7px 2px 2px;background:linear-gradient(180deg,#b76583,#84344f);transition:height .3s}
        .bar.today{background:linear-gradient(180deg,#30c9a0,#139b78)}.chart-day{color:#8994a7;font-size:9px;white-space:nowrap}.chart-value{color:#69768c;font-size:9px;min-height:11px}
        .chart-legend{display:flex;align-items:center;gap:7px;color:#8792a6;font-size:10px;margin-top:16px}
        .legend-dot{width:7px;height:7px;border-radius:50%;background:var(--accent)}.legend-dot.green{background:#159c71}
        .quick-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px}
        .quick-card{display:flex;align-items:center;gap:12px;padding:15px;min-height:77px;border:1px solid var(--border);border-radius:13px;background:#fff;transition:.2s}
        .quick-card:hover{border-color:#d6a8b8;box-shadow:0 7px 18px #84344f0d;transform:translateY(-2px)}
        .quick-icon{width:39px;height:39px;display:grid;place-items:center;flex-shrink:0;border-radius:11px;font-size:17px}
        .quick-title{font-size:11px;font-weight:800}.quick-desc{color:var(--muted);font-size:9px;margin-top:5px;line-height:1.5}
        .table-wrap{overflow-x:auto}table{width:100%;border-collapse:collapse;text-align:left}
        th{padding:11px 10px;color:#8a96a9;font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;background:#fcf8fa;white-space:nowrap}
        td{padding:13px 10px;border-bottom:1px solid #f1e8ec;color:#685661;font-size:10px;vertical-align:middle}
        tr:last-child td{border-bottom:none}.primary-text{color:#3b2731;font-weight:700;font-size:11px}.secondary-text{color:#a3949c;font-size:9px;margin-top:5px}.amount{color:#3b2731;font-weight:800;white-space:nowrap}
        .badge{display:inline-block;border-radius:6px;padding:5px 8px;font-size:9px;font-weight:700;white-space:nowrap}
        .badge-green{background:#e8f8f1;color:#12835f}.badge-red{background:#fff0f0;color:#d74747}.badge-orange{background:#fff4e5;color:#c47a17}.badge-blue{background:#f3e3e9;color:#84344f}.badge-gray{background:#f0f2f6;color:#748096}
        .product-rank{display:inline-grid;place-items:center;width:25px;height:25px;border-radius:8px;background:#f3e3e9;color:#84344f;font-weight:800}
        .stock-meter{height:5px;min-width:45px;margin-top:7px;background:#edf1f6;border-radius:5px;overflow:hidden}.stock-meter span{display:block;height:100%;border-radius:5px}
        .empty{text-align:center;padding:28px 12px;color:#98a2b2;font-size:11px}.footer{margin-top:27px;text-align:center;color:#9aa4b4;font-size:10px}
        @media(max-width:1250px){.main{padding:25px 22px}.stats{grid-template-columns:repeat(2,minmax(0,1fr))}.quick-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.grid-main{grid-template-columns:1fr}}
        @media(max-width:760px){.sidebar{position:static;width:100%;padding:16px}.brand{margin-bottom:16px}.nav-label{margin-top:10px}.nav{display:flex;overflow-x:auto;padding-bottom:5px;margin-bottom:10px}.nav a{flex-shrink:0;min-height:39px}.nav a span:last-child{font-size:11px}.sidebar-bottom{margin-top:10px}.profile{padding-top:12px}.logout{width:auto;padding:9px 13px}.main{margin-left:0;padding:22px 15px}.topbar{align-items:flex-start;flex-direction:column}.top-right{flex-wrap:wrap}h1{font-size:23px}.welcome{padding:21px}.welcome-mark{font-size:30px}.panel{padding:16px}.chart{gap:5px}.chart-day{font-size:8px}}
        @media(max-width:420px){.stats{grid-template-columns:1fr 1fr;gap:9px}.stat{padding:13px}.stat-value{font-size:20px}.stat-icon{width:34px;height:34px}.quick-grid{grid-template-columns:1fr;gap:9px}.quick-card{min-height:65px}.welcome h2{font-size:17px}.chart-total{font-size:18px}}
    </style>
</head>
<body>
@php
    $currentUser = auth()->user();
    $role = strtolower($currentUser->role ?? 'user');
    $isOwner = $role === 'owner';
    $isAdmin = $role === 'admin';
    $isStaff = $isOwner || $isAdmin;
    $isUser = $role === 'user';
    $maxChartValue = max(1, collect($chartSales ?? [])->max() ?? 0);
    $chartTotal = array_sum($chartSales ?? []);
    $formatMoney = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
    $formatNumber = fn ($value) => number_format((float) $value, 0, ',', '.');
@endphp

<aside class="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <div class="brand-icon">I</div>
        <div><div class="brand-name">InvenTrack</div><div class="brand-sub">Inventory Management</div></div>
    </a>
    <div class="nav-label">Menu utama</div>
    <nav class="nav">
        <a href="{{ route('dashboard') }}" class="active"><span class="nav-icon">▦</span><span>Dashboard</span></a>
        @if(Route::has('products.index'))
            <a href="{{ route('products.index') }}"><span class="nav-icon">▣</span><span>Produk</span></a>
        @endif
        @if($isStaff && Route::has('categories.index'))
            <a href="{{ route('categories.index') }}"><span class="nav-icon">▤</span><span>Kategori</span></a>
        @endif
       @if(($isOwner || $isAdmin) && Route::has('suppliers.index'))
    <a href="{{ route('suppliers.index') }}">
        <span class="nav-icon">♧</span>
        <span>Supplier</span>
    </a>
@endif
        @if($isStaff && Route::has('purchases.index'))
            <a href="{{ route('purchases.index') }}"><span class="nav-icon">⇩</span><span>Stok Masuk</span></a>
        @endif
        @if(Route::has('sales.index'))
            <a href="{{ route('sales.index') }}"><span class="nav-icon">⇧</span><span>Penjualan</span></a>
        @endif
    </nav>
    <div class="sidebar-bottom">
        <div class="profile">
            <div class="avatar">{{ strtoupper(substr($currentUser->name ?? 'U', 0, 1)) }}</div>
            <div><div class="profile-name">{{ $currentUser->name ?? 'Pengguna' }}</div>
                <div class="profile-role">{{ $isOwner ? 'Owner Account' : ($isAdmin ? 'Admin / Staff Account' : 'User Account') }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout" type="submit">↪ &nbsp; Keluar dari akun</button>
        </form>
    </div>
</aside>

<main class="main">
    <header class="topbar">
        <div><div class="eyebrow">Overview / Dashboard</div><h1>Dashboard</h1><div class="subtitle">Pantau kondisi inventaris dan aktivitas bisnis dalam satu tempat.</div></div>
        <div class="top-right">
            <div class="date-chip">▦ &nbsp; {{ now()->translatedFormat('l, d F Y') }}</div>
            <div class="role-chip">{{ $isOwner ? 'OWNER' : ($isAdmin ? 'ADMIN / STAFF' : 'USER') }}</div>
        </div>
    </header>

    <section class="welcome">
        <div><h2>Selamat datang, {{ $currentUser->name ?? 'Pengguna' }} 👋</h2>
            <p>@if($isOwner) Semua kendali inventaris ada di tanganmu. Pantau performa dan aktivitas toko hari ini.
            @elseif($isAdmin) Pantau stok, kategori, pembelian, dan transaksi penjualan hari ini.
            @else Lihat produk yang tersedia dan pantau riwayat transaksi penjualanmu. @endif</p>
        </div><div class="welcome-mark">◈</div>
    </section>

    <div class="section-heading"><div><h2>Ringkasan inventaris</h2><p>Informasi utama sistem saat ini</p></div></div>
    <section class="stats">
        <article class="stat"><div class="stat-top"><div class="stat-icon icon-blue">▣</div><span class="stat-tag">INVENTARIS</span></div><div class="stat-label">Total Produk</div><div class="stat-value">{{ $formatNumber($totalProducts) }}</div><div class="stat-note">Jumlah produk terdaftar</div></article>
        <article class="stat"><div class="stat-top"><div class="stat-icon icon-green">▤</div><span class="stat-tag">PERSEDIAAN</span></div><div class="stat-label">Total Stok</div><div class="stat-value">{{ $formatNumber($totalStock) }}</div><div class="stat-note">Unit barang yang tersedia</div></article>
        @if($isStaff)
            <article class="stat"><div class="stat-top"><div class="stat-icon icon-purple">▦</div><span class="stat-tag">KATEGORI</span></div><div class="stat-label">Total Kategori</div><div class="stat-value">{{ $formatNumber($totalCategories) }}</div><div class="stat-note">Kategori produk terdaftar</div></article>
            <article class="stat"><div class="stat-top"><div class="stat-icon icon-orange">⚠</div><span class="stat-tag">PERHATIAN</span></div><div class="stat-label">Stok Menipis</div><div class="stat-value">{{ $formatNumber($lowStock) }}</div><div class="stat-note">Produk mencapai batas minimum</div></article>
        @else
            <article class="stat"><div class="stat-top"><div class="stat-icon icon-purple">⇧</div><span class="stat-tag">TRANSAKSI</span></div><div class="stat-label">Total Transaksi</div><div class="stat-value">{{ $formatNumber($totalTransactions) }}</div><div class="stat-note">Transaksi selesai milikmu</div></article>
            <article class="stat"><div class="stat-top"><div class="stat-icon icon-orange">Rp</div><span class="stat-tag">PENJUALAN</span></div><div class="stat-label">Total Penjualanmu</div><div class="stat-value">{{ $formatMoney($totalSales) }}</div><div class="stat-note">Transaksi yang selesai</div></article>
        @endif
        @if($isOwner)
            <article class="stat"><div class="stat-top"><div class="stat-icon icon-blue">♧</div><span class="stat-tag">MITRA</span></div><div class="stat-label">Total Supplier</div><div class="stat-value">{{ $formatNumber($totalSuppliers) }}</div><div class="stat-note">Supplier terdaftar</div></article>
        @endif
        @if($isStaff)
            <article class="stat"><div class="stat-top"><div class="stat-icon icon-green">⇧</div><span class="stat-tag">PENJUALAN</span></div><div class="stat-label">Total Penjualan</div><div class="stat-value">{{ $formatMoney($totalSales) }}</div><div class="stat-note">Transaksi yang selesai</div></article>
            <article class="stat"><div class="stat-top"><div class="stat-icon icon-purple">⇩</div><span class="stat-tag">PEMBELIAN</span></div><div class="stat-label">Total Pembelian</div><div class="stat-value">{{ $formatMoney($totalPurchases) }}</div><div class="stat-note">Pembelian yang selesai</div></article>
        @endif
    </section>

    <div class="section-heading"><div><h2>Aktivitas hari ini</h2><p>Ringkasan transaksi pada {{ now()->translatedFormat('d F Y') }}</p></div></div>
    <section class="stats">
        <article class="stat"><div class="stat-top"><div class="stat-icon icon-blue">▣</div><span class="stat-tag">HARI INI</span></div><div class="stat-label">Transaksi Selesai</div><div class="stat-value">{{ $formatNumber($todayTransactions) }}</div><div class="stat-note">Jumlah transaksi hari ini</div></article>
        <article class="stat"><div class="stat-top"><div class="stat-icon icon-green">Rp</div><span class="stat-tag">HARI INI</span></div><div class="stat-label">Penjualan Hari Ini</div><div class="stat-value">{{ $formatMoney($todaySales) }}</div><div class="stat-note">Nilai transaksi yang selesai</div></article>
    </section>

    <div class="section-heading"><div><h2>Analisis penjualan</h2><p>Performa penjualan tujuh hari terakhir</p></div></div>
    <section class="grid-main">
        <article class="panel">
            <div class="panel-header"><div><div class="panel-title">Grafik Penjualan</div><div class="panel-subtitle">Nilai penjualan per hari</div><div class="chart-total">{{ $formatMoney($chartTotal) }} <small>/ 7 hari</small></div></div><span class="badge badge-blue">7 Hari</span></div>
            <div class="chart">
                @foreach($chartLabels as $index => $label)
                    @php $value=(float)($chartSales[$index]??0); $height=$value>0?max(5,($value/$maxChartValue)*100):2; $isToday=$index===count($chartLabels)-1; @endphp
                    <div class="chart-column"><div class="chart-value">{{ $value>0?number_format($value/1000,0,',','.').'k':'' }}</div><div class="bar-area"><div class="bar {{ $isToday?'today':'' }}" style="height:{{ $height }}%;" title="{{ $label }}: {{ $formatMoney($value) }}"></div></div><div class="chart-day">{{ $label }}</div></div>
                @endforeach
            </div>
            <div class="chart-legend"><span class="legend-dot"></span> Penjualan harian <span class="legend-dot green" style="margin-left:12px"></span> Hari ini</div>
        </article>
        <article class="panel">
            <div class="panel-header"><div><div class="panel-title">Produk Terlaris</div><div class="panel-subtitle">Berdasarkan jumlah barang terjual</div></div><span class="badge badge-blue">Top 5</span></div>
            @if($bestSellingProducts->isNotEmpty())
                <div class="table-wrap"><table><thead><tr><th>Produk</th><th>Terjual</th></tr></thead><tbody>
                    @foreach($bestSellingProducts as $index=>$product)
                        <tr><td><div class="primary-text">{{ $product->name }}</div><div class="secondary-text">{{ $product->sku }}</div></td><td><span class="badge {{ $index===0?'badge-green':'badge-blue' }}">{{ $formatNumber($product->total_quantity) }} unit</span></td></tr>
                    @endforeach
                </tbody></table></div>
            @else <div class="empty">Belum ada data penjualan selesai.</div> @endif
        </article>
    </section>

    <div class="section-heading"><div><h2>Akses cepat</h2><p>Pintasan menuju fitur yang sering digunakan</p></div></div>
    <section class="quick-grid">
        @if($isOwner && Route::has('products.create')) <a href="{{ route('products.create') }}" class="quick-card"><div class="quick-icon icon-blue">＋</div><div><div class="quick-title">Tambah Produk</div><div class="quick-desc">Daftarkan barang baru</div></div></a> @endif
        @if($isStaff && Route::has('categories.create')) <a href="{{ route('categories.create') }}" class="quick-card"><div class="quick-icon icon-purple">▤</div><div><div class="quick-title">Tambah Kategori</div><div class="quick-desc">Kelola kategori produk</div></div></a> @endif
        @if($isOwner && Route::has('suppliers.create')) <a href="{{ route('suppliers.create') }}" class="quick-card"><div class="quick-icon icon-orange">♧</div><div><div class="quick-title">Tambah Supplier</div><div class="quick-desc">Daftarkan mitra baru</div></div></a> @endif
        @if($isStaff && Route::has('purchases.create')) <a href="{{ route('purchases.create') }}" class="quick-card"><div class="quick-icon icon-green">⇩</div><div><div class="quick-title">Stok Masuk</div><div class="quick-desc">Catat barang masuk</div></div></a> @endif
        @if(Route::has('sales.create')) <a href="{{ route('sales.create') }}" class="quick-card"><div class="quick-icon icon-green">⇧</div><div><div class="quick-title">Transaksi Penjualan</div><div class="quick-desc">Buat transaksi baru</div></div></a> @endif
        @if(Route::has('products.index')) <a href="{{ route('products.index') }}" class="quick-card"><div class="quick-icon icon-blue">▣</div><div><div class="quick-title">Lihat Produk</div><div class="quick-desc">Periksa daftar inventaris</div></div></a> @endif
        @if(Route::has('sales.index')) <a href="{{ route('sales.index') }}" class="quick-card"><div class="quick-icon icon-purple">▤</div><div><div class="quick-title">Riwayat Penjualan</div><div class="quick-desc">Lihat transaksi penjualan</div></div></a> @endif
    </section>

    @if($isStaff)
        <div class="section-heading"><div><h2>Perhatian stok</h2><p>Produk yang stoknya menyentuh batas minimum</p></div>@if(Route::has('products.index')) <a href="{{ route('products.index') }}" class="badge badge-blue">Lihat produk ↗</a> @endif</div>
        <section class="panel">
            @if($lowStockProducts->isNotEmpty())
                <div class="table-wrap"><table><thead><tr><th>Produk</th><th>Kategori</th><th>Stok Saat Ini</th><th>Batas Minimum</th><th>Status</th></tr></thead><tbody>
                    @foreach($lowStockProducts as $product)
                        @php $minimum=max(1,(int)$product->minimum_stock); $stockPercent=min(100,((int)$product->stock/$minimum)*100); @endphp
                        <tr><td><div class="primary-text">{{ $product->name }}</div><div class="secondary-text">{{ $product->sku }}</div></td><td>{{ $product->category->name??'-' }}</td><td><span class="primary-text">{{ $formatNumber($product->stock) }}</span><div class="stock-meter"><span style="width:{{ $stockPercent }}%;background:{{ $product->stock==0?'#d84b5b':'#d88a35' }}"></span></div></td><td>{{ $formatNumber($product->minimum_stock) }}</td><td>@if($product->stock<=0)<span class="badge badge-red">Habis</span>@else<span class="badge badge-orange">Stok Menipis</span>@endif</td></tr>
                    @endforeach
                </tbody></table></div>
            @else <div class="empty">Semua produk berada di atas batas stok minimum.</div> @endif
        </section>
    @endif

    <div class="section-heading"><div><h2>Transaksi terbaru</h2><p>Lima transaksi terakhir yang tercatat</p></div>@if(Route::has('sales.index')) <a href="{{ route('sales.index') }}" class="badge badge-blue">Lihat semua ↗</a> @endif</div>
    <section class="panel">
        @if($recentSales->isNotEmpty())
            <div class="table-wrap"><table><thead><tr><th>No. Transaksi</th>@if(!$isUser)<th>Pengguna</th>@endif<th>Tanggal</th><th>Total</th><th>Status</th></tr></thead><tbody>
                @foreach($recentSales as $sale)
                    <tr><td><div class="primary-text">{{ $sale->sale_number??('TRX-'.$sale->id) }}</div><div class="secondary-text">ID #{{ $sale->id }}</div></td>@if(!$isUser)<td>{{ $sale->user->name??'-' }}</td>@endif<td>{{ $sale->sale_date?\Illuminate\Support\Carbon::parse($sale->sale_date)->format('d/m/Y'):'-' }}</td><td class="amount">{{ $formatMoney($sale->total_amount) }}</td><td>@if(strtolower($sale->status??'')==='completed')<span class="badge badge-green">Selesai</span>@elseif(strtolower($sale->status??'')==='cancelled')<span class="badge badge-red">Dibatalkan</span>@else<span class="badge badge-gray">{{ ucfirst($sale->status??'Unknown') }}</span>@endif</td></tr>
                @endforeach
            </tbody></table></div>
        @else <div class="empty">Belum ada transaksi yang tercatat.</div> @endif
    </section>

    @if($isStaff)
        <div class="section-heading"><div><h2>Produk terbaru</h2><p>Produk yang terakhir ditambahkan ke inventaris</p></div></div>
        <section class="panel">
            @if($latestProducts->isNotEmpty())
                <div class="table-wrap"><table><thead><tr><th>Produk</th><th>Kategori</th><th>Harga Jual</th><th>Stok</th><th>Kondisi</th></tr></thead><tbody>
                    @foreach($latestProducts as $product)
                        <tr><td><div class="primary-text">{{ $product->name }}</div><div class="secondary-text">{{ $product->sku }}</div></td><td>{{ $product->category->name??'-' }}</td><td class="amount">{{ $formatMoney($product->selling_price) }}</td><td>{{ $formatNumber($product->stock) }}</td><td>@if(!$product->is_active)<span class="badge badge-gray">Nonaktif</span>@elseif($product->stock<=0)<span class="badge badge-red">Habis</span>@elseif($product->stock<=$product->minimum_stock)<span class="badge badge-orange">Menipis</span>@else<span class="badge badge-green">Tersedia</span>@endif</td></tr>
                    @endforeach
                </tbody></table></div>
            @else <div class="empty">Belum ada produk yang ditambahkan.</div> @endif
        </section>
    @endif

    <footer class="footer">InvenTrack · Inventory Management System · {{ now()->format('Y') }}</footer>
</main>
</body>
</html>
