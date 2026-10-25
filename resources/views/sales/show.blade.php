<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Penjualan | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-5xl p-6 md:p-10">
        <a href="{{ route('sales.index') }}" class="text-blue-600">← Kembali ke Penjualan</a>

        @if (session('success'))
            <div class="mt-5 rounded-lg bg-green-100 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="my-6 flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">Detail Penjualan</h1>
                <p class="mt-2 text-slate-500">{{ $sale->sale_number }}</p>
            </div>
            <button onclick="window.print()"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2 print:hidden">
                Cetak
            </button>
        </div>

        <section class="mb-6 grid grid-cols-1 gap-4 rounded-xl bg-white p-6 shadow-sm md:grid-cols-3">
            <div>
                <p class="text-sm text-slate-500">Tanggal</p>
                <p class="mt-1 font-semibold">{{ $sale->sale_date }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Kasir</p>
                <p class="mt-1 font-semibold">{{ $sale->user?->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Status</p>
                <p class="mt-1 font-semibold">{{ ucfirst($sale->status ?? 'completed') }}</p>
            </div>
        </section>

        <section class="overflow-x-auto rounded-xl bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-4">Produk</th>
                        <th class="p-4">Harga Satuan</th>
                        <th class="p-4">Jumlah</th>
                        <th class="p-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->items as $item)
                        <tr class="border-t">
                            <td class="p-4">{{ $item->product?->name ?? 'Produk dihapus' }}</td>
                            <td class="p-4">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="p-4">{{ $item->quantity }}</td>
                            <td class="p-4">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t">
                        <th colspan="3" class="p-4 text-right">Total</th>
                        <th class="p-4 text-base">
                            Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </section>

        @if ($sale->notes)
            <section class="mt-6 rounded-xl bg-white p-6 shadow-sm">
                <h2 class="font-bold">Catatan</h2>
                <p class="mt-2">{{ $sale->notes }}</p>
            </section>
        @endif
    </main>
</body>
</html>
