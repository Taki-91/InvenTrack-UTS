<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <header class="bg-slate-900 text-white px-6 py-5">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold">InvenTrack</h1>
                <p class="text-sm text-slate-300">Manajemen Supplier</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('dashboard') }}" class="bg-slate-700 px-4 py-2 rounded-lg text-sm">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-600 px-4 py-2 rounded-lg text-sm">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-5 md:p-8">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold">Data Supplier</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola pemasok barang.</p>
            </div>
            <a href="{{ route('suppliers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg text-sm font-semibold">
                + Tambah Supplier
            </a>
        </div>

        @if(session('success'))
            <div class="mb-5 p-4 bg-green-100 text-green-800 rounded-lg">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="mb-5 p-4 bg-red-100 text-red-800 rounded-lg">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 bg-red-100 text-red-800 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="GET" action="{{ route('suppliers.index') }}" class="bg-white p-5 rounded-xl border border-slate-200 mb-6 flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, kontak, telepon, atau email..." class="flex-1 min-w-56 border border-slate-300 rounded-lg px-4 py-2">
            <button class="bg-slate-900 hover:bg-slate-700 text-white px-5 py-2 rounded-lg">Cari</button>
            <a href="{{ route('suppliers.index') }}" class="border border-slate-300 px-5 py-2 rounded-lg">Reset</a>
        </form>

        <section class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-200">
                <p class="font-semibold">Total supplier: {{ $suppliers->total() }}</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-5 py-4">Nama Supplier</th>
                            <th class="px-5 py-4">Kontak</th>
                            <th class="px-5 py-4">Telepon</th>
                            <th class="px-5 py-4">Email</th>
                            <th class="px-5 py-4">Alamat</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($suppliers as $supplier)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-4 font-semibold">{{ $supplier->name }}</td>
                                <td class="px-5 py-4">{{ $supplier->contact_person ?: '-' }}</td>
                                <td class="px-5 py-4">{{ $supplier->phone ?: '-' }}</td>
                                <td class="px-5 py-4">{{ $supplier->email ?: '-' }}</td>
                                <td class="px-5 py-4">{{ $supplier->address ?: '-' }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="bg-amber-100 text-amber-800 px-3 py-2 rounded-lg">Edit</a>
                                        <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-100 text-red-700 px-3 py-2 rounded-lg">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-slate-500">
                                    Belum ada data supplier.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-slate-200">
                {{ $suppliers->links() }}
            </div>
        </section>
    </main>
</body>
</html>
