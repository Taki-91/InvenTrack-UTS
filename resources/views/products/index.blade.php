<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen">
        <header class="bg-slate-900 text-white px-6 py-5">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold">InvenTrack</h1>
                    <p class="text-sm text-slate-300 mt-1">Manajemen Produk</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 text-sm">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-500 text-sm">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto p-5 md:p-8">
            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold">Data Produk</h2>
                    <p class="text-slate-500 text-sm mt-1">
                        Kelola informasi dan persediaan produk.
                    </p>
                </div>
                <a href="{{ route('products.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg text-sm font-semibold">
                    + Tambah Produk
                </a>
            </div>

            @if(session('success'))
                <div class="mb-5 p-4 rounded-lg bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-4 rounded-lg bg-red-100 text-red-800">
                    {{ session('error') }}
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

            <section class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 mb-6">
                <form method="GET" action="{{ route('products.index') }}"
                      class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium mb-2">
                            Cari Produk
                        </label>
                        <input id="search" name="search" type="text"
                               value="{{ request('search') }}"
                               placeholder="Nama produk atau SKU..."
                               class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium mb-2">
                            Filter Kategori
                        </label>
                        <select id="category_id" name="category_id"
                                class="w-full border border-slate-300 rounded-lg px-3 py-2">
                            <option value="">Semua kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="bg-slate-900 hover:bg-slate-700 text-white rounded-lg px-4 py-2">
                            Cari
                        </button>
                        <a href="{{ route('products.index') }}"
                           class="border border-slate-300 hover:bg-slate-100 rounded-lg px-4 py-2">
                            Reset
                        </a>
                    </div>
                </form>
            </section>

            <section class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-5 border-b border-slate-200">
                    <h3 class="font-bold">Daftar Produk</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Total hasil: {{ $products->total() }} produk
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-5 py-4">SKU</th>
                                <th class="px-5 py-4">Nama Produk</th>
                                <th class="px-5 py-4">Kategori</th>
                                <th class="px-5 py-4">Harga Jual</th>
                                <th class="px-5 py-4 text-center">Stok</th>
                                <th class="px-5 py-4">Status</th>
                                <th class="px-5 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($products as $product)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-4 font-medium">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-semibold">{{ $product->name }}</p>
                                        @if($product->description)
                                            <p class="text-xs text-slate-500 mt-1">
                                                {{ $product->description }}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        {{ $product->category->name ?? '-' }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        Rp {{ number_format((float) $product->selling_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $product->stock <= $product->minimum_stock
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-green-100 text-green-700' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if($product->is_active)
                                            <span class="text-green-700 bg-green-100 px-3 py-1 rounded-full text-xs">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="text-slate-600 bg-slate-200 px-3 py-1 rounded-full text-xs">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('products.edit', $product) }}"
                                               class="bg-amber-100 text-amber-800 hover:bg-amber-200 px-3 py-2 rounded-lg">
                                                Edit
                                            </a>
                                            <form method="POST"
                                                  action="{{ route('products.destroy', $product) }}"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-2 rounded-lg">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-10 text-center text-slate-500">
                                        Belum ada data produk. Klik Tambah Produk untuk memulai.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-slate-200">
                    {{ $products->links() }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
