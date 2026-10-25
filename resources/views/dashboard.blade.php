<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f7fb;
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 14px;
        }

        a { text-decoration: none; color: inherit; }

        .layout { min-height: 100vh; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 245px;
            overflow-y: auto;
            background: #0b1220;
            color: #e2e8f0;
            display: flex;
            flex-direction: column;
        }

        .brand {
            padding: 25px 23px;
            border-bottom: 1px solid #263247;
        }

        .brand-name {
            color: white;
            font-size: 25px;
            font-weight: 800;
        }

        .brand-name span { color: #60a5fa; }

        .brand-subtitle {
            margin-top: 5px;
            color: #9aa9bf;
            font-size: 10px;
            letter-spacing: 1px;
        }

        .nav-label {
            padding: 23px 23px 10px;
            color: #8291a8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 0 12px;
        }

        .nav-link {
            display: block;
            padding: 12px 14px;
            border-radius: 8px;
            color: #b9c5d6;
            font-size: 13px;
        }

        .nav-link:hover { background: #151f32; color: white; }

        .nav-link.active {
            background: #2563eb;
            color: white;
        }

        .nav-icon {
            display: inline-block;
            width: 25px;
            font-size: 15px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 18px 16px;
            border-top: 1px solid #263247;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 15px;
        }

        .avatar {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 10px;
            background: #1e3a5f;
            color: #93c5fd;
            font-weight: 800;
        }

        .user-name {
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        .user-role {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 11px;
        }

        .logout {
            width: 100%;
            padding: 10px;
            border: 1px solid #344157;
            border-radius: 8px;
            background: transparent;
            color: #cbd5e1;
            cursor: pointer;
        }

        .logout:hover { background: #1e293b; }

        .main {
            min-width: 0;
            margin-left: 245px;
            padding: 30px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 28px;
        }

        .eyebrow {
            margin-bottom: 5px;
            color: #2563eb;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: #111c30;
            font-size: 28px;
        }

        .description {
            margin: 7px 0 0;
            color: #718096;
            font-size: 13px;
        }

        .today {
            padding: 11px 14px;
            border: 1px solid #e5eaf2;
            border-radius: 9px;
            background: white;
            color: #526078;
            font-size: 12px;
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 16px;
            border: 1px solid;
            border-radius: 9px;
        }

        .success {
            border-color: #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .error {
            border-color: #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .section-heading { margin-bottom: 15px; }

        .section-heading h2 {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
        }

        .section-heading p {
            margin: 4px 0 0;
            color: #718096;
            font-size: 12px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 28px;
        }

        .stat-card {
            min-width: 0;
            padding: 20px;
            border: 1px solid #e5eaf2;
            border-radius: 12px;
            background: white;
        }

        .stat-label {
            color: #66758b;
            font-size: 12px;
            font-weight: 600;
        }

        .stat-value {
            margin-top: 14px;
            color: #101a2c;
            font-size: 29px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .stat-footer {
            margin-top: 8px;
            color: #7b8799;
            font-size: 11px;
        }

        .stat-footer a {
            color: #2563eb;
            font-weight: 700;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
            margin-bottom: 28px;
        }

        .quick-card {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 16px;
            border: 1px solid #e5eaf2;
            border-radius: 11px;
            background: white;
            transition: .15s;
        }

        .quick-card:hover {
            transform: translateY(-2px);
            border-color: #93c5fd;
        }

        .quick-icon {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            border-radius: 9px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 19px;
        }

        .quick-title {
            font-size: 12px;
            font-weight: 800;
        }

        .quick-description {
            display: block;
            margin-top: 5px;
            color: #778399;
            font-size: 11px;
            line-height: 1.5;
        }

        .panel {
            margin-bottom: 23px;
            overflow: hidden;
            border: 1px solid #e5eaf2;
            border-radius: 12px;
            background: white;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 19px 21px;
            border-bottom: 1px solid #edf0f5;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 15px;
            font-weight: 800;
        }

        .panel-header p {
            margin: 4px 0 0;
            color: #7b8799;
            font-size: 12px;
        }

        .text-link {
            flex-shrink: 0;
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            white-space: nowrap;
        }

        thead { background: #f8fafc; }

        th {
            padding: 13px 19px;
            color: #65738a;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        td {
            padding: 14px 19px;
            border-top: 1px solid #f0f2f6;
            color: #475569;
            font-size: 12px;
        }

        tbody tr:hover { background: #fafcff; }

        .primary-text {
            color: #172033;
            font-weight: 700;
        }

        .badge-warning,
        .badge-ok {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 800;
        }

        .badge-warning {
            background: #fef2f2;
            color: #b91c1c;
        }

        .badge-ok {
            background: #ecfdf5;
            color: #047857;
        }

        .empty {
            padding: 30px 20px;
            color: #8995a7;
            text-align: center;
        }

        .footer {
            padding: 20px 0 4px;
            border-top: 1px solid #e5eaf2;
            color: #8b96a8;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 1150px) {
            .stats, .quick-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .main { padding: 23px; }
        }

        @media (max-width: 760px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .brand { padding: 19px 20px; }

            .nav-list {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sidebar-bottom { margin-top: 15px; }

            .main {
                margin-left: 0;
                padding: 22px 14px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            h1 { font-size: 25px; }
            .stat-card { padding: 15px; }
            .stat-value { font-size: 24px; }
            .quick-card { padding: 12px; }
            .panel-header { padding: 16px; }
            th, td { padding: 12px 14px; }
        }

        @media (max-width: 390px) {
            .stats, .quick-grid { grid-template-columns: 1fr; }
        }

        @media print {
            .sidebar, .quick-grid, .text-link { display: none !important; }
            .main { margin: 0; padding: 0; }
            body { background: white; }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-name">Inven<span>Track</span></div>
            <div class="brand-subtitle">INVENTORY MANAGEMENT SYSTEM</div>
        </div>

        <div class="nav-label">Menu Utama</div>

        <nav class="nav-list">
            <a href="{{ route('dashboard') }}" class="nav-link active">
                <span class="nav-icon">⌂</span> Dashboard
            </a>
            <a href="{{ route('categories.index') }}" class="nav-link">
                <span class="nav-icon">▦</span> Kategori
            </a>
            <a href="{{ route('products.index') }}" class="nav-link">
                <span class="nav-icon">▣</span> Produk
            </a>
            <a href="{{ route('suppliers.index') }}" class="nav-link">
                <span class="nav-icon">♙</span> Supplier
            </a>
            <a href="{{ route('purchases.index') }}" class="nav-link">
                <span class="nav-icon">↓</span> Stok Masuk
            </a>
            <a href="{{ route('sales.index') }}" class="nav-link">
                <span class="nav-icon">↗</span> Penjualan
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="user-info">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">
                        {{ auth()->user()->name ?? 'Pengguna' }}
                    </div>
                    <div class="user-role">
                        {{ ucfirst(auth()->user()->role ?? 'user') }}
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout">Keluar dari akun</button>
            </form>
        </div>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <div class="eyebrow">Overview</div>
                <h1>Dashboard</h1>
                <p class="description">
                    Ringkasan persediaan dan aktivitas inventaris.
                </p>
            </div>

            <div class="today">
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </header>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        <section>
            <div class="section-heading">
                <h2>Ringkasan Inventaris</h2>
                <p>Informasi utama persediaan saat ini.</p>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-value">
                        {{ number_format($totalProducts ?? 0) }}
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('products.index') }}">Kelola produk →</a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Kategori</div>
                    <div class="stat-value">
                        {{ number_format($totalCategories ?? 0) }}
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('categories.index') }}">Kelola kategori →</a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Supplier</div>
                    <div class="stat-value">
                        {{ number_format($totalSuppliers ?? 0) }}
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('suppliers.index') }}">Kelola supplier →</a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Stok</div>
                    <div class="stat-value">
                        {{ number_format($totalStock ?? 0) }}
                    </div>
                    <div class="stat-footer">Unit seluruh produk</div>
                </div>
            </div>
        </section>

        <section>
            <div class="section-heading">
                <h2>Akses Cepat</h2>
                <p>Langsung menuju aktivitas utama.</p>
            </div>

            <div class="quick-grid">
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="quick-card">
                        <span class="quick-icon">+</span>
                        <span>
                            <span class="quick-title">Tambah Produk</span>
                            <span class="quick-description">Daftarkan barang baru.</span>
                        </span>
                    </a>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'staff']))
                    <a href="{{ route('purchases.create') }}" class="quick-card">
                        <span class="quick-icon">↓</span>
                        <span>
                            <span class="quick-title">Stok Masuk</span>
                            <span class="quick-description">Catat pembelian barang.</span>
                        </span>
                    </a>

                    <a href="{{ route('sales.create') }}" class="quick-card">
                        <span class="quick-icon">↗</span>
                        <span>
                            <span class="quick-title">Penjualan</span>
                            <span class="quick-description">Buat transaksi baru.</span>
                        </span>
                    </a>
                @endif

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('suppliers.create') }}" class="quick-card">
                        <span class="quick-icon">♙</span>
                        <span>
                            <span class="quick-title">Tambah Supplier</span>
                            <span class="quick-description">Daftarkan pemasok baru.</span>
                        </span>
                    </a>
                @endif
            </div>
        </section>

        <section class="panel">
            <div class="panel-header">
                <div>
                    <h2>Perhatian Stok</h2>
                    <p>Produk dengan stok sama dengan atau di bawah batas minimum.</p>
                </div>
                <a href="{{ route('products.index') }}" class="text-link">
                    Lihat produk →
                </a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>SKU</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Minimum</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($lowStockProducts ?? collect()) as $product)
                            <tr>
                                <td class="primary-text">{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->category?->name ?? '-' }}</td>
                                <td>
                                    <span class="badge-warning">
                                        {{ $product->stock }} unit
                                    </span>
                                </td>
                                <td>{{ $product->minimum_stock }}</td>
                                <td>
                                    <span class="badge-warning">Stok menipis</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">
                                    Tidak ada produk dengan stok rendah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel">
            <div class="panel-header">
                <div>
                    <h2>Produk Terbaru</h2>
                    <p>Lima produk yang terakhir ditambahkan.</p>
                </div>
                <a href="{{ route('products.index') }}" class="text-link">
                    Semua produk →
                </a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>SKU</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Status Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($latestProducts ?? collect()) as $product)
                            <tr>
                                <td class="primary-text">{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->category?->name ?? '-' }}</td>
                                <td>
                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if ($product->stock <= $product->minimum_stock)
                                        <span class="badge-warning">
                                            {{ $product->stock }} unit
                                        </span>
                                    @else
                                        <span class="badge-ok">
                                            {{ $product->stock }} unit
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->stock <= $product->minimum_stock)
                                        <span class="badge-warning">Stok menipis</span>
                                    @else
                                        <span class="badge-ok">Stok aman</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">
                                    Belum ada produk yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="footer">
            InvenTrack · Inventory Management System
        </footer>

    </main>
</div>
</body>
</html>
