<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Masuk | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
        .page { max-width: 1050px; margin: 0 auto; padding: 28px 20px; }
        .top { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 22px; }
        h1 { margin: 0 0 7px; font-size: 25px; }
        .muted { color: #64748b; font-size: 13px; }
        .panel { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 20px; }
        .grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
        label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 8px; }
        input, select, textarea { width: 100%; box-sizing: border-box; padding: 11px; border: 1px solid #cbd5e1; border-radius: 7px; font-size: 14px; background: white; }
        textarea { min-height: 85px; resize: vertical; }
        .field { min-width: 0; }
        .btn { display: inline-block; padding: 11px 15px; border: 0; border-radius: 7px; cursor: pointer; font-size: 13px; text-decoration: none; }
        .primary { background: #2563eb; color: white; }
        .secondary { background: #e2e8f0; color: #334155; }
        .danger { background: #fee2e2; color: #991b1b; }
        .product-row { display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 12px; align-items: end; margin-bottom: 15px; }
        .error-box { background: #fee2e2; color: #991b1b; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; }
        .section-title { margin: 0 0 18px; font-size: 17px; }
        .actions { display: flex; justify-content: flex-end; gap: 10px; flex-wrap: wrap; }
        .total { text-align: right; font-weight: bold; font-size: 19px; margin-top: 18px; }
        @media(max-width: 700px) {
            .grid { grid-template-columns: 1fr; }
            .product-row { grid-template-columns: 1fr 1fr; }
            .product-field { grid-column: 1 / -1; }
            .top { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
<div class="page">
    <div class="top">
        <div>
            <h1>Tambah Stok Masuk</h1>
            <div class="muted">Catat pembelian dan penambahan stok produk.</div>
        </div>
        <a href="{{ route('purchases.index') }}" class="btn secondary">← Kembali</a>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($suppliers->isEmpty())
        <div class="error-box">
            Belum ada supplier. Tambahkan supplier terlebih dahulu sebelum mencatat stok masuk.
            <a href="{{ route('suppliers.create') }}">Tambah supplier</a>
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="error-box">
            Belum ada produk aktif. Tambahkan produk terlebih dahulu sebelum mencatat stok masuk.
            <a href="{{ route('products.create') }}">Tambah produk</a>
        </div>
    @endif

    <form method="POST" action="{{ route('purchases.store') }}" id="purchase-form">
        @csrf

        <div class="panel">
            <h3 class="section-title">Informasi Pembelian</h3>
            <div class="grid">
                <div class="field">
                    <label for="supplier_id">Supplier *</label>
                    <select name="supplier_id" id="supplier_id" required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="purchase_date">Tanggal Pembelian *</label>
                    <input type="date" name="purchase_date" id="purchase_date"
                           value="{{ old('purchase_date', date('Y-m-d')) }}" required>
                </div>

                <div class="field" style="grid-column: 1 / -1;">
                    <label for="notes">Catatan</label>
                    <textarea name="notes" id="notes" placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>

        <div class="panel">
            <h3 class="section-title">Daftar Produk</h3>
            <div id="product-rows"></div>

            <button type="button" class="btn secondary" id="add-row">+ Tambah Produk</button>

            <div class="total">
                Perkiraan Total: Rp <span id="grand-total">0</span>
            </div>
            <p class="muted">Total final dihitung kembali oleh server saat transaksi disimpan.</p>
        </div>

        <div class="actions">
            <a href="{{ route('purchases.index') }}" class="btn secondary">Batal</a>
            <button type="submit" class="btn primary"
                @disabled($suppliers->isEmpty() || $products->isEmpty())>
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>

<template id="product-template">
    <div class="product-row">
        <div class="field product-field">
            <label>Produk *</label>
            <select name="product_ids[]" class="product-select" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-cost="{{ $product->purchase_price }}">
                        {{ $product->name }} ({{ $product->sku }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label>Jumlah *</label>
            <input type="number" name="quantities[]" class="quantity-input"
                   min="1" step="1" value="1" required>
        </div>

        <div class="field">
            <label>Harga Modal *</label>
            <input type="number" name="unit_costs[]" class="cost-input"
                   min="0" step="0.01" placeholder="0" required>
        </div>

        <button type="button" class="btn danger remove-row">Hapus</button>
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

        row.querySelector('.product-select').addEventListener('change', event => {
            const selected = event.target.selectedOptions[0];
            const costInput = row.querySelector('.cost-input');

            if (selected && selected.value !== '') {
                costInput.value = selected.dataset.cost || '0';
            }

            updateTotal();
        });

        row.querySelector('.quantity-input').addEventListener('input', updateTotal);
        row.querySelector('.cost-input').addEventListener('input', updateTotal);

        row.querySelector('.remove-row').addEventListener('click', () => {
            row.remove();
            updateTotal();

            if (rowsContainer.querySelectorAll('.product-row').length === 0) {
                addProductRow();
            }
        });

        rowsContainer.appendChild(fragment);
        updateTotal();
    }

    addButton.addEventListener('click', addProductRow);

    addProductRow();
</script>
</body>
</html>
