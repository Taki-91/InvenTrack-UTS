<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Supplier | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-rose-50/50 text-slate-800">
    <header class="bg-[#3D1025] text-white shadow-lg">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-6 py-5">
            <div>
                <h1 class="text-2xl font-bold tracking-wide">InvenTrack</h1>
                <p class="mt-1 text-sm text-rose-200">Manajemen Supplier</p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="rounded-lg border border-rose-200/30 px-4 py-2 text-sm font-medium transition hover:bg-white/10">
                Dashboard
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-3xl p-5 md:p-8">
        <a href="{{ route('suppliers.index') }}"
           class="text-sm font-semibold text-[#762D46] transition hover:text-[#3D1025] hover:underline">
            ← Kembali ke Supplier
        </a>

        <div class="mb-6 mt-5">
            <p class="text-sm font-semibold uppercase tracking-wider text-[#762D46]">
                Data Inventaris
            </p>
            <h2 class="mt-1 text-3xl font-bold text-[#3D1025]">
                Tambah Supplier
            </h2>
            <p class="mt-2 text-slate-500">
                Masukkan informasi pemasok barang ke dalam sistem.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                <p class="mb-2 font-semibold">Ada data yang perlu diperbaiki:</p>
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('suppliers.store') }}"
              class="space-y-5 rounded-xl border border-rose-100 bg-white p-6 shadow-sm md:p-8">
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                    Nama Supplier <span class="text-red-500">*</span>
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                    placeholder="Masukkan nama supplier">

                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contact_person" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                    Nama Kontak
                </label>
                <input
                    id="contact_person"
                    name="contact_person"
                    type="text"
                    value="{{ old('contact_person') }}"
                    class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                    placeholder="Nama orang yang bisa dihubungi">

                @error('contact_person')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="phone" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                        Nomor Telepon
                    </label>
                    <input
                        id="phone"
                        name="phone"
                        type="text"
                        value="{{ old('phone') }}"
                        class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                        placeholder="Contoh: 081234567890">

                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                        placeholder="supplier@email.com">

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="address" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                    Alamat
                </label>
                <textarea
                    id="address"
                    name="address"
                    rows="3"
                    class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                    placeholder="Alamat lengkap supplier">{{ old('address') }}</textarea>

                @error('address')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notes" class="mb-2 block text-sm font-semibold text-[#3D1025]">
                    Catatan
                </label>
                <textarea
                    id="notes"
                    name="notes"
                    rows="3"
                    class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                    placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>

                @error('notes')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3 border-t border-rose-100 pt-5">
                <button
                    type="submit"
                    class="rounded-lg bg-[#762D46] px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-[#5A1E35]">
                    Simpan Supplier
                </button>

                <a href="{{ route('suppliers.index') }}"
                   class="rounded-lg border border-rose-200 px-5 py-3 font-semibold text-[#762D46] transition hover:bg-rose-50">
                    Batal
                </a>
            </div>
        </form>
    </main>
</body>
</html>
