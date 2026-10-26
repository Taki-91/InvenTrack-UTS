<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Stok Masuk | InvenTrack</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon: #3D1025;
            --burgundy: #762D46;
            --accent: #A64D68;
            --background: #F8F4F5;
            --text: #30212A;
            --muted: #8B7B83;
            --border: #EEE3E8;
            --white: #FFFFFF;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 13px;
        }

        a { color: inherit; text-decoration: none; }
        button { font: inherit; }

        .layout { display: flex; min-height: 100vh; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 245px;
            padding: 27px 17px;
            background: var(--maroon);
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            margin-bottom: 37px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 13px;
            background: linear-gradient(135deg, #B76B83, #762D46);
            box-shadow: 0 7px 20px #00000025;
            font-size: 19px;
            font-weight: 800;
        }

        .brand-name { font-size: 17px; font-weight: 800; letter-spacing: -.5px; }
        .brand-sub { margin-top: 4px; color: #D0AEBB; font-size: 10px; }

        .nav-label {
            padding: 0 12px;
            margin: 0 0 10px;
            color: #B68B9B;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .nav {
            display: grid;
            gap: 5px;
            margin-bottom: 25px;
        }

        .nav-link {
            min-height: 43px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 13px;
            border-radius: 10px;
            color: #E0CBD2;
            font-weight: 500;
            transition: background .2s, color .2s;
        }

        .nav-link:hover { background: #FFFFFF12; color: white; }

        .nav-link.active {
            background: linear-gradient(100deg, #8D3D59, #A64D68);
            color: white;
            font-weight: 700;
            box-shadow: 0 5px 16px #00000020;
        }

        .nav-icon { width: 20px; text-align: center; font-size: 16px; }
        .sidebar-bottom { margin-top: auto; }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 8px 0;
            border-top: 1px solid #FFFFFF20;
        }

        .avatar {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 12px;
            background: #762D46;
            color: #F8EAF0;
            font-weight: 800;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .profile-role { margin-top: 5px; color: #D0AEBB; font-size: 10px; }
        .logout-form { margin-top: 13px; }

        .logout-button {
            width: 100%;
            padding: 11px;
            border: 1px solid #FFFFFF25;
            border-radius: 9px;
            background: transparent;
            color: #E0CBD2;
            cursor: pointer;
            text-align: left;
        }

        .logout-button:hover { background: #FFFFFF12; }

        .main { flex: 1; min-width: 0; margin-left: 245px; }

        .topbar {
            min-height: 76px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 18px 30px;
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .topbar-title { font-size: 15px; font-weight: 800; }
        .topbar-subtitle { margin-top: 5px; color: var(--muted); font-size: 11px; }

        .role-chip {
            padding: 9px 12px;
            border-radius: 9px;
            background: #F5E7EC;
            color: var(--burgundy);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .content { padding: 29px 30px 35px; }

        .eyebrow {
            margin-bottom: 8px;
            color: var(--burgundy);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 23px;
        }

        .heading h1 { margin: 0; font-size: 26px; letter-spacing: -.7px; }

        .muted {
            margin-top: 8px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .panel {
            padding: 22px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            box-shadow: 0 5px 20px #3D102508;
        }

        .panel-heading { margin-bottom: 18px; font-size: 14px; font-weight: 800; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 15px;
            background: var(--burgundy);
            color: white;
            border: 0;
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .btn:hover { background: var(--maroon); }
        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; text-align: left; }

        th {
            padding: 13px 11px;
            background: #FAF5F7;
            color: #8B737E;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .6px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 14px 11px;
            border-bottom: 1px solid #F1E8EC;
            color: #65545D;
            font-size: 11px;
            vertical-align: middle;
        }

        tbody tr:hover { background: #FCF8FA; }
        tbody tr:last-child td { border-bottom: none; }

        .transaction-number { color: var(--maroon); font-weight: 800; }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 7px;
            background: #F5E7EC;
            color: var(--burgundy);
            font-size: 10px;
            font-weight: 700;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 12px;
        }

        .success { background: #E7F6ED; color: #216B42; }
        .error { background: #FCE9E9; color: #A52D35; }

        .empty { padding: 30px 12px; color: var(--muted); text-align: center; }
        .pagination { margin-top: 20px; }
        .footer { padding-top: 23px; color: #A39199; font-size: 10px; text-align: center; }

        @media (max-width: 850px) {
            .sidebar { width: 215px; }
            .main { margin-left: 215px; }
            .content { padding: 23px 18px; }
            .topbar { padding: 17px 20px; }
            .heading h1 { font-size: 22px; }
        }

        @media (max-width: 650px) {
            .layout { display: block; }
            .sidebar { position: relative; width: 100%; padding: 18px 15px; }
            .brand { margin-bottom: 20px; }
            .nav-label { margin-top: 14px; }
            .nav {
                display: flex;
                overflow-x: auto;
                margin-bottom: 12px;
                padding-bottom: 5px;
            }
            .nav-link { flex-shrink: 0; min-height: 39px; }
            .sidebar-bottom { margin-top: 15px; }
            .main { margin-left: 0; }
            .topbar { padding: 16px; }
            .content { padding: 20px 14px; }
            .heading { align-items: flex-start; flex-direction: column; }
            .panel { padding: 15px; }
        }
    </style>
</head>

<body>
@php
    $currentUser = auth()->user();
    $role = strtolower($currentUser->role ?? 'user');

    $isOwner = $role === 'owner';
    $isAdmin = $role === 'admin';
    $isStaff = in_array($role, ['owner', 'admin', 'staff'], true);
@endphp

<div class="layout">
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="brand">
            <div class="brand-icon">I</div>
            <div>
                <div class="brand-name">InvenTrack</div>
                <div class="brand-sub">Inventory Management</div>
            </div>
        </a>

        <div class="nav-label">Menu utama</div>
        <nav class="nav">
            @if(Route::has('dashboard'))
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="nav-icon">▦</span>
                    <span>Dashboard</span>
                </a>
            @endif
        </nav>

        <div class="nav-label">Manajemen data</div>
        <nav class="nav">
            @if(Route::has('products.index'))
                <a href="{{ route('products.index') }}" class="nav-link">
                    <span class="nav-icon">▣</span>
                    <span>Produk</span>
                </a>
            @endif

            @if($isStaff && Route::has('categories.index'))
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <span class="nav-icon">▤</span>
                    <span>Kategori</span>
                </a>
            @endif

            {{-- Supplier bisa dilihat oleh semua role yang masuk ke aplikasi --}}
            @if(Route::has('suppliers.index'))
                <a href="{{ route('suppliers.index') }}" class="nav-link">
                    <span class="nav-icon">♧</span>
                    <span>Supplier</span>
                </a>
            @endif
        </nav>

        <div class="nav-label">Transaksi</div>
        <nav class="nav">
            @if($isStaff && Route::has('purchases.index'))
                <a href="{{ route('purchases.index') }}" class="nav-link active">
                    <span class="nav-icon">⇩</span>
                    <span>Stok Masuk</span>
                </a>
            @endif

            @if(Route::has('sales.index'))
                <a href="{{ route('sales.index') }}" class="nav-link">
                    <span class="nav-icon">⇧</span>
                    <span>Penjualan</span>
                </a>
            @endif
        </nav>

        <div class="sidebar-bottom">
            <div class="profile">
                <div class="avatar">
                    {{ strtoupper(substr($currentUser->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <div class="profile-name">{{ $currentUser->name ?? 'Pengguna' }}</div>
                    <div class="profile-role">
                        @if($isOwner)
                            OWNER ACCOUNT
                        @elseif($isAdmin)
                            ADMIN ACCOUNT
                        @elseif($role === 'staff')
                            STAFF ACCOUNT
                        @else
                            USER ACCOUNT
                        @endif
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">
                    ↪ &nbsp; Keluar dari akun
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <div class="topbar-title">InvenTrack</div>
                <div class="topbar-subtitle">Inventory Management System</div>
            </div>

            <div class="role-chip">
                @if($isOwner)
                    OWNER
                @elseif($isAdmin)
                    ADMIN
                @elseif($role === 'staff')
                    STAFF
                @else
                    USER
                @endif
            </div>
        </header>

        <section class="content">
            <div class="eyebrow">Transaksi / Stok Masuk</div>

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="heading">
                <div>
                    <h1>Riwayat Stok Masuk</h1>
                    <div class="muted">
                        Daftar transaksi pembelian barang dari supplier.
                    </div>
                </div>

                @if(Route::has('purchases.create') && $isStaff)
                    <a href="{{ route('purchases.create') }}" class="btn">
                        + Tambah Stok Masuk
                    </a>
                @endif
            </div>

            <div class="panel">
                <div class="panel-heading">Daftar transaksi pembelian</div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Petugas</th>
                                <th>Total Pembelian</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($purchases as $purchase)
                                <tr>
                                    <td>
                                        <span class="transaction-number">
                                            {{ $purchase->purchase_number }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $purchase->purchase_date?->format('d/m/Y') ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $purchase->supplier->name ?? 'Supplier dihapus' }}
                                    </td>

                                    <td>
                                        {{ $purchase->user->name ?? '-' }}
                                    </td>

                                    <td>
                                        <strong>
                                            Rp {{ number_format((float) $purchase->total_amount, 0, ',', '.') }}
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="status">
                                            {{ ucfirst($purchase->status ?? 'Unknown') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty">
                                        Belum ada transaksi stok masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $purchases->links() }}
                </div>
            </div>

            <footer class="footer">
                InvenTrack · Inventory Management System · {{ now()->format('Y') }}
            </footer>
        </section>
    </main>
</div>
</body>
</html>
