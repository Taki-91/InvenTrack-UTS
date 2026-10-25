<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Masuk | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 235px; flex-shrink: 0; background: #0f172a; color: white; padding: 25px 16px; box-sizing: border-box; }
        .brand { font-size: 23px; font-weight: bold; margin: 0 0 35px 8px; }
        .brand span { color: #60a5fa; }
        .nav-label { color: #94a3b8; font-size: 11px; text-transform: uppercase; margin: 22px 8px 10px; letter-spacing: 1px; }
        .nav-link { display: block; padding: 12px; margin-bottom: 6px; color: #cbd5e1; text-decoration: none; border-radius: 8px; font-size: 14px; }
        .nav-link:hover, .nav-link.active { background: #2563eb; color: white; }
        .main { flex: 1; min-width: 0; }
        .topbar { background: white; padding: 20px 30px; border-bottom: 1px solid #e2e8f0; }
        .topbar h2 { margin: 0; font-size: 21px; }
        .content { padding: 28px; }
        .heading { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 22px; }
        .heading h1 { margin: 0 0 7px; font-size: 25px; }
        .muted { color: #64748b; font-size: 13px; }
        .panel { background: white; padding: 22px; border: 1px solid #e2e8f0; border-radius: 12px; }
        .btn { display: inline-block; padding: 11px 15px; background: #2563eb; color: white; text-decoration: none; border: 0; border-radius: 7px; cursor: pointer; font-size: 13px; }
        .btn:hover { background: #1d4ed8; }
        .btn-secondary { background: #e2e8f0; color: #334155; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th, td { padding: 13px 10px; border-bottom: 1px solid #e2e8f0; text-align: left; white-space: nowrap; }
        th { color: #64748b; background: #f8fafc; }
        .alert { padding: 13px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; }
        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
        .empty { text-align: center; padding: 25px; color: #64748b; }
        .pagination { margin-top: 18px; }
        .logout-form { margin-top: 30px; }
        .logout-button { width: 100%; padding: 11px; border: 1px solid #475569; border-radius: 8px; background: transparent; color: #cbd5e1; cursor: pointer; text-align: left; }
        @media(max-width: 750px) {
            .layout { display: block; }
            .sidebar { width: 100%; }
            .content { padding: 18px; }
            .topbar { padding: 18px; }
            .heading { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">Inven<span>Track</span></div>
        <div class="nav-label">Menu utama</div>
        <a href="{{ route('dashboard') }}" class="nav-link">▦ Dashboard</a>
        <div class="nav-label">Manajemen data</div>
        <a href="{{ route('categories.index') }}" class="nav-link">▤ Kategori</a>
        <a href="{{ route('products.index') }}" class="nav-link">▣ Produk</a>
        <a href="{{ route('suppliers.index') }}" class="nav-link">♧ Supplier</a>
        <div class="nav-label">Transaksi</div>
        <a href="{{ route('purchases.index') }}" class="nav-link active">↓ Stok Masuk</a>
        <a href="{{ route('sales.index') }}" class="nav-link">↗ Penjualan</a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">↪ Keluar</button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <h2>Stok Masuk</h2>
        </header>

        <section class="content">
            @if (session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif

            <div class="heading">
                <div>
                    <h1>Riwayat Stok Masuk</h1>
                    <div class="muted">Daftar transaksi pembelian barang dari supplier.</div>
                </div>
                <a href="{{ route('purchases.create') }}" class="btn">+ Tambah Stok Masuk</a>
            </div>

            <div class="panel">
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
                            @forelse ($purchases as $purchase)
                                <tr>
                                    <td><strong>{{ $purchase->purchase_number }}</strong></td>
                                    <td>{{ $purchase->purchase_date?->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ $purchase->supplier->name ?? 'Supplier dihapus' }}</td>
                                    <td>{{ $purchase->user->name ?? '-' }}</td>
                                    <td>Rp {{ number_format((float) $purchase->total_amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($purchase->status) }}</td>
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
        </section>
    </main>
</div>
</body>
</html>
