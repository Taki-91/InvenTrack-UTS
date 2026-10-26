<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-rose-50/50 text-slate-800">
    <header class="bg-[#3D1025] text-white shadow-lg">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-6 py-5">
            <div>
                <h1 class="text-2xl font-bold tracking-wide">InvenTrack</h1>
                <p class="mt-1 text-sm text-rose-200">Manajemen Supplier</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('dashboard') }}"
                   class="rounded-lg border border-rose-200/30 px-4 py-2 text-sm font-medium transition hover:bg-white/10">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl p-5 md:p-8">
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-[#762D46]">
                    Data Inventaris
                </p>
                <h2 class="mt-1 text-3xl font-bold text-[#3D1025]">
                    Data Supplier
                </h2>
                <p class="mt-2 text-slate-500">
                    Kelola informasi pemasok barang inventaris.
                </p>
            </div>

            <a href="{{ route('suppliers.create') }}"
               class="rounded-lg bg-[#762D46] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#5A1E35]">
                + Tambah Supplier
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

        <form method="GET" action="{{ route('suppliers.index') }}"
              class="mb-6 flex flex-wrap gap-3 rounded-xl border border-rose-100 bg-white p-5 shadow-sm">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, kontak, telepon, atau email..."
                class="min-w-56 flex-1 rounded-lg border border-rose-200 px-4 py-2.5 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
            >

            <button type="submit"
                    class="rounded-lg bg-[#3D1025] px-5 py-2.5 font-semibold text-white transition hover:bg-[#5A1E35]">
                Cari
            </button>

            <a href="{{ route('suppliers.index') }}"
               class="rounded-lg border border-rose-200 px-5 py-2.5 font-medium text-[#762D46] transition hover:bg-rose-50">
                Reset
            </a>
        </form>

        <section class="overflow-hidden rounded-xl border border-rose-100 bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-rose-100 px-5 py-4">
                <h3 class="font-semibold text-[#3D1025]">Daftar Supplier</h3>

                <p class="text-sm text-slate-500">
                    Total supplier:
                    <span class="font-bold text-[#762D46]">{{ $suppliers->total() }}</span>
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#3D1025] text-white">
                        <tr>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">Nama Supplier</th>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">Kontak</th>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">Telepon</th>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">Email</th>
                            <th class="px-5 py-4 font-semibold">Alamat</th>
                            <th class="whitespace-nowrap px-5 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-rose-100">
                        @forelse ($suppliers as $supplier)
                            <tr class="transition hover:bg-rose-50/70">
                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-[#3D1025]">
                                    {{ $supplier->name }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                    {{ $supplier->contact_person ?: '-' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                    {{ $supplier->phone ?: '-' }}
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $supplier->email ?: '-' }}
                                </td>

                                <td class="min-w-40 px-5 py-4 text-slate-600">
                                    {{ $supplier->address ?: '-' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                           class="rounded-lg bg-rose-100 px-3 py-2 font-semibold text-[#762D46] transition hover:bg-rose-200">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('suppliers.destroy', $supplier) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded-lg bg-red-100 px-3 py-2 font-semibold text-red-700 transition hover:bg-red-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center">
                                    <p class="font-semibold text-[#3D1025]">
                                        Belum ada data supplier
                                    </p>
                                    <p class="mt-1 text-slate-500">
                                        Tambahkan supplier untuk mulai mengelola data pemasok.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-rose-100 p-5">
                {{ $suppliers->links() }}
            </div>
        </section>
    </main>
</body>
</html>
