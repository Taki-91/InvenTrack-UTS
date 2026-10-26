<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-rose-50/50 text-slate-800">
    <header class="bg-[#3D1025] text-white shadow-lg">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-6 py-5 md:px-10">
            <div>
                <h1 class="text-2xl font-bold tracking-wide">InvenTrack</h1>
                <p class="mt-1 text-sm text-rose-200">Manajemen Inventaris</p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="rounded-lg border border-rose-200/30 px-4 py-2 text-sm font-medium transition hover:bg-white/10">
                ← Dashboard
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-6xl p-6 md:p-10">
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-[#762D46]">
                    Data Inventaris
                </p>
                <h2 class="mt-1 text-3xl font-bold text-[#3D1025]">
                    Kategori Produk
                </h2>
                <p class="mt-2 text-slate-500">
                    Kelola kategori barang inventaris.
                </p>
            </div>

            <a href="{{ route('categories.create') }}"
               class="rounded-lg bg-[#762D46] px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-[#5A1E35]">
                + Tambah Kategori
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
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="GET" action="{{ route('categories.index') }}"
              class="mb-6 flex flex-wrap gap-3 rounded-xl border border-rose-100 bg-white p-4 shadow-sm">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama kategori..."
                class="min-w-0 flex-1 rounded-lg border border-rose-200 px-4 py-2.5 focus:border-[#762D46] focus:outline-none focus:ring-2 focus:ring-[#762D46]/20"
            >

            <button type="submit"
                    class="rounded-lg bg-[#3D1025] px-5 py-2.5 font-medium text-white transition hover:bg-[#5A1E35]">
                Cari
            </button>

            <a href="{{ route('categories.index') }}"
               class="rounded-lg border border-rose-200 px-5 py-2.5 font-medium text-[#762D46] transition hover:bg-rose-50">
                Reset
            </a>
        </form>

        <div class="overflow-hidden rounded-xl border border-rose-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#3D1025] text-white">
                        <tr>
                            <th class="whitespace-nowrap p-4 font-semibold">No.</th>
                            <th class="whitespace-nowrap p-4 font-semibold">Nama Kategori</th>
                            <th class="whitespace-nowrap p-4 font-semibold">Deskripsi</th>
                            <th class="whitespace-nowrap p-4 font-semibold">Jumlah Produk</th>
                            <th class="whitespace-nowrap p-4 font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-rose-100">
                        @forelse ($categories as $category)
                            <tr class="transition hover:bg-rose-50/70">
                                <td class="whitespace-nowrap p-4 text-slate-500">
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>

                                <td class="whitespace-nowrap p-4 font-semibold text-[#3D1025]">
                                    {{ $category->name }}
                                </td>

                                <td class="p-4 text-slate-600">
                                    {{ $category->description ?: '-' }}
                                </td>

                                <td class="whitespace-nowrap p-4">
                                    <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 font-semibold text-[#762D46]">
                                        {{ $category->products_count }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap p-4">
                                    <div class="flex items-center gap-3">
                                        <a
                                            class="font-semibold text-[#762D46] transition hover:text-[#3D1025] hover:underline"
                                            href="{{ route('categories.edit', $category) }}">
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('categories.destroy', $category) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="font-semibold text-red-600 transition hover:text-red-800 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center">
                                    <p class="font-semibold text-[#3D1025]">
                                        Belum ada kategori
                                    </p>
                                    <p class="mt-1 text-slate-500">
                                        Tambahkan kategori pertama untuk mulai mengelola inventaris.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5">
            {{ $categories->links() }}
        </div>
    </main>
</body>
</html>
