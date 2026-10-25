<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-6xl p-6 md:p-10">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <a href="{{ route('dashboard') }}" class="text-sm text-blue-600">← Dashboard</a>
                <h1 class="mt-2 text-3xl font-bold">Kategori Produk</h1>
                <p class="mt-1 text-slate-500">Kelola kategori barang inventaris.</p>
            </div>
            <a href="{{ route('categories.create') }}"
               class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white">
                + Tambah Kategori
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

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="GET" action="{{ route('categories.index') }}"
              class="mb-5 flex flex-wrap gap-3 rounded-xl bg-white p-4 shadow-sm">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama kategori..."
                   class="min-w-0 flex-1 rounded-lg border-slate-300">
            <button class="rounded-lg bg-slate-800 px-5 py-2 text-white">Cari</button>
            <a href="{{ route('categories.index') }}"
               class="rounded-lg border px-5 py-2">Reset</a>
        </form>

        <div class="overflow-x-auto rounded-xl bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="p-4">No.</th>
                        <th class="p-4">Nama Kategori</th>
                        <th class="p-4">Deskripsi</th>
                        <th class="p-4">Jumlah Produk</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-t">
                            <td class="p-4">{{ $categories->firstItem() + $loop->index }}</td>
                            <td class="p-4 font-semibold">{{ $category->name }}</td>
                            <td class="p-4">{{ $category->description ?: '-' }}</td>
                            <td class="p-4">{{ $category->products_count }}</td>
                            <td class="p-4">
                                <div class="flex gap-3">
                                    <a class="text-blue-600"
                                       href="{{ route('categories.edit', $category) }}">Edit</a>
                                    <form method="POST"
                                          action="{{ route('categories.destroy', $category) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-500">
                                Belum ada kategori. Tambahkan kategori pertama.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $categories->links() }}</div>
    </main>
</body>
</html>