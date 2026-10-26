<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kategori | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-rose-50/50 text-slate-800">
    <header class="bg-[#3D1025] text-white shadow-lg">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-6 py-5 md:px-10">
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

    <main class="mx-auto max-w-2xl p-6 md:p-10">
        <a href="{{ route('categories.index') }}"
           class="text-sm font-semibold text-[#762D46] transition hover:text-[#3D1025] hover:underline">
            ← Kembali ke Kategori
        </a>

        <div class="mb-6 mt-5">
            <p class="text-sm font-semibold uppercase tracking-wider text-[#762D46]">
                Data Inventaris
            </p>
            <h2 class="mt-1 text-3xl font-bold text-[#3D1025]">
                Tambah Kategori
            </h2>
            <p class="mt-2 text-slate-500">
                Isi informasi kategori baru untuk mengelompokkan produk.
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

        <form method="POST" action="{{ route('categories.store') }}"
              class="space-y-5 rounded-xl border border-rose-100 bg-white p-6 shadow-sm md:p-8">
            @csrf

            <div>
                <label for="name" class="mb-2 block font-semibold text-[#3D1025]">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    placeholder="Contoh: Elektronik"
                    class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                >

                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="mb-2 block font-semibold text-[#3D1025]">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Jelaskan kategori ini (opsional)"
                    class="w-full rounded-lg border border-rose-200 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-[#762D46] focus:ring-2 focus:ring-[#762D46]/20"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <p class="mt-2 text-sm text-slate-500">
                    Deskripsi boleh dikosongkan jika tidak diperlukan.
                </p>
            </div>

            <div class="flex flex-wrap gap-3 border-t border-rose-100 pt-5">
                <button
                    type="submit"
                    class="rounded-lg bg-[#762D46] px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-[#5A1E35]">
                    Simpan Kategori
                </button>

                <a
                    href="{{ route('categories.index') }}"
                    class="rounded-lg border border-rose-200 px-5 py-3 font-semibold text-[#762D46] transition hover:bg-rose-50">
                    Batal
                </a>
            </div>
        </form>
    </main>
</body>
</html>
