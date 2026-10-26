# InvenTrack
### Inventory Management System

InvenTrack adalah aplikasi berbasis web untuk membantu pengelolaan inventaris barang. Aplikasi ini dibuat untuk memudahkan pencatatan produk, pengelolaan stok, data supplier, pembelian, dan penjualan dalam satu sistem.

## Fitur Utama

- **Dashboard**  
  Menampilkan ringkasan inventaris, aktivitas transaksi, grafik penjualan, produk terlaris, dan informasi stok menipis.

- **Manajemen Produk**  
  Menampilkan dan mengelola data produk, harga, kategori, serta jumlah stok sesuai hak akses pengguna.

- **Manajemen Kategori**  
  Mengelola kategori untuk mengelompokkan produk.

- **Manajemen Supplier**  
  Menampilkan daftar supplier serta menyediakan pengelolaan data supplier sesuai hak akses.

- **Stok Masuk**  
  Mencatat transaksi pembelian dan barang yang masuk ke inventaris.

- **Penjualan**  
  Mencatat transaksi penjualan dan menampilkan riwayat transaksi.

- **Login dan Hak Akses**  
  Pengguna harus login untuk mengakses aplikasi. Menu dan tindakan yang tersedia disesuaikan dengan peran pengguna.

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Blade Template
- HTML dan CSS
- JavaScript
- Composer
- XAMPP sebagai lingkungan pengembangan lokal

## Persyaratan

Pastikan perangkat sudah memiliki:

- PHP sesuai versi Laravel yang digunakan
- Composer
- MySQL atau MariaDB
- Node.js dan npm
- Git (opsional)

## Cara Instalasi

### 1. Clone repository

```bash
git clone https://github.com/Taki-91/InvenTrack-UTS
cd inventory-uts
```

Jika project sudah ada di komputer, buka terminal pada folder tersebut dan lewati langkah ini.

### 2. Install dependency

```bash
composer install
npm install
```

### 3. Konfigurasi environment

Salin file `.env.example` menjadi `.env`. Pada Windows, kamu bisa menggunakan:

```powershell
Copy-Item .env.example .env
```

Kemudian buat application key:

```bash
php artisan key:generate
```

### 4. Buat database

Buka phpMyAdmin, lalu buat database sesuai nama yang akan digunakan di file `.env`.

Contoh konfigurasi:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database dan kredensial dengan konfigurasi lokal.

### 5. Siapkan struktur database

Gunakan file SQL atau migration yang disertakan dalam repository sesuai struktur database project.

Jika project menggunakan migration Laravel dan database masih kosong, jalankan:

```bash
php artisan migrate
```

Jangan menjalankan migration pada database yang sudah berisi data penting tanpa membuat cadangan terlebih dahulu.

### 6. Jalankan aplikasi

Buka terminal pertama:

```bash
php artisan serve
```

Jika aset frontend perlu dikompilasi, buka terminal kedua:

```bash
npm run dev
```

Buka alamat berikut di browser:

http://127.0.0.1:8000

## Hak Akses Pengguna

Hak akses disesuaikan dengan peran masing-masing akun.

| Peran | Akses |
|---|---|
| Owner | Mengelola fitur dan data sesuai kewenangan Owner. |
| Admin/Staff | Mengakses fitur operasional sesuai hak akses, termasuk melihat daftar supplier. |
| User | Mengakses fitur yang disediakan untuk pengguna biasa. |

Akses setiap fitur mengikuti implementasi autentikasi dan otorisasi di aplikasi.

## Struktur Database

Database digunakan untuk menyimpan data pengguna, produk, kategori, supplier, pembelian, penjualan, serta rincian transaksi sesuai struktur database yang diterapkan.

**Dokumentasi database:**
- ERD: tambahkan file ERD project di bagian ini.
- SQL Schema: tambahkan file ekspor database jika tersedia.

## Dokumentasi Aplikasi

| Halaman | Screenshot |
|---|---|
| Login | `screenshots/login.png` |
| Dashboard | `screenshots/dashboard.png` |
| Produk | `screenshots/produk.png` |
| Supplier | `screenshots/supplier.png` |
| Penjualan | `screenshots/penjualan.png` |


## Pengembang

**Nama:** Mhd Agung Nurahman  
**Program Studi:** Sistem Informasi  
**Universitas:** Universitas Malikussaleh

---

InvenTrack - Inventory Management System
