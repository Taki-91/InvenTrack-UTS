<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-rose-50 text-slate-800 min-h-screen">

    <header class="bg-[#3D1025] text-white px-6 py-5 shadow-sm">
        <div class="max-w-4xl mx-auto flex flex-wrap justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold">InvenTrack</h1>
                <p class="text-sm text-rose-200 mt-1">Manajemen Produk</p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="px-4 py-2 rounded-lg bg-[#762D46] hover:bg-[#5A1E35] text-sm">
                Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto p-5 md:p-8">

        <div class="mb-6">
            <a href="{{ route('products.index') }}"
               class="text-[#762D46] hover:underline text-sm font-medium">
                ← Kembali ke Produk
            </a>

            <h2 class="text-2xl font-bold text-[#3D1025] mt-3">
                Edit Produk
            </h2>

            <p class="text-rose-900 text-sm mt-1">
                Perbarui informasi {{ $product->name }}.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-5 p-4 rounded-lg bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 rounded-lg bg-red-100 text-red-800">
                <p class="font-semibold mb-2">Periksa kembali data:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('products.update', $product) }}"
              class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-rose-200 space-y-5">

            @csrf
            @method('PUT')

            <div class="border-b border-rose-100 pb-4">
                <h3 class="font-bold text-lg text-[#3D1025]">Informasi Produk</h3>
                <p class="text-sm text-slate-500 mt-1">
                    Perbarui identitas dan kategori produk.
                </p>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium mb-2">
                    Nama Produk <span class="text-red-600">*</span>
                </label>

                <input id="name" name="name" type="text" required
                       value="{{ old('name', $product->name) }}"
                       class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">

                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="sku" class="block text-sm font-medium mb-2">
                        SKU <span class="text-red-600">*</span>
                    </label>

                    <input id="sku" name="sku" type="text" required
                           value="{{ old('sku', $product->sku) }}"
                           class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">

                    @error('sku')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium mb-2">
                        Kategori <span class="text-red-600">*</span>
                    </label>

                    <select id="category_id" name="category_id" required
                            class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">
                        <option value="">Pilih kategori</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-2">
                    Deskripsi
                </label>

                <textarea id="description" name="description" rows="3"
                          class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300"
                          placeholder="Deskripsi singkat produk">{{ old('description', $product->description) }}</textarea>

                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-b border-rose-100 pb-4 pt-2">
                <h3 class="font-bold text-lg text-[#3D1025]">Harga dan Persediaan</h3>
                <p class="text-sm text-slate-500 mt-1">
                    Perbarui harga dan jumlah stok produk.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="purchase_price" class="block text-sm font-medium mb-2">
                        Harga Beli (Rp) <span class="text-red-600">*</span>
                    </label>

                    <input id="purchase_price" name="purchase_price" type="number"
                           min="0" step="0.01" required
                           value="{{ old('purchase_price', $product->purchase_price) }}"
                           class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">

                    @error('purchase_price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="selling_price" class="block text-sm font-medium mb-2">
                        Harga Jual (Rp) <span class="text-red-600">*</span>
                    </label>

                    <input id="selling_price" name="selling_price" type="number"
                           min="0" step="0.01" required
                           value="{{ old('selling_price', $product->selling_price) }}"
                           class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">

                    @error('selling_price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium mb-2">
                        Stok <span class="text-red-600">*</span>
                    </label>

                    <input id="stock" name="stock" type="number"
                           min="0" step="1" required
                           value="{{ old('stock', $product->stock) }}"
                           class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">

                    @error('stock')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="minimum_stock" class="block text-sm font-medium mb-2">
                        Batas Stok Minimum <span class="text-red-600">*</span>
                    </label>

                    <input id="minimum_stock" name="minimum_stock" type="number"
                           min="0" step="1" required
                           value="{{ old('minimum_stock', $product->minimum_stock) }}"
                           class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">

                    @error('minimum_stock')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-b border-rose-100 pb-4 pt-2">
                <h3 class="font-bold text-lg text-[#3D1025]">Status Produk</h3>
                <p class="text-sm text-slate-500 mt-1">
                    Tentukan status produk saat ini.
                </p>
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium mb-2">
                    Status <span class="text-red-600">*</span>
                </label>

                <select id="is_active" name="is_active" required
                        class="w-full border border-rose-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-300">
                    <option value="1"
                        {{ old('is_active', (string) $product->is_active) == '1' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0"
                        {{ old('is_active', (string) $product->is_active) == '0' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>

                @error('is_active')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3 pt-5 border-t border-rose-100">
                <button type="submit"
                        class="bg-[#762D46] hover:bg-[#5A1E35] text-white px-5 py-3 rounded-lg font-semibold">
                    Simpan Perubahan
                </button>

                <a href="{{ route('products.index') }}"
                   class="border border-rose-300 text-rose-950 hover:bg-rose-50 px-5 py-3 rounded-lg">
                    Batal
                </a>
            </div>

        </form>

        <p class="text-center text-xs text-slate-500 mt-6">
            InvenTrack · Sistem Manajemen Inventaris
        </p>

    </main>
</body>
</html>
