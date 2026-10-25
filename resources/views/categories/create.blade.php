<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kategori | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-2xl p-6 md:p-10">
        <a href="{{ route('categories.index') }}" class="text-sm text-blue-600">← Kembali</a>
        <h1 class="my-5 text-3xl font-bold">Tambah Kategori</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categories.store') }}"
              class="space-y-5 rounded-xl bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label for="name" class="mb-2 block font-semibold">Nama Kategori</label>
                <input id="name" name="name" value="{{ old('name') }}"
                       required maxlength="255"
                       class="w-full rounded-lg border-slate-300"
                       placeholder="Contoh: Elektronik">
            </div>

            <div>
                <label for="description" class="mb-2 block font-semibold">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full rounded-lg border-slate-300"
                          placeholder="Deskripsi kategori (opsional)">{{ old('description') }}</textarea>
            </div>

            <button class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white">
                Simpan Kategori
            </button>
        </form>
    </main>
</body>
</html>
