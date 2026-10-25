# InvenTrack - Sistem Informasi Inventaris

InvenTrack adalah aplikasi berbasis web untuk mengelola data inventaris barang, kategori, supplier, transaksi pembelian, dan penjualan. Aplikasi ini dibuat menggunakan Laravel sebagai proyek UTS.

## Fitur Aplikasi

- Login dan logout pengguna.
- Dashboard untuk menampilkan ringkasan data inventaris dan transaksi.
- Pengelolaan kategori, produk, dan supplier.
- Pencatatan transaksi pembelian atau stok masuk.
- Pencatatan transaksi penjualan.
- Perubahan stok otomatis berdasarkan transaksi.
- Validasi stok agar jumlah penjualan tidak melebihi stok yang tersedia.
- Pencarian dan daftar data transaksi.
- Informasi produk dengan stok menipis.
- Hak akses pengguna berdasarkan role.

## Teknologi yang Digunakan

- PHP 8.2
- Laravel 12
- MySQL
- Blade Template
- Tailwind CSS
- Vite
- XAMPP
- Composer
- Node.js dan npm

## Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan perangkat sudah memiliki:

- PHP 8.2 atau versi yang sesuai dengan kebutuhan proyek.
- Composer.
- Node.js dan npm.
- MySQL atau MariaDB.
- XAMPP atau lingkungan server lokal sejenis.

## Cara Instalasi

### 1. Clone Repository

Buka terminal, lalu jalankan:

```bash
git clone URL_REPOSITORY
```

Ganti `URL_REPOSITORY` dengan URL repository GitHub proyek InvenTrack.

Masuk ke folder proyek:

```bash
cd inventory-uts
```

### 2. Install Dependency

Install dependency Laravel:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Di Windows PowerShell, gunakan:

```powershell
Copy-Item .env.example .env
```

Buat application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Jalankan Apache dan MySQL melalui XAMPP.

Buat database dengan nama:

```text
inventory_uts
```

Kemudian sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_uts
DB_USERNAME=root
DB_PASSWORD=
```

Konfigurasi di atas merupakan contoh untuk instalasi lokal XAMPP. Sesuaikan username dan password jika konfigurasi MySQL berbeda.

### 5. Siapkan Struktur Database

Jika menggunakan migration, jalankan:

```bash
php artisan migrate
```

Jika proyek menggunakan seeder untuk membuat data awal, jalankan:

```bash
php artisan db:seed
```

Jika database disediakan dalam file SQL, impor file tersebut melalui phpMyAdmin sebagai alternatif sesuai struktur database proyek. Jangan menjalankan impor SQL dan migration secara bersamaan tanpa memeriksa struktur tabel terlebih dahulu.

### 6. Jalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Untuk menjalankan aset frontend selama pengembangan, buka terminal kedua dan jalankan:

```bash
npm run dev
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

## Hak Akses Pengguna

Aplikasi memiliki tiga role pengguna:

| Role | Hak Akses |
|---|---|
| Admin | Mengelola data utama dan melakukan transaksi sesuai hak akses yang diterapkan. |
| Owner | Mengakses dashboard dan data inventaris serta transaksi sesuai hak akses yang diterapkan. |
| Staff | Melihat data inventaris dan melakukan transaksi yang diizinkan, seperti stok masuk dan penjualan. |

Akses setiap halaman ditentukan oleh middleware dan konfigurasi role di aplikasi.

## Alur Transaksi

### Pembelian / Stok Masuk

1. Pengguna membuka menu pembelian.
2. Pengguna mengisi data transaksi dan barang yang diterima.
3. Sistem memvalidasi data transaksi.
4. Setelah transaksi berhasil, stok produk bertambah.

### Penjualan

1. Pengguna membuka menu penjualan.
2. Pengguna memilih produk dan jumlah barang yang dijual.
3. Sistem memvalidasi jumlah barang terhadap stok tersedia.
4. Jika transaksi berhasil, stok produk berkurang.
5. Jika jumlah penjualan melebihi stok, sistem menolak transaksi.

## Struktur Proyek

Beberapa direktori utama yang digunakan:

```text
inventory-uts/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── public/
├── config/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

## Catatan Keamanan

- File `.env` tidak boleh diunggah ke repository publik.
- Gunakan `.env.example` sebagai contoh konfigurasi.
- Jangan gunakan password akun pribadi untuk akun demo.
- Pastikan setiap role hanya dapat mengakses fitur yang diizinkan.

## Tujuan Proyek

Proyek ini dibuat untuk memenuhi tugas Ujian Tengah Semester (UTS) dengan menerapkan pengelolaan data inventaris, relasi database, transaksi pembelian dan penjualan, validasi data, dashboard, serta pembatasan hak akses pengguna menggunakan Laravel.

---

**Nama Aplikasi:** InvenTrack  
**Jenis Proyek:** Sistem Informasi Inventaris Berbasis Web  
**Framework:** Laravel 12
