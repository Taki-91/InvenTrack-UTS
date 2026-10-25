<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <main class="max-w-4xl mx-auto p-5 md:p-8">
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Kembali ke Produk
            </a>
            <h1 class="text-2xl font-bold mt-3">Tambah Produk</h1>
            <p class="text-slate-500 text-sm mt-1">Isi informasi produk dengan benar.</p>
        </div>

        @if($errors->any())
            <div class="mb-5 p-4 rounded-lg bg-red-100 text-red-800">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('products.store') }}"
              class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-slate-200 space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium mb-2">Nama Produk *</label>
                <input id="name" name="name" type="text" required
                       value="{{ old('name') }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2"
                       placeholder="Contoh: Keyboard Mechanical">
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="sku" class="block text-sm font-medium mb-2">SKU *</label>
                    <input id="sku" name="sku" type="text" required
                           value="{{ old('sku') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2"
                           placeholder="Contoh: KB-001">
                    @error('sku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium mb-2">Kategori *</label>
                    <select id="category_id" name="category_id" required
                            class="w-full border border-slate-300 rounded-lg px-3 py-2">
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    @if($categories->isEmpty())
                        <p class="text-amber-700 text-sm mt-2">
                            Belum ada kategori. Buat kategori terlebih dahulu.
                        </p>
                    @endif
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full border border-slate-300 rounded-lg px-3 py-2"
                          placeholder="Deskripsi singkat produk">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="purchase_price" class="block text-sm font-medium mb-2">Harga Beli (Rp) *</label>
                    <input id="purchase_price" name="purchase_price" type="number"
                           min="0" step="0.01" required value="{{ old('purchase_price', 0) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    @error('purchase_price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="selling_price" class="block text-sm font-medium mb-2">Harga Jual (Rp) *</label>
                    <input id="selling_price" name="selling_price" type="number"
                           min="0" step="0.01" required value="{{ old('selling_price', 0) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    @error('selling_price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium mb-2">Stok Awal *</label>
                    <input id="stock" name="stock" type="number" min="0" step="1"
                           required value="{{ old('stock', 0) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    @error('stock') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="minimum_stock" class="block text-sm font-medium mb-2">Batas Stok Minimum *</label>
                    <input id="minimum_stock" name="minimum_stock" type="number" min="0" step="1"
                           required value="{{ old('minimum_stock', 5) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    @error('minimum_stock') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium mb-2">Status Produk *</label>
                <select id="is_active" name="is_active" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex flex-wrap gap-3 pt-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold">
                    Simpan Produk
                </button>
                <a href="{{ route('products.index') }}"
                   class="border border-slate-300 hover:bg-slate-100 px-5 py-3 rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </main>
</body>
</html>
