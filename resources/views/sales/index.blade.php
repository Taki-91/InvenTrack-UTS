<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjualan | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-6xl p-6 md:p-10">
        <a href="{{ route('dashboard') }}" class="text-blue-600">← Dashboard</a>

        <div class="my-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">Penjualan</h1>
                <p class="mt-2 text-slate-500">Daftar transaksi penjualan barang.</p>
            </div>
            <a href="{{ route('sales.create') }}"
               class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white">
                + Transaksi Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" action="{{ route('sales.index') }}"
              class="mb-5 flex flex-wrap gap-3">
            <input name="search" value="{{ request('search') }}"
                   placeholder="Cari nomor penjualan..."
                   class="min-w-0 flex-1 rounded-lg border-slate-300">
            <button class="rounded-lg bg-slate-800 px-5 py-2 text-white">
                Cari
            </button>
            <a href="{{ route('sales.index') }}"
               class="rounded-lg border border-slate-300 bg-white px-5 py-2">
                Reset
            </a>
        </form>

        <div class="overflow-x-auto rounded-xl bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-4">No. Penjualan</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Kasir</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="border-t">
                            <td class="p-4 font-semibold">{{ $sale->sale_number }}</td>
                            <td class="p-4">{{ $sale->sale_date }}</td>
                            <td class="p-4">{{ $sale->user?->name ?? '-' }}</td>
                            <td class="p-4">
                                Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="p-4">
                                <a class="font-semibold text-blue-600"
                                   href="{{ route('sales.show', $sale) }}">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-500">
                                Belum ada transaksi penjualan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $sales->links() }}</div>
    </main>
</body>
</html>
