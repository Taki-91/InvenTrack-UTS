<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaksi Baru | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-4xl p-6 md:p-10">
        <a href="{{ route('sales.index') }}" class="text-blue-600">← Kembali</a>
        <h1 class="my-5 text-3xl font-bold">Transaksi Penjualan</h1>

        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-100 p-4 text-red-800">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="rounded-lg bg-amber-100 p-4 text-amber-900">
                Tidak ada produk aktif dengan stok tersedia. Tambahkan stok produk terlebih dahulu.
            </div>
        @else
            <form method="POST" action="{{ route('sales.store') }}"
                  class="space-y-6 rounded-xl bg-white p-6 shadow-sm">
                @csrf

                <div>
                    <label for="sale_date" class="mb-2 block font-semibold">Tanggal Penjualan</label>
                    <input id="sale_date" type="date" name="sale_date"
                           value="{{ old('sale_date', now()->format('Y-m-d')) }}"
                           required class="w-full rounded-lg border-slate-300">
                </div>

                <div>
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <h2 class="font-bold">Produk Terjual</h2>
                        <button type="button" id="add-row"
                                class="rounded-lg bg-slate-800 px-4 py-2 text-white">
                            + Tambah Produk
                        </button>
                    </div>

                    <div id="product-rows" class="space-y-4">
                        <div class="product-row grid grid-cols-1 gap-3 rounded-lg border p-4 md:grid-cols-12">
                            <div class="md:col-span-7">
                                <label class="mb-1 block text-sm">Produk</label>
                                <select name="product_ids[]" required
                                        class="product-select w-full rounded-lg border-slate-300">
                                    <option value="">Pilih produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-price="{{ $product->selling_price }}"
                                            data-stock="{{ $product->stock }}">
                                            {{ $product->name }} | Stok: {{ $product->stock }}
                                            | Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <label class="mb-1 block text-sm">Jumlah</label>
                                <input name="quantities[]" type="number" min="1" value="1"
                                       required class="quantity-input w-full rounded-lg border-slate-300">
                            </div>
                            <div class="flex items-end md:col-span-2">
                                <button type="button"
                                        class="remove-row w-full rounded-lg border border-red-300 px-3 py-2 text-red-600">
                                    Hapus
                                </button>
                            </div>
                            <p class="row-total text-sm text-slate-500 md:col-span-12">
                                Pilih produk untuk melihat subtotal.
                            </p>
                        </div>
                    </div>

                    <p class="mt-4 text-right text-lg font-bold">
                        Estimasi Total: <span id="grand-total">Rp 0</span>
                    </p>
                </div>

                <div>
                    <label for="notes" class="mb-2 block font-semibold">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" rows="3"
                              class="w-full rounded-lg border-slate-300">{{ old('notes') }}</textarea>
                </div>

                <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white">
                    Simpan Penjualan
                </button>
            </form>
        @endif
    </main>

    <script>
        const rows = document.getElementById('product-rows');
        const addButton = document.getElementById('add-row');
        const totalDisplay = document.getElementById('grand-total');

        function formatRupiah(value) {
            return 'Rp ' + value.toLocaleString('id-ID');
        }

        function updateTotals() {
            let grandTotal = 0;

            rows.querySelectorAll('.product-row').forEach(row => {
                const select = row.querySelector('.product-select');
                const quantityInput = row.querySelector('.quantity-input');
                const option = select.selectedOptions[0];
                const price = Number(option?.dataset.price || 0);
                const stock = Number(option?.dataset.stock || 0);
                const quantity = Number(quantityInput.value || 0);
                const subtotal = price * quantity;

                quantityInput.max = stock || 1;

                row.querySelector('.row-total').textContent = option?.value
                    ? `Subtotal: ${formatRupiah(subtotal)} | Stok tersedia: ${stock}`
                    : 'Pilih produk untuk melihat subtotal.';

                grandTotal += subtotal;
            });

            totalDisplay.textContent = formatRupiah(grandTotal);
        }

        function updateProductOptions() {
            const selects = [...rows.querySelectorAll('.product-select')];
            const chosen = selects.map(select => select.value).filter(Boolean);

            selects.forEach(select => {
                [...select.options].forEach(option => {
                    if (!option.value) return;
                    option.disabled = chosen.includes(option.value)
                        && option.value !== select.value;
                });
            });
        }

        rows.addEventListener('change', event => {
            if (event.target.matches('.product-select')) {
                updateProductOptions();
            }
            updateTotals();
        });

        rows.addEventListener('input', updateTotals);

        rows.addEventListener('click', event => {
            if (event.target.matches('.remove-row')) {
                const allRows = rows.querySelectorAll('.product-row');

                if (allRows.length > 1) {
                    event.target.closest('.product-row').remove();
                    updateProductOptions();
                    updateTotals();
                }
            }
        });

        addButton?.addEventListener('click', () => {
            const firstRow = rows.querySelector('.product-row');
            const newRow = firstRow.cloneNode(true);

            newRow.querySelector('.product-select').value = '';
            newRow.querySelector('.quantity-input').value = 1;
            newRow.querySelector('.quantity-input').max = '';
            newRow.querySelector('.row-total').textContent =
                'Pilih produk untuk melihat subtotal.';

            rows.appendChild(newRow);
            updateProductOptions();
            updateTotals();
        });

        updateTotals();
    </script>
</body>
</html>
