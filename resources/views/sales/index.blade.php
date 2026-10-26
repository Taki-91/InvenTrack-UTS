<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Penjualan | InvenTrack</title>

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
        button, input, select { font: inherit; }

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

        .nav { display: grid; gap: 5px; margin-bottom: 25px; }

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

        .profile-name { font-size: 12px; font-weight: 700; overflow-wrap: anywhere; }
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
            transition: background .2s;
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
        .eyebrow { margin-bottom: 8px; color: var(--burgundy); font-size: 10px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 23px;
        }

        .heading h1 { margin: 0; font-size: 26px; letter-spacing: -.7px; }
        .muted { margin-top: 8px; color: var(--muted); font-size: 12px; line-height: 1.6; }

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
            transition: background .2s, transform .2s;
            white-space: nowrap;
        }

        .btn:hover { background: var(--maroon); transform: translateY(-1px); }

        .btn-outline {
            background: white;
            color: var(--burgundy);
            border: 1px solid var(--border);
        }

        .btn-outline:hover { background: #FAF5F7; color: var(--maroon); }

        .panel {
            padding: 22px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            box-shadow: 0 5px 20px #3D102508;
        }

        .panel-heading { margin-bottom: 18px; font-size: 14px; font-weight: 800; }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 5px 20px #3D102508;
            transition: transform .2s, box-shadow .2s;
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px #3D102510;
        }

        .summary-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 12px;
            background: #F5E7EC;
            color: var(--burgundy);
            font-size: 20px;
        }

        .summary-label { color: var(--muted); font-size: 11px; }
        .summary-value { margin-top: 6px; color: var(--maroon); font-size: 20px; font-weight: 800; overflow-wrap: anywhere; }
        .summary-note { margin-top: 5px; color: var(--muted); font-size: 10px; }

        .filter-panel { margin-bottom: 18px; }

        .filter-grid {
            display: grid;
            grid-template-columns: minmax(180px, 1.5fr) repeat(2, minmax(130px, 1fr)) auto auto;
            gap: 10px;
            align-items: end;
        }

        .field label {
            display: block;
            margin-bottom: 7px;
            color: #65545D;
            font-size: 11px;
            font-weight: 700;
        }

        .field input, .field select {
            width: 100%;
            min-width: 0;
            min-height: 39px;
            padding: 10px 11px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            color: var(--text);
            outline: none;
            transition: border .2s, box-shadow .2s;
        }

        .field input:focus, .field select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px #A64D6815;
        }

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

        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #FCF8FA; }
        tbody tr:last-child td { border-bottom: none; }

        .transaction-number { color: var(--maroon); font-weight: 800; }
        .amount { color: var(--maroon); font-weight: 800; white-space: nowrap; }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 7px;
            background: #F5E7EC;
            color: var(--burgundy);
            font-size: 10px;
            font-weight: 700;
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--burgundy);
            font-weight: 700;
            transition: background .2s;
        }

        .detail-link:hover { background: #F5E7EC; }

        .alert { padding: 13px 16px; border-radius: 9px; margin-bottom: 18px; font-size: 12px; }
        .success { background: #E7F6ED; color: #216B42; }
        .error { background: #FCE9E9; color: #A52D35; }

        .empty { padding: 35px 12px; color: var(--muted); text-align: center; }
        .empty-icon { margin-bottom: 10px; font-size: 28px; }
        .pagination { margin-top: 20px; }
        .footer { padding-top: 23px; color: #A39199; font-size: 10px; text-align: center; }
        .hidden-row { display: none; }

        .result-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 8px;
            margin-top: 15px;
            color: var(--muted);
            font-size: 11px;
        }

        @media (max-width: 1100px) {
            .filter-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .summary-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }

        @media (max-width: 850px) {
            .sidebar { width: 215px; }
            .main { margin-left: 215px; }
            .content { padding: 23px 18px; }
            .topbar { padding: 17px 20px; }
            .heading h1 { font-size: 22px; }
            .summary-grid { grid-template-columns: 1fr; gap: 10px; }
        }

        @media (max-width: 650px) {
            .layout { display: block; }
            .sidebar { position: relative; width: 100%; padding: 18px 15px; }
            .brand { margin-bottom: 20px; }
            .nav-label { margin-top: 14px; }
            .nav { display: flex; overflow-x: auto; margin-bottom: 12px; padding-bottom: 5px; }
            .nav-link { flex-shrink: 0; min-height: 39px; }
            .sidebar-bottom { margin-top: 15px; }
            .main { margin-left: 0; }
            .topbar { padding: 16px; }
            .content { padding: 20px 14px; }
            .heading { align-items: flex-start; flex-direction: column; }
            .panel { padding: 15px; }
            .filter-grid { grid-template-columns: 1fr; }
            .summary-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
@php
    $currentUser = auth()->user();
    $role = strtolower($currentUser->role ?? 'user');
    $isOwner = $role === 'owner';
    $isAdmin = $role === 'admin';
    $isStaff = $isOwner || $isAdmin;
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
            <a href="{{ route('dashboard') }}" class="nav-link">
                <span class="nav-icon">▦</span><span>Dashboard</span>
            </a>
        </nav>

        <div class="nav-label">Manajemen data</div>
        <nav class="nav">
            @if(Route::has('products.index'))
                <a href="{{ route('products.index') }}" class="nav-link">
                    <span class="nav-icon">▣</span><span>Produk</span>
                </a>
            @endif

            @if($isStaff && Route::has('categories.index'))
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <span class="nav-icon">▤</span><span>Kategori</span>
                </a>
            @endif

           @if(($isOwner || $isAdmin) && Route::has('suppliers.index'))
                <a href="{{ route('suppliers.index') }}" class="nav-link">
                    <span class="nav-icon">♧</span><span>Supplier</span>
                </a>
            @endif
        </nav>

        <div class="nav-label">Transaksi</div>
        <nav class="nav">
            @if($isStaff && Route::has('purchases.index'))
                <a href="{{ route('purchases.index') }}" class="nav-link">
                    <span class="nav-icon">⇩</span><span>Stok Masuk</span>
                </a>
            @endif

            @if(Route::has('sales.index'))
                <a href="{{ route('sales.index') }}" class="nav-link active">
                    <span class="nav-icon">⇧</span><span>Penjualan</span>
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
                            ADMIN / STAFF
                        @else
                            USER ACCOUNT
                        @endif
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">↪ &nbsp; Keluar dari akun</button>
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
                    ADMIN / STAFF
                @else
                    USER
                @endif
            </div>
        </header>

        <section class="content">
            <div class="eyebrow">Transaksi / Penjualan</div>

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
                    <h1>Riwayat Penjualan</h1>
                    <div class="muted">
                        Pantau transaksi, kasir, tanggal, dan total penjualan.
                    </div>
                </div>

                @if(Route::has('sales.create'))
                    <a href="{{ route('sales.create') }}" class="btn">
                        + Transaksi Baru
                    </a>
                @endif
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">▤</div>
                    <div>
                        <div class="summary-label">Transaksi ditampilkan</div>
                        <div class="summary-value" id="summary-count">0</div>
                        <div class="summary-note">Sesuai filter di halaman ini</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">Rp</div>
                    <div>
                        <div class="summary-label">Nilai penjualan ditampilkan</div>
                        <div class="summary-value" id="summary-total">Rp 0</div>
                        <div class="summary-note">Jumlah dari baris yang terlihat</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">⌕</div>
                    <div>
                        <div class="summary-label">Hasil filter</div>
                        <div class="summary-value" id="summary-filter">Semua</div>
                        <div class="summary-note">Gunakan tanggal atau pengurutan</div>
                    </div>
                </div>
            </div>

            <div class="panel filter-panel">
                <div class="panel-heading">Cari dan filter transaksi</div>

                <form method="GET" action="{{ route('sales.index') }}" class="filter-grid">
                    <div class="field">
                        <label for="search">Nomor penjualan</label>
                        <input
                            id="search"
                            name="search"
                            type="search"
                            value="{{ request('search') }}"
                            placeholder="Contoh: TRX-001"
                        >
                    </div>

                    <div class="field">
                        <label for="date-from">Dari tanggal</label>
                        <input id="date-from" type="date">
                    </div>

                    <div class="field">
                        <label for="date-to">Sampai tanggal</label>
                        <input id="date-to" type="date">
                    </div>

                    <div class="field">
                        <label for="sort-order">Urutkan</label>
                        <select id="sort-order">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="highest">Total terbesar</option>
                            <option value="lowest">Total terkecil</option>
                        </select>
                    </div>

                    <div style="display:flex;gap:8px;flex-wrap:wrap">
                        <button type="submit" class="btn">Cari</button>
                        <a href="{{ route('sales.index') }}" class="btn btn-outline">Reset</a>
                    </div>
                </form>

                <div class="muted">
                    Pencarian nomor penjualan menggunakan Laravel. Filter tanggal dan pengurutan berlaku pada data yang tampil di halaman ini.
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">Daftar transaksi penjualan</div>

                <div class="table-wrap">
                    <table id="sales-table">
                        <thead>
                            <tr>
                                <th>No. Penjualan</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Total Penjualan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="sales-tbody">
                            @forelse($sales as $sale)
                                <tr
                                    class="sale-row"
                                    data-date="{{ \Illuminate\Support\Carbon::parse($sale->sale_date)->format('Y-m-d') }}"
                                    data-total="{{ (float) $sale->total_amount }}"
                                    data-number="{{ strtolower($sale->sale_number ?? '') }}"
                                >
                                    <td>
                                        <span class="transaction-number">
                                            {{ $sale->sale_number }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ \Illuminate\Support\Carbon::parse($sale->sale_date)->format('d/m/Y') }}
                                    </td>

                                    <td>{{ $sale->user?->name ?? '-' }}</td>

                                    <td class="amount">
                                        Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <a class="detail-link" href="{{ route('sales.show', $sale) }}">
                                            Detail <span>→</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-row">
                                    <td colspan="5" class="empty">
                                        <div class="empty-icon">▤</div>
                                        <strong>Belum ada transaksi penjualan</strong>
                                        <div class="muted">Transaksi baru akan muncul di sini.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div id="no-filter-results" class="empty" hidden>
                    Tidak ada transaksi yang cocok dengan filter tanggal.
                </div>

                <div class="result-info">
                    <span id="result-count">Memuat transaksi...</span>
                    <span>Halaman {{ $sales->currentPage() }} dari {{ $sales->lastPage() }}</span>
                </div>

                <div class="pagination">
                    {{ $sales->links() }}
                </div>
            </div>

            <footer class="footer">
                InvenTrack · Inventory Management System · {{ now()->format('Y') }}
            </footer>
        </section>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tbody = document.getElementById('sales-tbody');
        const dateFrom = document.getElementById('date-from');
        const dateTo = document.getElementById('date-to');
        const sortOrder = document.getElementById('sort-order');
        const countDisplay = document.getElementById('summary-count');
        const totalDisplay = document.getElementById('summary-total');
        const filterDisplay = document.getElementById('summary-filter');
        const resultCount = document.getElementById('result-count');
        const noResults = document.getElementById('no-filter-results');

        if (!tbody) return;

        const rows = Array.from(tbody.querySelectorAll('.sale-row'));
        const originalOrder = new Map(rows.map((row, index) => [row, index]));

        function rupiah(value) {
            return 'Rp ' + Number(value).toLocaleString('id-ID', {
                maximumFractionDigits: 0
            });
        }

        function updateTable() {
            const from = dateFrom.value;
            const to = dateTo.value;
            const order = sortOrder.value;

            let visibleRows = rows.filter(row => {
                const date = row.dataset.date || '';
                return (!from || date >= from) && (!to || date <= to);
            });

            visibleRows.sort((a, b) => {
                if (order === 'newest') return b.dataset.date.localeCompare(a.dataset.date);
                if (order === 'oldest') return a.dataset.date.localeCompare(b.dataset.date);
                if (order === 'highest') return Number(b.dataset.total) - Number(a.dataset.total);
                if (order === 'lowest') return Number(a.dataset.total) - Number(b.dataset.total);
                return originalOrder.get(a) - originalOrder.get(b);
            });

            rows.forEach(row => {
                row.classList.add('hidden-row');
            });

            visibleRows.forEach(row => {
                row.classList.remove('hidden-row');
                tbody.appendChild(row);
            });

            let total = 0;
            visibleRows.forEach(row => {
                total += Number(row.dataset.total || 0);
            });

            countDisplay.textContent = visibleRows.length.toLocaleString('id-ID');
            totalDisplay.textContent = rupiah(total);
            resultCount.textContent =
                'Menampilkan ' + visibleRows.length.toLocaleString('id-ID') +
                ' dari ' + rows.length.toLocaleString('id-ID') +
                ' transaksi pada halaman ini.';

            noResults.hidden = !(rows.length > 0 && visibleRows.length === 0);

            if (from || to) {
                filterDisplay.textContent = 'Tanggal';
            } else if (order === 'highest' || order === 'lowest') {
                filterDisplay.textContent = 'Total';
            } else {
                filterDisplay.textContent = 'Semua';
            }
        }

        dateFrom.addEventListener('change', updateTable);
        dateTo.addEventListener('change', updateTable);
        sortOrder.addEventListener('change', updateTable);

        updateTable();
    });
</script>
</body>
</html>
