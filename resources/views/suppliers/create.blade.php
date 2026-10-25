<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier | InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <main class="max-w-3xl mx-auto p-5 md:p-8">
        <a href="{{ route('suppliers.index') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Supplier</a>
        <h1 class="text-2xl font-bold mt-4 mb-6">Tambah Supplier</h1>

        @if($errors->any())
            <div class="mb-5 p-4 bg-red-100 text-red-800 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('suppliers.store') }}" class="bg-white p-6 rounded-xl border border-slate-200 space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium mb-2">Nama Supplier *</label>
                <input id="name" name="name" value="{{ old('name') }}" required class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div>
                <label for="contact_person" class="block text-sm font-medium mb-2">Nama Kontak</label>
                <input id="contact_person" name="contact_person" value="{{ old('contact_person') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="phone" class="block text-sm font-medium mb-2">Nomor Telepon</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-2">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium mb-2">Alamat</label>
                <textarea id="address" name="address" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2">{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium mb-2">Catatan</label>
                <textarea id="notes" name="notes" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2">{{ old('notes') }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold">Simpan Supplier</button>
                <a href="{{ route('suppliers.index') }}" class="border border-slate-300 px-5 py-3 rounded-lg">Batal</a>
            </div>
        </form>
    </main>
</body>
</html>
