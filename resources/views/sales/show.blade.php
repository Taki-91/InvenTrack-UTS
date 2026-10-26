<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Penjualan | InvenTrack</title>
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

        button, a { font: inherit; -webkit-tap-highlight-color: transparent; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 30;
            display: flex;
            flex-direction: column;
            width: 245px;
            padding: 27px 17px 20px;
            background: var(--maroon);
            color: white;
            transition: transform .25s ease;
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
            background: var(--burgundy);
            font-size: 20px;
            font-weight: 800;
        }

        .brand-name { font-size: 17px; font-weight: 800; letter-spacing: -.5px; }
        .brand-sub { margin-top: 4px; color: #D9BFC9; font-size: 10px; letter-spacing: 1.5px; }

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
            margin: 3px 0;
            padding: 12px 13px;
            border-radius: 10px;
            color: #E4D5DB;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: background .2s;
        }

        .nav-link:hover { background: #542037; color: white; }
        .nav-link.active { background: var(--burgundy); color: white; font-weight: 700; }
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
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--accent);
            color: white;
            font-size: 13px;
            font-weight: 800;
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
            border-bottom: 1px solid var(--border);
            background: white;
        }

        .topbar-left { display: flex; align-items: center; gap: 11px; }
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

        .mobile-menu {
            display: none;
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

        h1 {
            margin: 9px 0 8px;
            color: var(--maroon);
            font-size: clamp(24px, 3vw, 31px);
            letter-spacing: -1px;
        }

        .page-description { color: var(--muted); font-size: 13px; line-height: 1.7; }
        .sale-number { margin-top: 10px; color: var(--burgundy); font-size: 12px; font-weight: 700; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 41px;
            padding: 10px 15px;
            border: 1px solid transparent;
            border-radius: 9px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary { background: var(--maroon); color: white; }
        .btn-primary:hover { background: var(--burgundy); transform: translateY(-1px); }
        .btn-secondary { border-color: var(--border); background: white; color: var(--burgundy); }
        .btn-secondary:hover { background: #FBF6F8; }
        .btn-danger { background: #B4233F; color: white; }
        .btn-danger:hover { background: #921B32; }
        .btn:disabled { opacity: .55; cursor: not-allowed; }

        .actions { display: flex; flex-wrap: wrap; gap: 9px; }

        .alert {
            margin-bottom: 19px;
            padding: 14px 17px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
        }

        .alert-success { border: 1px solid #B7E4CC; background: #EFFAF3; color: #166534; }
        .alert-error { border: 1px solid #F1C8D0; background: #FFF3F4; color: #9F243D; }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 22px;
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
            font-size: 18px;
            font-weight: 800;
        }

        .stat-label { color: var(--muted); font-size: 11px; line-height: 1.5; }
        .stat-value { margin-top: 5px; color: var(--maroon); font-size: 19px; font-weight: 800; overflow-wrap: anywhere; }

        .panel {
            margin-bottom: 20px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: white;
            box-shadow: 0 3px 12px rgba(61,16,37,.025);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 20px 23px;
            border-bottom: 1px solid var(--border);
        }

        .panel-title { margin: 0; color: var(--maroon); font-size: 14px; font-weight: 800; }
        .panel-subtitle { margin-top: 6px; color: var(--muted); font-size: 11px; line-height: 1.6; }
        .panel-body { padding: 23px; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: fit-content;
            padding: 7px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge-success { background: #E8F8EE; color: #167344; }
        .badge-danger { background: #FFF0F1; color: #B4233F; }
        .badge-neutral { background: #F5EDF1; color: var(--burgundy); }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .meta-item { min-width: 0; padding: 16px; border: 1px solid var(--border); border-radius: 11px; background: #FFFCFD; }
        .meta-label { color: var(--muted); font-size: 11px; }
        .meta-value { margin-top: 9px; color: var(--text); font-size: 13px; font-weight: 700; overflow-wrap: anywhere; }

        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 12px; }
        thead { background: #FBF6F8; color: var(--muted); }
        th { padding: 15px 20px; font-size: 10px; font-weight: 800; letter-spacing: .4px; text-transform: uppercase; white-space: nowrap; }
        td { padding: 17px 20px; border-top: 1px solid var(--border); vertical-align: middle; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #FFFAFC; }
        .product-name { color: var(--text); font-weight: 700; }
        .product-sub { margin-top: 5px; color: var(--muted); font-size: 10px; }
        .money { color: var(--burgundy); font-weight: 700; white-space: nowrap; }
        .quantity { display: inline-grid; place-items: center; min-width: 33px; padding: 6px 9px; border-radius: 7px; background: #F7EDF1; color: var(--burgundy); font-weight: 800; }
        .empty-state { padding: 35px 20px; text-align: center; color: var(--muted); }
        .empty-state strong { display: block; margin-bottom: 8px; color: var(--maroon); font-size: 13px; }

        tfoot { background: #FBF6F8; }
        tfoot th { padding: 20px; color: var(--maroon); font-size: 12px; text-transform: none; letter-spacing: 0; }
        .grand-total { color: var(--maroon); font-size: 18px; font-weight: 800; white-space: nowrap; }

        .notes { white-space: pre-line; color: var(--text); font-size: 12px; line-height: 1.8; overflow-wrap: anywhere; }

        .cancelled-note {
            margin-top: 20px;
            padding: 16px 18px;
            border: 1px solid #F1C8D0;
            border-radius: 11px;
            background: #FFF3F4;
            color: #9F243D;
            font-size: 12px;
            line-height: 1.8;
        }

        @media (max-width: 1050px) {
            .sidebar { width: 220px; }
            .main { margin-left: 220px; }
            .content { padding: 25px 23px 35px; }
            .topbar { padding-inline: 23px; }
            .stat-card { padding: 14px; }
            .stat-icon { width: 37px; height: 37px; }
        }

        @media (max-width: 760px) {
            .sidebar { width: min(280px, 85vw); transform: translateX(-105%); box-shadow: 12px 0 35px rgba(0,0,0,.15); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar { min-height: 65px; padding: 13px 17px; }
            .mobile-menu { display: inline-grid; }
            .content { padding: 23px 16px 30px; }
            .page-heading { flex-direction: column; align-items: stretch; }
            .page-heading > .actions { align-self: flex-start; }
            .stats { grid-template-columns: 1fr; gap: 10px; }
            .stat-card { padding: 15px; }
            .meta-grid { grid-template-columns: 1fr; gap: 10px; }
            .meta-item { padding: 14px; }
            .panel-heading { padding: 17px; }
            .panel-body { padding: 17px; }
            th, td { padding: 14px 15px; }
            .topbar-tag { font-size: 10px; }
        }

        @media (max-width: 430px) {
            .topbar-tag { padding: 8px; }
            .breadcrumb { font-size: 11px; }
            .actions { width: 100%; }
            .actions .btn, .actions form { flex: 1; }
            .actions form .btn { width: 100%; }
            .grand-total { font-size: 15px; }
        }

        @media print {
            body { background: white; color: black; }
            .sidebar, .topbar, .no-print, .page-heading .actions { display: none !important; }
            .main { margin: 0; }
            .content { max-width: none; padding: 0; }
            .panel, .stat-card { box-shadow: none; break-inside: avoid; }
            .panel { border-color: #ddd; }
            .meta-item { background: white; border-color: #ddd; }
            .stats { grid-template-columns: repeat(3, 1fr); }
            .stat-icon { background: #eee; color: black; }
            .badge-success, .badge-danger, .badge-neutral { background: white; border: 1px solid #bbb; color: black; }
            thead, tfoot { background: #f5f5f5; }
            th, td { border-color: #ddd; }
            .grand-total, .money, .product-name, .meta-value, .panel-title, h1 { color: black; }
        }
    </style>
</head>

<body>
@php
    $user = auth()->user();
    $isOwner = strtolower($user->role ?? '') === 'owner';
    $isCancelled = $sale->status === 'cancelled';
    $totalUnits = $sale->items->sum('quantity');
@endphp

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

    @if (in_array(strtolower($user->role ?? ''), ['owner', 'admin']))
        <a href="{{ route('categories.index') }}" class="nav-link">
            <span class="nav-icon">▤</span> Kategori
        </a>

        <a href="{{ route('suppliers.index') }}" class="nav-link">
            <span class="nav-icon">♧</span> Supplier
        </a>
    @endif

    <div class="nav-label">Transaksi</div>

    @if (in_array(strtolower($user->role ?? ''), ['owner', 'admin']))
        <a href="{{ route('purchases.index') }}" class="nav-link">
            <span class="nav-icon">↓</span> Stok Masuk
        </a>
    @endif

    <a href="{{ route('sales.index') }}" class="nav-link active">
        <span class="nav-icon">↗</span> Penjualan
    </a>

    <div class="sidebar-bottom">
        <div class="sidebar-note">
            <strong>Detail Transaksi</strong>
            <p>Periksa produk, jumlah barang, dan status sebelum melakukan tindakan pada transaksi.</p>
        </div>

        <div class="user-box">
            <div class="avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ $user->name ?? 'Pengguna' }}</div>
                <div class="user-role">{{ ucfirst($user->role ?? 'User') }}</div>
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
            <button type="button" id="menu-toggle" class="mobile-menu no-print" aria-label="Buka menu">☰</button>
            <div class="breadcrumb">
                Transaksi <span style="padding:0 7px;color:#C8B5BE">/</span>
                <a href="{{ route('sales.index') }}" style="color:var(--muted);text-decoration:none">Penjualan</a>
                <span style="padding:0 7px;color:#C8B5BE">/</span>
                <strong>Detail</strong>
            </div>
        </div>
        <div class="topbar-tag"><span>●</span> Sistem Inventaris</div>
    </header>

    <div class="content">
        @if (session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="page-heading">
            <div>
                <div class="eyebrow">InvenTrack / Riwayat Penjualan</div>
                <h1>Detail Penjualan</h1>
                <div class="page-description">Informasi lengkap produk dan ringkasan transaksi penjualan.</div>
                <div class="sale-number">{{ $sale->sale_number }}</div>
            </div>

            <div class="actions no-print">
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">← Kembali</a>
                <button type="button" onclick="window.print()" class="btn btn-primary">▣ Cetak Detail</button>

                @if ($isOwner && $sale->status === 'completed')
                    <form action="{{ route('sales.cancel', $sale) }}" method="POST"
                          onsubmit="return confirm('Batalkan transaksi ini? Stok produk akan dikembalikan.');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Batalkan Transaksi</button>
                    </form>
                @endif
            </div>
        </div>

        <section class="stats">
            <div class="stat-card">
                <div class="stat-icon">Rp</div>
                <div>
                    <div class="stat-label">Total Penjualan</div>
                    <div class="stat-value">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">▦</div>
                <div>
                    <div class="stat-label">Jenis Produk</div>
                    <div class="stat-value">{{ number_format($sale->items->count(), 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">＋</div>
                <div>
                    <div class="stat-label">Total Unit</div>
                    <div class="stat-value">{{ number_format($totalUnits, 0, ',', '.') }}</div>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2 class="panel-title">Informasi Transaksi</h2>
                    <div class="panel-subtitle">Data utama transaksi dan pengguna yang mencatatnya.</div>
                </div>

                @if ($isCancelled)
                    <span class="badge badge-danger">● Dibatalkan</span>
                @else
                    <span class="badge badge-success">● {{ ucfirst($sale->status ?? 'completed') }}</span>
                @endif
            </div>

            <div class="panel-body">
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-label">Nomor Penjualan</div>
                        <div class="meta-value">{{ $sale->sale_number }}</div>
                    </div>

                    <div class="meta-item">
                        <div class="meta-label">Tanggal Penjualan</div>
                        <div class="meta-value">
                            {{ \Illuminate\Support\Carbon::parse($sale->sale_date)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="meta-item">
                        <div class="meta-label">Kasir</div>
                        <div class="meta-value">{{ $sale->user?->name ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2 class="panel-title">Rincian Produk</h2>
                    <div class="panel-subtitle">Daftar barang, harga satuan, jumlah, dan subtotal.</div>
                </div>
                <span class="badge badge-neutral">{{ $sale->items->count() }} jenis produk</span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width:55px">No.</th>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sale->items as $item)
                            <tr>
                                <td style="color:var(--muted)">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="product-name">{{ $item->product?->name ?? 'Produk dihapus' }}</div>
                                    <div class="product-sub">Item penjualan</div>
                                </td>
                                <td>Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                <td><span class="quantity">{{ number_format($item->quantity, 0, ',', '.') }}</span></td>
                                <td class="money">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <strong>Belum ada rincian produk</strong>
                                        Tidak ada detail produk pada transaksi ini.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:right">Total Penjualan</th>
                            <th class="grand-total">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>

        @if ($sale->notes)
            <section class="panel">
                <div class="panel-heading">
                    <div>
                        <h2 class="panel-title">Catatan Transaksi</h2>
                        <div class="panel-subtitle">Informasi tambahan yang disimpan bersama transaksi.</div>
                    </div>
                    <span class="badge badge-neutral">Catatan</span>
                </div>
                <div class="panel-body">
                    <div class="notes">{{ $sale->notes }}</div>
                </div>
            </section>
        @endif

        @if ($isCancelled)
            <div class="cancelled-note">
                <strong>Transaksi telah dibatalkan.</strong><br>
                Menurut status transaksi, stok produk telah dikembalikan dan transaksi tidak dapat dibatalkan lagi.
            </div>
        @endif

        <div class="actions no-print" style="justify-content:flex-end;margin-top:22px">
            <a href="{{ route('sales.index') }}" class="btn btn-secondary">← Kembali ke Riwayat</a>
            <button type="button" onclick="window.print()" class="btn btn-primary">▣ Cetak Detail</button>
        </div>
    </div>
</main>

<script>
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
</script>
</body>
</html>
