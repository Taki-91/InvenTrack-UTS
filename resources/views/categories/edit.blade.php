<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kategori | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-2xl p-6 md:p-10">
        <a href="{{ route('categories.index') }}"
           class="text-sm text-blue-600">← Kembali ke Kategori</a>

        <h1 class="my-5 text-3xl font-bold">Edit Kategori</h1>
        <p class="mb-6 text-slate-500">
            Ubah informasi kategori di bawah ini.
        </p>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">
                {{ session('success') }}
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

        <form method="POST"
              action="{{ route('categories.update', $category) }}"
              class="space-y-5 rounded-xl bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="mb-2 block font-semibold">
                    Nama Kategori
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $category->name) }}"
                    required
                    maxlength="255"
                    class="w-full rounded-lg border-slate-300"
                    placeholder="Contoh: Elektronik">

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="mb-2 block font-semibold">
                    Deskripsi
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full rounded-lg border-slate-300"
                    placeholder="Deskripsi kategori (opsional)">{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white">
                    Simpan Perubahan
                </button>

                <a href="{{ route('categories.index') }}"
                   class="rounded-lg border border-slate-300 px-5 py-3">
                    Batal
                </a>
            </div>
        </form>
    </main>
</body>
</html>
