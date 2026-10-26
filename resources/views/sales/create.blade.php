<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaksi Baru | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon: #3D1025;
            --burgundy: #762D46;
            --accent: #A64D68;
            --bg: #F8F4F5;
            --text: #30212A;
            --muted: #8B7B83;
            --border: #EEE3E8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        button, input, select, textarea { font: inherit; }
        button, a, input, select, textarea { -webkit-tap-highlight-color: transparent; }

        .app { min-height: 100vh; }

        .sidebar {
            width: 245px;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 30;
            display: flex;
            flex-direction: column;
            padding: 27px 17px 20px;
            background: var(--maroon);
            color: white;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 9px 28px;
        }

        .brand-icon {
            display: grid;
            place-items: center;
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border-radius: 13px;
            background: #762D46;
            font-size: 20px;
            font-weight: 800;
        }

        .brand-name { font-size: 17px; font-weight: 800; letter-spacing: -.5px; }
        .brand-sub { margin-top: 4px; font-size: 10px; color: #D9BFC9; letter-spacing: 1.5px; }

        .nav-label {
            margin: 10px 11px 9px;
            color: #BFA4AF;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 13px;
            margin: 3px 0;
            border-radius: 10px;
            color: #E4D5DB;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: .2s;
        }

        .nav-link:hover { background: #542037; color: white; }
        .nav-link.active { background: #762D46; color: white; font-weight: 700; }
        .nav-icon { width: 20px; text-align: center; font-size: 16px; }

        .sidebar-bottom { margin-top: auto; }
        .sidebar-note {
            margin: 12px 3px 17px;
            padding: 14px;
            border: 1px solid #653149;
            border-radius: 12px;
            background: #49192F;
        }

        .sidebar-note strong { display: block; font-size: 12px; }
        .sidebar-note p { margin: 7px 0 0; color: #D9BFC9; font-size: 11px; line-height: 1.6; }

        .user-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 5px 0;
            border-top: 1px solid #653149;
        }

        .avatar {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #A64D68;
            color: white;
            font-weight: 800;
            font-size: 13px;
        }

        .user-name {
            overflow: hidden;
            max-width: 145px;
            color: white;
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-role { margin-top: 4px; color: #D9BFC9; font-size: 10px; }

        .main { min-height: 100vh; margin-left: 245px; }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-height: 76px;
            padding: 17px 34px;
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .breadcrumb { color: var(--muted); font-size: 12px; }
        .breadcrumb strong { color: var(--burgundy); }

        .topbar-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--burgundy);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .content { max-width: 1450px; margin: 0 auto; padding: 30px 34px 45px; }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: var(--accent);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        h1 { margin: 9px 0 8px; color: var(--maroon); font-size: clamp(24px, 3vw, 31px); letter-spacing: -1.1px; }
        .page-description { max-width: 620px; color: var(--muted); font-size: 13px; line-height: 1.7; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 11px 16px;
            border: 1px solid transparent;
            border-radius: 10px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary { background: var(--maroon); color: white; }
        .btn-primary:hover { background: var(--burgundy); transform: translateY(-1px); }
        .btn-secondary { background: white; border-color: var(--border); color: var(--burgundy); }
        .btn-secondary:hover { background: #FBF6F8; }
        .btn:disabled { opacity: .5; cursor: not-allowed; transform: none; }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 23px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
            padding: 19px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: white;
        }

        .stat-icon {
            display: grid;
            place-items: center;
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border-radius: 12px;
            background: #F8EAF0;
            color: var(--burgundy);
            font-size: 19px;
        }

        .stat-label { color: var(--muted); font-size: 11px; line-height: 1.5; }
        .stat-value { margin-top: 5px; color: var(--maroon); font-size: 19px; font-weight: 800; letter-spacing: -.5px; overflow-wrap: anywhere; }

        .panel {
            margin-bottom: 20px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: white;
            box-shadow: 0 3px 12px rgba(61,16,37,.025);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 21px 23px;
            border-bottom: 1px solid var(--border);
        }

        .panel-title { margin: 0; color: var(--maroon); font-size: 15px; font-weight: 800; }
        .panel-subtitle { margin-top: 6px; color: var(--muted); font-size: 11px; line-height: 1.6; }

        .panel-body { padding: 23px; }

        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }

        .field-label {
            display: block;
            margin-bottom: 9px;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
        }

        .required { color: #B4234B; }

        .field, .select-field, .textarea-field {
            display: block;
            width: 100%;
            min-height: 44px;
            padding: 11px 12px;
            border: 1px solid #E5D5DC;
            border-radius: 9px;
            outline: none;
            background: white;
            color: var(--text);
            font-size: 12px;
            transition: border-color .2s, box-shadow .2s;
        }

        .field:focus, .select-field:focus, .textarea-field:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(166,77,104,.1);
        }

        .field-help { margin-top: 7px; color: var(--muted); font-size: 10px; line-height: 1.6; }

        .product-list { display: grid; gap: 13px; }

        .product-row {
            padding: 17px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #FFFCFD;
            transition: border-color .2s, box-shadow .2s;
            animation: appear .2s ease;
        }

        .product-row:focus-within {
            border-color: #D5A7B7;
            box-shadow: 0 3px 12px rgba(118,45,70,.05);
        }

        @keyframes appear {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .row-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 15px;
        }

        .row-number {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--burgundy);
            font-size: 11px;
            font-weight: 800;
        }

        .row-number span {
            display: grid;
            place-items: center;
            width: 25px;
            height: 25px;
            border-radius: 8px;
            background: #F6E7ED;
        }

        .remove-row {
            padding: 7px 10px;
            border: 1px solid #F0D6DE;
            border-radius: 8px;
            background: white;
            color: #B4234B;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .remove-row:hover { background: #FFF1F3; }
        .remove-row:disabled { opacity: .35; cursor: not-allowed; }

        .row-grid {
            display: grid;
            grid-template-columns: minmax(0, 2.2fr) minmax(90px, .7fr);
            gap: 15px;
        }

        .subtotal-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px dashed #E9D9E0;
            font-size: 11px;
        }

        .subtotal-label { color: var(--muted); }
        .subtotal-value { color: var(--burgundy); font-size: 13px; font-weight: 800; }

        .stock-warning { display: none; margin-top: 8px; color: #B4234B; font-size: 10px; font-weight: 600; }
        .stock-warning.show { display: block; }

        .add-area {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .add-hint { color: var(--muted); font-size: 10px; line-height: 1.6; }

        .summary-box {
            padding: 22px;
            border: 1px solid #EBD5DF;
            border-radius: 13px;
            background: linear-gradient(135deg, #FCF4F7 0%, #FFF 100%);
        }

        .summary-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .summary-label { color: var(--muted); font-size: 11px; font-weight: 600; }
        .grand-total { margin-top: 8px; color: var(--maroon); font-size: clamp(25px, 4vw, 34px); font-weight: 800; letter-spacing: -1px; overflow-wrap: anywhere; }
        .summary-count { margin-top: 7px; color: var(--muted); font-size: 11px; line-height: 1.6; }

        .summary-badge {
            padding: 8px 10px;
            border: 1px solid #E9D2DC;
            border-radius: 9px;
            background: white;
            color: var(--burgundy);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .summary-divider { height: 1px; margin: 19px 0; background: #EBDDE3; }

        .summary-detail { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-top: 12px; font-size: 11px; }
        .summary-detail span { color: var(--muted); }
        .summary-detail strong { color: var(--text); text-align: right; }

        .notes-area { margin-top: 22px; }

        .alert {
            margin-bottom: 20px;
            padding: 15px 17px;
            border-radius: 11px;
            font-size: 12px;
            line-height: 1.7;
        }

        .alert-error { border: 1px solid #F1C8D0; background: #FFF3F4; color: #9F243D; }
        .alert-warning { border: 1px solid #EEDCA6; background: #FFFBEB; color: #854D0E; }
        .alert ul { margin: 8px 0 0; padding-left: 19px; }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 5px;
        }

        .mobile-menu { display: none; }
        .empty-products { padding: 28px; text-align: center; }
        .empty-icon { font-size: 30px; }
        .empty-products h2 { margin: 12px 0 7px; color: var(--maroon); font-size: 16px; }
        .empty-products p { margin: 0 auto 17px; max-width: 420px; color: var(--muted); font-size: 12px; line-height: 1.8; }

        @media (max-width: 1050px) {
            .sidebar { width: 220px; }
            .main { margin-left: 220px; }
            .content { padding: 25px 23px 35px; }
            .topbar { padding-inline: 23px; }
            .stats { gap: 10px; }
            .stat-card { padding: 14px; }
            .stat-icon { width: 37px; height: 37px; }
        }

        @media (max-width: 760px) {
            .sidebar {
                width: min(280px, 85vw);
                transform: translateX(-105%);
                transition: transform .25s ease;
                box-shadow: 12px 0 35px rgba(0,0,0,.15);
            }

            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar { min-height: 65px; padding: 13px 17px; }
            .mobile-menu {
                display: inline-grid;
                place-items: center;
                width: 37px;
                height: 37px;
                border: 1px solid var(--border);
                border-radius: 9px;
                background: white;
                color: var(--burgundy);
                cursor: pointer;
                font-size: 19px;
            }

            .topbar-left { display: flex; align-items: center; gap: 11px; }
            .content { padding: 23px 16px 30px; }
            .page-heading { flex-direction: column; align-items: stretch; gap: 15px; }
            .page-heading .btn { align-self: flex-start; }
            .stats { grid-template-columns: 1fr; }
            .stat-card { padding: 15px; }
            .stat-value { font-size: 18px; }
            .panel-heading { padding: 17px; }
            .panel-body { padding: 17px; }
            .field-grid { grid-template-columns: 1fr; gap: 16px; }
            .row-grid { grid-template-columns: minmax(0, 1fr) 100px; gap: 11px; }
            .product-row { padding: 13px; }
            .summary-box { padding: 18px; }
            .topbar-tag { font-size: 10px; }
        }

        @media (max-width: 390px) {
            .row-grid { grid-template-columns: 1fr; }
            .topbar-tag { padding: 8px; }
            .breadcrumb { font-size: 11px; }
            .form-actions { flex-direction: column-reverse; align-items: stretch; }
            .form-actions .btn { width: 100%; }
        }
    </style>
</head>

<body>
<div class="app">
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-icon">I</div>
            <div>
                <div class="brand-name">InvenTrack</div>
                <div class="brand-sub">INVENTORY SYSTEM</div>
            </div>
        </div>

        <div class="nav-label">Menu Utama</div>

        <a href="{{ route('dashboard') }}" class="nav-link">
            <span class="nav-icon">⌂</span> Dashboard
        </a>

        <a href="{{ route('products.index') }}" class="nav-link">
            <span class="nav-icon">▦</span> Produk
        </a>

        @if (auth()->user() && in_array(auth()->user()->role ?? '', ['owner', 'admin']))
            <a href="{{ route('categories.index') }}" class="nav-link">
                <span class="nav-icon">▤</span> Kategori
            </a>

            <a href="{{ route('suppliers.index') }}" class="nav-link">
                <span class="nav-icon">♧</span> Supplier
            </a>
        @endif

        <div class="nav-label">Transaksi</div>

        @if (auth()->user() && in_array(auth()->user()->role ?? '', ['owner', 'admin']))
            <a href="{{ route('purchases.index') }}" class="nav-link">
                <span class="nav-icon">↓</span> Stok Masuk
            </a>
        @endif

        <a href="{{ route('sales.index') }}" class="nav-link active">
            <span class="nav-icon">↗</span> Penjualan
        </a>

        <div class="sidebar-bottom">
            <div class="sidebar-note">
                <strong>Transaksi Penjualan</strong>
                <p>Pastikan produk dan jumlah barang sudah sesuai sebelum menyimpan transaksi.</p>
            </div>

            <div class="user-box">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">{{ auth()->user()->name ?? 'Pengguna' }}</div>
                    <div class="user-role">{{ ucfirst(auth()->user()->role ?? 'User') }}</div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" style="margin-top:12px">
                @csrf
                <button type="submit" class="nav-link" style="width:100%;border:0;background:transparent;cursor:pointer;text-align:left">
                    <span class="nav-icon">↪</span> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button type="button" id="menu-toggle" class="mobile-menu" aria-label="Buka menu">☰</button>
                <div class="breadcrumb">
                    Transaksi <span style="padding:0 7px;color:#C8B5BE">/</span>
                    <strong>Transaksi Baru</strong>
                </div>
            </div>

            <div class="topbar-tag">
                <span>●</span> Sistem Inventaris
            </div>
        </header>

        <div class="content">
            <div class="page-heading">
                <div>
                    <div class="eyebrow">InvenTrack / Penjualan</div>
                    <h1>Transaksi Penjualan</h1>
                    <div class="page-description">
                        Catat barang yang terjual, atur jumlahnya, dan pantau estimasi nilai transaksi secara langsung.
                    </div>
                </div>

                <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                    ← Kembali ke Penjualan
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Transaksi belum bisa disimpan.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($products->isEmpty())
                <div class="panel">
                    <div class="empty-products">
                        <div class="empty-icon">▦</div>
                        <h2>Stok belum tersedia</h2>
                        <p>
                            Tidak ada produk aktif dengan stok tersedia. Tambahkan stok produk terlebih dahulu sebelum membuat transaksi penjualan.
                        </p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            Lihat Daftar Produk
                        </a>
                    </div>
                </div>
            @else
                <div class="stats">
                    <div class="stat-card">
                        <div class="stat-icon">▦</div>
                        <div>
                            <div class="stat-label">Jenis Produk</div>
                            <div class="stat-value" id="stat-products">0</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">＋</div>
                        <div>
                            <div class="stat-label">Total Unit</div>
                            <div class="stat-value" id="stat-units">0</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">Rp</div>
                        <div>
                            <div class="stat-label">Estimasi Penjualan</div>
                            <div class="stat-value" id="stat-total">Rp 0</div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('sales.store') }}" id="sales-form">
                    @csrf

                    <section class="panel">
                        <div class="panel-heading">
                            <div>
                                <h2 class="panel-title">Informasi Transaksi</h2>
                                <div class="panel-subtitle">Isi tanggal transaksi sebelum memilih barang yang terjual.</div>
                            </div>
                            <span class="summary-badge">01 / INFORMASI</span>
                        </div>

                        <div class="panel-body">
                            <div class="field-grid">
                                <div>
                                    <label for="sale_date" class="field-label">
                                        Tanggal Penjualan <span class="required">*</span>
                                    </label>
                                    <input
                                        id="sale_date"
                                        type="date"
                                        name="sale_date"
                                        value="{{ old('sale_date', now()->format('Y-m-d')) }}"
                                        required
                                        class="field"
                                    >
                                    <div class="field-help">Gunakan tanggal saat transaksi dilakukan.</div>
                                </div>

                                <div>
                                    <label class="field-label">Status Transaksi</label>
                                    <div class="field" style="display:flex;align-items:center;gap:9px;background:#FAF7F8">
                                        <span style="color:#16A36A">●</span>
                                        <span style="font-weight:700">Siap disimpan</span>
                                    </div>
                                    <div class="field-help">Transaksi akan diproses setelah tombol simpan ditekan.</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-heading">
                            <div>
                                <h2 class="panel-title">Produk Terjual</h2>
                                <div class="panel-subtitle">Pilih produk dan masukkan jumlah barang yang terjual.</div>
                            </div>
                            <span class="summary-badge">02 / PRODUK</span>
                        </div>

                        <div class="panel-body">
                            <div id="product-rows" class="product-list">
                                @php
                                    $oldProductIds = old('product_ids', ['']);
                                    $oldQuantities = old('quantities', [1]);
                                    $rowCount = max(count($oldProductIds), count($oldQuantities), 1);
                                @endphp

                                @for ($i = 0; $i < $rowCount; $i++)
                                    <div class="product-row">
                                        <div class="row-top">
                                            <div class="row-number">
                                                <span class="row-index">{{ $i + 1 }}</span>
                                                Produk Penjualan
                                            </div>

                                            <button type="button" class="remove-row">
                                                Hapus
                                            </button>
                                        </div>

                                        <div class="row-grid">
                                            <div>
                                                <label class="field-label">Pilih Produk <span class="required">*</span></label>
                                                <select name="product_ids[]" required class="select-field product-select">
                                                    <option value="">Pilih produk...</option>
                                                    @foreach ($products as $product)
                                                        <option
                                                            value="{{ $product->id }}"
                                                            data-price="{{ $product->selling_price }}"
                                                            data-stock="{{ $product->stock }}"
                                                            @selected((string) ($oldProductIds[$i] ?? '') === (string) $product->id)
                                                        >
                                                            {{ $product->name }} | Stok: {{ $product->stock }} | Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="field-help product-meta">Harga dan stok akan tampil setelah produk dipilih.</div>
                                            </div>

                                            <div>
                                                <label class="field-label">Jumlah <span class="required">*</span></label>
                                                <input
                                                    type="number"
                                                    name="quantities[]"
                                                    min="1"
                                                    step="1"
                                                    value="{{ old('quantities.' . $i, 1) }}"
                                                    required
                                                    class="field quantity-input"
                                                >
                                                <div class="stock-warning">Jumlah melebihi stok yang tersedia.</div>
                                            </div>
                                        </div>

                                        <div class="subtotal-line">
                                            <span class="subtotal-label">Subtotal produk</span>
                                            <span class="subtotal-value row-total">Rp 0</span>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div class="add-area">
                                <div class="add-hint">Produk yang sama hanya bisa ditambahkan satu kali.</div>
                                <button type="button" id="add-row" class="btn btn-secondary">
                                    ＋ Tambah Produk
                                </button>
                            </div>
                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-heading">
                            <div>
                                <h2 class="panel-title">Ringkasan Penjualan</h2>
                                <div class="panel-subtitle">Periksa kembali jumlah barang dan estimasi total sebelum menyimpan.</div>
                            </div>
                            <span class="summary-badge">03 / RINGKASAN</span>
                        </div>

                        <div class="panel-body">
                            <div class="summary-box">
                                <div class="summary-top">
                                    <div>
                                        <div class="summary-label">Estimasi Total Penjualan</div>
                                        <div id="grand-total" class="grand-total">Rp 0</div>
                                        <div class="summary-count" id="summary-caption">Belum ada produk yang dipilih.</div>
                                    </div>
                                    <div class="summary-badge">TOTAL</div>
                                </div>

                                <div class="summary-divider"></div>

                                <div class="summary-detail">
                                    <span>Jenis produk</span>
                                    <strong id="summary-products">0 produk</strong>
                                </div>

                                <div class="summary-detail">
                                    <span>Total unit</span>
                                    <strong id="summary-units">0 unit</strong>
                                </div>

                                <div class="summary-detail">
                                    <span>Tanggal transaksi</span>
                                    <strong id="summary-date">-</strong>
                                </div>
                            </div>

                            <div class="notes-area">
                                <label for="notes" class="field-label">
                                    Catatan <span style="color:var(--muted);font-weight:400">(opsional)</span>
                                </label>
                                <textarea
                                    id="notes"
                                    name="notes"
                                    rows="3"
                                    maxlength="1000"
                                    placeholder="Contoh: penjualan langsung di toko..."
                                    class="textarea-field"
                                >{{ old('notes') }}</textarea>
                                <div class="field-help">Tambahkan informasi tambahan jika diperlukan.</div>
                            </div>
                        </div>
                    </section>

                    <div class="form-actions">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                            Batal
                        </a>

                        <button type="submit" id="submit-button" class="btn btn-primary">
                            Simpan Penjualan →
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </main>
</div>

<script>
(() => {
    const rows = document.getElementById('product-rows');
    const addButton = document.getElementById('add-row');
    const form = document.getElementById('sales-form');
    const dateInput = document.getElementById('sale_date');

    if (!rows || !addButton || !form) return;

    const rupiah = value =>
        'Rp ' + Math.round(value).toLocaleString('id-ID');

    const numberFormat = value =>
        Number(value).toLocaleString('id-ID');

    function getRows() {
        return [...rows.querySelectorAll('.product-row')];
    }

    function updateRowNumbers() {
        getRows().forEach((row, index) => {
            row.querySelector('.row-index').textContent = index + 1;
            row.querySelector('.remove-row').disabled = getRows().length === 1;
        });
    }

    function updateProductOptions() {
        const allRows = getRows();
        const selects = allRows.map(row => row.querySelector('.product-select'));
        const chosen = selects.map(select => select.value).filter(Boolean);

        selects.forEach(select => {
            [...select.options].forEach(option => {
                if (!option.value) return;

                option.disabled =
                    chosen.includes(option.value) &&
                    option.value !== select.value;
            });
        });
    }

    function updateTotals() {
        let grandTotal = 0;
        let units = 0;
        let productCount = 0;

        getRows().forEach(row => {
            const select = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.quantity-input');
            const option = select.selectedOptions[0];

            const price = Number(option?.dataset.price || 0);
            const stock = Number(option?.dataset.stock || 0);
            const quantity = Math.max(0, Number(quantityInput.value || 0));
            const hasProduct = Boolean(select.value);

            quantityInput.max = hasProduct ? stock : '';
            quantityInput.min = 1;

            const exceedsStock = hasProduct && quantity > stock;
            const warning = row.querySelector('.stock-warning');

            warning.classList.toggle('show', exceedsStock);
            quantityInput.setCustomValidity(
                exceedsStock ? 'Jumlah melebihi stok yang tersedia.' :
                (hasProduct && quantity < 1 ? 'Jumlah minimal adalah 1.' : '')
            );

            const subtotal = hasProduct ? price * quantity : 0;

            row.querySelector('.row-total').textContent = rupiah(subtotal);
            row.querySelector('.product-meta').textContent = hasProduct
                ? `Harga satuan: ${rupiah(price)} · Stok tersedia: ${numberFormat(stock)}`
                : 'Harga dan stok akan tampil setelah produk dipilih.';

            if (hasProduct) {
                productCount++;
                units += quantity;
                grandTotal += subtotal;
            }
        });

        document.getElementById('grand-total').textContent = rupiah(grandTotal);
        document.getElementById('stat-products').textContent = numberFormat(productCount);
        document.getElementById('stat-units').textContent = numberFormat(units);
        document.getElementById('stat-total').textContent = rupiah(grandTotal);

        document.getElementById('summary-products').textContent =
            `${numberFormat(productCount)} produk`;

        document.getElementById('summary-units').textContent =
            `${numberFormat(units)} unit`;

        document.getElementById('summary-caption').textContent =
            productCount === 0
                ? 'Belum ada produk yang dipilih.'
                : `${numberFormat(productCount)} jenis produk · ${numberFormat(units)} unit barang`;

        updateRowNumbers();
        updateProductOptions();
    }

    function updateDate() {
        const value = dateInput.value;

        if (!value) {
            document.getElementById('summary-date').textContent = '-';
            return;
        }

        const parts = value.split('-');
        document.getElementById('summary-date').textContent =
            `${parts[2]}/${parts[1]}/${parts[0]}`;
    }

    rows.addEventListener('change', event => {
        if (
            event.target.matches('.product-select') ||
            event.target.matches('.quantity-input')
        ) {
            updateTotals();
        }
    });

    rows.addEventListener('input', event => {
        if (event.target.matches('.quantity-input')) {
            updateTotals();
        }
    });

    rows.addEventListener('click', event => {
        const button = event.target.closest('.remove-row');
        if (!button) return;

        if (getRows().length <= 1) return;

        button.closest('.product-row').remove();
        updateTotals();
    });

    addButton.addEventListener('click', () => {
        const firstRow = rows.querySelector('.product-row');
        const newRow = firstRow.cloneNode(true);

        newRow.querySelector('.product-select').value = '';

        const quantity = newRow.querySelector('.quantity-input');
        quantity.value = 1;
        quantity.max = '';
        quantity.setCustomValidity('');

        newRow.querySelector('.stock-warning').classList.remove('show');
        newRow.querySelector('.row-total').textContent = 'Rp 0';
        newRow.querySelector('.product-meta').textContent =
            'Harga dan stok akan tampil setelah produk dipilih.';

        rows.appendChild(newRow);
        updateTotals();

        newRow.querySelector('.product-select').focus();
    });

    dateInput.addEventListener('change', updateDate);

    form.addEventListener('submit', event => {
        updateTotals();

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        const hasProduct = getRows().some(row =>
            row.querySelector('.product-select').value
        );

        if (!hasProduct) {
            event.preventDefault();
            alert('Pilih minimal satu produk sebelum menyimpan transaksi.');
            return;
        }

        const button = document.getElementById('submit-button');
        button.disabled = true;
        button.textContent = 'Menyimpan transaksi...';
    });

    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menu-toggle');

    menuToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('open');
    });

    document.addEventListener('click', event => {
        if (
            window.innerWidth <= 760 &&
            sidebar.classList.contains('open') &&
            !sidebar.contains(event.target) &&
            !menuToggle.contains(event.target)
        ) {
            sidebar.classList.remove('open');
        }
    });

    updateTotals();
    updateDate();
})();
</script>
</body>
</html>
