<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Stok Masuk | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .product-row {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(90px, 1fr) minmax(120px, 1fr) auto;
            gap: 12px;
            align-items: end;
            margin-bottom: 16px;
        }

        @media (max-width: 700px) {
            .product-row {
                grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            }

            .product-field {
                grid-column: 1 / -1;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-rose-50/50 text-slate-800">
    <header class="bg-[#3D1025] text-white shadow-lg">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-6 py-5">
            <div>
                <h1 class="text-2xl font-bold tracking-wide">InvenTrack</h1>
                <p class="mt-1 text-sm text-rose-200">Manajemen Stok Masuk</p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="rounded-lg border border-rose-200/30 px-4 py-2 text-sm font-medium transition hover:bg-white/10">
                Dashboard
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-5xl p-5 md:p-8">
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-[#762D46]">
                    Transaksi Inventaris
                </p>
                <h2 class="mt-1 text-3xl font-bold text-[#3D1025]">
                    Tambah Stok Masuk
                </h2>
                <p class="mt-2 text-slate-500">
                    Catat pembelian dan penambahan stok produk.
                </p>
            </div>

            <a href="{{ route('purchases.index') }}"
               class="rounded-lg border border-rose-200 bg-white px-4 py-2.5 text-sm font-semibold text-[#762D46] transition hover:bg-rose-50">
                ← Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($suppliers->isEmpty())
            <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900">
                <p class="font-semibold">Belum ada supplier.</p>
                <p class="mt-1 text-sm">
                    Tambahkan supplier terlebih dahulu sebelum mencatat stok masuk.
                </p>
                <a href="{{ route('suppliers.create') }}"
                   class="mt-2 inline-block font-semibold underline">
                    Tambah supplier
                </a>
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900">
                <p class="font-semibold">Belum ada produk aktif.</p>
                <p class="mt-1 text-sm">
                    Tambahkan produk terlebih dahulu sebelum mencatat stok masuk.
                </p>
                <a href="{{ route('products.create') }}"
                   class="mt-2 inline-block font-semibold underline">
                    Tambah produk
                </a>
            </div>
        @endif

        <form method="POST" action="{{ route('purchases.store') }}" id="purchase-form">
            @csrf

            <section class="mb-6 rounded-xl border border-rose-100 bg-white p-5 shadow-sm md:p-7">
                <div class="mb-5 border-b border-rose-100 pb-4">
                    <h3 class="text-lg font-bold text-[#3D1025]">
                        Informasi Pembelian
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Tentukan supplier dan tanggal transaksi.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label for="supplier_id" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                            Supplier <span class="text-red-500">*</span>
                        </label>

                        <select name="supplier_id" id="supplier_id" required
                                class="w-full rounded-lg border border-rose-200 bg-white px-4 py-3 outline-none transition focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    @selected(old('supplier_id') == $supplier->id)>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('supplier_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="purchase_date" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                            Tanggal Pembelian <span class="text-red-500">*</span>
                        </label>

                        <input type="date" name="purchase_date" id="purchase_date"
                               value="{{ old('purchase_date', date('Y-m-d')) }}" required
                               class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20">

                        @error('purchase_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="notes" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                            Catatan
                        </label>

                        <textarea name="notes" id="notes" rows="3"
                                  placeholder="Catatan tambahan (opsional)"
                                  class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20">{{ old('notes') }}</textarea>

                        @error('notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="mb-6 rounded-xl border border-rose-100 bg-white p-5 shadow-sm md:p-7">
                <div class="mb-5 border-b border-rose-100 pb-4">
                    <h3 class="text-lg font-bold text-[#3D1025]">
                        Daftar Produk
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Pilih produk, masukkan jumlah, dan tentukan harga modal.
                    </p>
                </div>

                <div id="product-rows"></div>

                <button type="button" id="add-row"
                        class="rounded-lg border border-rose-200 px-4 py-2.5 text-sm font-semibold text-[#762D46] transition hover:bg-rose-50">
                    + Tambah Produk
                </button>

                <div class="mt-6 rounded-lg bg-rose-50 p-4 text-right">
                    <p class="text-sm text-slate-600">Perkiraan Total Pembelian</p>
                    <p class="mt-1 text-2xl font-bold text-[#3D1025]">
                        Rp <span id="grand-total">0</span>
                    </p>
                </div>

                <p class="mt-3 text-xs text-slate-500">
                    Total di atas merupakan perkiraan. Total akhir tetap dihitung oleh server saat transaksi disimpan.
                </p>
            </section>

            <div class="flex flex-wrap justify-end gap-3">
                <a href="{{ route('purchases.index') }}"
                   class="rounded-lg border border-rose-200 bg-white px-5 py-3 font-semibold text-[#762D46] transition hover:bg-rose-50">
                    Batal
                </a>

                <button type="submit"
                        class="rounded-lg bg-[#762D46] px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-[#5A1E35]"
                        @disabled($suppliers->isEmpty() || $products->isEmpty())>
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </main>

    <template id="product-template">
        <div class="product-row rounded-lg border border-rose-100 bg-rose-50/40 p-4">
            <div class="field product-field">
                <label class="mb-2 block text-sm font-semibold text-[#3D1025]">
                    Produk <span class="text-red-500">*</span>
                </label>

                <select name="product_ids[]" class="product-select" required
                        class="w-full rounded-lg border border-rose-200 bg-white px-3 py-2.5">
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                                data-cost="{{ $product->purchase_price }}">
                            {{ $product->name }} ({{ $product->sku }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label class="mb-2 block text-sm font-semibold text-[#3D1025]">
                    Jumlah <span class="text-red-500">*</span>
                </label>

                <input type="number" name="quantities[]" class="quantity-input"
                       min="1" step="1" value="1" required
                       class="w-full rounded-lg border border-rose-200 px-3 py-2.5">
            </div>

            <div class="field">
                <label class="mb-2 block text-sm font-semibold text-[#3D1025]">
                    Harga Modal <span class="text-red-500">*</span>
                </label>

                <input type="number" name="unit_costs[]" class="cost-input"
                       min="0" step="0.01" placeholder="0" required
                       class="w-full rounded-lg border border-rose-200 px-3 py-2.5">
            </div>

            <button type="button"
                    class="remove-row rounded-lg bg-red-100 px-3 py-2.5 text-sm font-semibold text-red-700 transition hover:bg-red-200">
                Hapus
            </button>
        </div>
    </template>

    <script>
        const rowsContainer = document.getElementById('product-rows');
        const template = document.getElementById('product-template');
        const addButton = document.getElementById('add-row');
        const totalElement = document.getElementById('grand-total');

        function formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                maximumFractionDigits: 2
            }).format(value);
        }

        function updateTotal() {
            let total = 0;

            rowsContainer.querySelectorAll('.product-row').forEach(row => {
                const quantity = Number(row.querySelector('.quantity-input').value) || 0;
                const cost = Number(row.querySelector('.cost-input').value) || 0;

                total += quantity * cost;
            });

            totalElement.textContent = formatRupiah(total);
        }

        function addProductRow() {
            const fragment = template.content.cloneNode(true);
            const row = fragment.querySelector('.product-row');

            const productSelect = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.quantity-input');
            const costInput = row.querySelector('.cost-input');
            const removeButton = row.querySelector('.remove-row');

            productSelect.addEventListener('change', event => {
                const selected = event.target.selectedOptions[0];

                if (selected && selected.value !== '') {
                    costInput.value = selected.dataset.cost || '0';
                }

                updateTotal();
            });

            quantityInput.addEventListener('input', updateTotal);
            costInput.addEventListener('input', updateTotal);

            removeButton.addEventListener('click', () => {
                row.remove();

                if (rowsContainer.querySelectorAll('.product-row').length === 0) {
                    addProductRow();
                }

                updateTotal();
            });

            rowsContainer.appendChild(fragment);
            updateTotal();
        }

        addButton.addEventListener('click', addProductRow);

        addProductRow();
    </script>
</body>
</html>
