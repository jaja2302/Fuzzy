# Fuzzy Time Series (FTS) - Prediksi Stunting BKKBN SUMUT

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC.svg)](https://tailwindcss.com)

Aplikasi web berbasis Laravel yang mengimplementasikan metode **Fuzzy Time Series (FTS)** untuk memprediksi kenaikan stunting di BKKBN SUMUT. Project ini dirancang untuk membantu analisis dan perencanaan program penanganan stunting berdasarkan data historis.

## 🚀 Fitur Utama

- **Sistem Autentikasi**: Login, register, dan dashboard user
- **Manajemen Data**: CRUD untuk data wilayah dan stunting
- **Fuzzy Time Series**: Implementasi algoritma FTS untuk prediksi
- **Dashboard Admin**: Interface untuk mengelola data dan melihat hasil
- **Interface Publik**: Halaman untuk melihat data dan hasil prediksi
- **Responsive Design**: Menggunakan Tailwind CSS untuk tampilan yang responsif

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12.x
- **Database**: MySQL/PostgreSQL
- **Frontend**: Blade templates + Tailwind CSS
- **PHP**: 8.2+
- **Authentication**: Laravel built-in auth system

## 📋 Prasyarat

Sebelum menjalankan project ini, pastikan sistem Anda memiliki:

- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (untuk asset compilation)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd luckniteshoots
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fts_stunting
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 6. Compile Assets
```bash
npm run dev
```

### 7. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 🔐 Autentikasi

### Login
- **URL**: `/login`
- **Controller**: `AuthController@showLogin` dan `AuthController@login`
- **Method**: GET dan POST

### Register
- **URL**: `/register`
- **Controller**: `AuthController@showRegister` dan `AuthController@register`
- **Method**: GET dan POST

### Logout
- **URL**: `/logout`
- **Controller**: `AuthController@logout`
- **Method**: POST

## 📊 Struktur Database

### Tabel Users
- `id` - Primary key
- `name` - Nama user
- `email` - Email user (unique)
- `password` - Password yang di-hash
- `created_at`, `updated_at` - Timestamps

### Tabel Wilayahs
- `ID_Wilayah` - Primary key
- `Provinsi` - Nama provinsi
- `Kabupaten` - Nama kabupaten
- `nama_wilayah` - Nama wilayah
- `status_aktif` - Status aktif wilayah (boolean)

### Tabel Stuntings
- `id_stunting` - Primary key
- `id_wilayah` - Foreign key ke tabel wilayahs
- `tahun` - Tahun data
- `bulan` - Bulan data
- `jumlah_stunting` - Jumlah kasus stunting

## 🎯 Fitur Fuzzy Time Series

### Controller
- **FuzzyTimeSeriesController**: Mengelola perhitungan FTS
- **FuzzyTimeSeriesService**: Service layer untuk logika bisnis FTS

### Endpoint FTS
- `GET /fuzzy-time-series` - Halaman utama FTS
- `POST /fuzzy-time-series/calculate` - Hitung FTS untuk wilayah tertentu
- `POST /fuzzy-time-series/calculate-all` - Hitung FTS untuk semua wilayah
- `GET /fuzzy-time-series/data` - Lihat data stunting
- `GET /fuzzy-time-series/result` - Lihat hasil perhitungan

### Algoritma FTS
1. **Universe of Discourse (UoD)**: Menentukan range data
2. **Fuzzification**: Mengkonversi data numerik ke fuzzy sets
3. **Fuzzy Logic Groups**: Membuat kelompok logika fuzzy
4. **Fuzzy Relationships**: Membuat relasi antar fuzzy sets
5. **Defuzzification**: Mengkonversi hasil fuzzy ke nilai numerik

## 🗺️ Manajemen Data Wilayah

### Controller
- **WilayahController**: Mengelola CRUD data wilayah

### Endpoint Wilayah
- `GET /wilayah` - Daftar semua wilayah (index)
- `GET /wilayah/create` - Form tambah wilayah baru
- `POST /wilayah` - Simpan wilayah baru
- `GET /wilayah/{id}` - Detail wilayah
- `GET /wilayah/{id}/edit` - Form edit wilayah
- `PUT /wilayah/{id}` - Update data wilayah
- `DELETE /wilayah/{id}` - Hapus wilayah

### Field Data Wilayah
- `Provinsi` - Nama provinsi (required, max 100 karakter)
- `Kabupaten` - Nama kabupaten (required, max 100 karakter)
- `nama_wilayah` - Nama wilayah (optional, max 200 karakter)
- `status_aktif` - Status aktif wilayah (boolean, default false)

### Fitur Wilayah
- Pagination (10 data per halaman)
- Sorting berdasarkan nama kabupaten
- Validasi input data
- Relasi dengan data stunting
- Tampilan detail wilayah dengan data stunting terkait

## 📊 Manajemen Data Stunting

### Controller
- **StuntingController**: Mengelola CRUD data stunting

### Endpoint Stunting
- `GET /stunting` - Daftar semua data stunting (index)
- `GET /stunting/create` - Form tambah data stunting baru
- `POST /stunting` - Simpan data stunting baru
- `GET /stunting/{id}` - Detail data stunting
- `GET /stunting/{id}/edit` - Form edit data stunting
- `PUT /stunting/{id}` - Update data stunting
- `DELETE /stunting/{id}` - Hapus data stunting

### Field Data Stunting
- `id_wilayah` - ID wilayah (required, harus ada di tabel wilayahs)
- `tahun` - Tahun data (required, integer)
- `jumlah_stunting` - Jumlah kasus stunting (required, integer)

### Fitur Stunting
- Pagination (15 data per halaman)
- Filter berdasarkan wilayah dan tahun
- Validasi input data
- Pengecekan duplikasi data (wilayah + tahun)
- Relasi dengan data wilayah
- Sorting berdasarkan tahun (descending)
- Dropdown pilihan wilayah saat create/edit

### Validasi Data Stunting
- `id_wilayah` harus ada di tabel wilayahs
- `tahun` harus berupa integer
- `jumlah_stunting` harus berupa integer
- Tidak boleh ada data duplikat untuk wilayah dan tahun yang sama

## 🗂️ Struktur Project

```
luckniteshoots/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Autentikasi
│   │   ├── FuzzyTimeSeriesController.php # Controller FTS
│   │   ├── StuntingController.php      # CRUD stunting
│   │   ├── WilayahController.php       # CRUD wilayah
│   │   └── PublicController.php        # Halaman publik
│   ├── Models/
│   │   ├── User.php                    # Model user
│   │   ├── Stunting.php                # Model stunting
│   │   └── Wilayah.php                 # Model wilayah
│   └── Services/
│       └── FuzzyTimeSeriesService.php  # Service FTS
├── database/
│   ├── migrations/                     # Database migrations
│   └── seeders/                        # Database seeders
├── resources/
│   └── views/                          # Blade templates
├── routes/
│   └── web.php                         # Web routes
└── public/                             # Public assets
```

## 🔒 Middleware

- **auth**: Memastikan user sudah login
- **admin**: Memastikan user memiliki akses admin

## 🎨 Views

### Auth Views
- `auth/login.blade.php` - Halaman login
- `auth/register.blade.php` - Halaman register
- `auth/dashboard.blade.php` - Dashboard user

### FTS Views
- `fuzzy-time-series/index.blade.php` - Halaman utama FTS
- `fuzzy-time-series/data.blade.php` - Tampilan data stunting
- `fuzzy-time-series/result.blade.php` - Hasil perhitungan FTS

### Admin Views
- `stunting/index.blade.php` - Daftar data stunting dengan filter
- `stunting/create.blade.php` - Form tambah data stunting
- `stunting/edit.blade.php` - Form edit data stunting
- `stunting/show.blade.php` - Detail data stunting
- `wilayah/index.blade.php` - Daftar wilayah dengan pagination
- `wilayah/create.blade.php` - Form tambah wilayah
- `wilayah/edit.blade.php` - Form edit wilayah
- `wilayah/show.blade.php` - Detail wilayah dengan data stunting terkait

### Public Views
- `umum/` - Halaman publik untuk melihat data

## 📱 Cara Penggunaan

### 1. Login sebagai Admin
- Akses `/login`
- Gunakan kredensial yang sudah dibuat
- Setelah login, akses dashboard

### 2. Manajemen Wilayah
- **Lihat Daftar**: Akses `/wilayah` untuk melihat semua wilayah
- **Tambah Wilayah**: Klik "Tambah Wilayah" → `/wilayah/create`
- **Edit Wilayah**: Klik tombol edit pada baris wilayah → `/wilayah/{id}/edit`
- **Detail Wilayah**: Klik nama wilayah → `/wilayah/{id}` (menampilkan data stunting terkait)
- **Hapus Wilayah**: Klik tombol hapus (akan menghapus semua data stunting terkait)

### 3. Manajemen Data Stunting
- **Lihat Daftar**: Akses `/stunting` untuk melihat semua data stunting
- **Filter Data**: Gunakan dropdown wilayah dan input tahun untuk filter
- **Tambah Data**: Klik "Tambah Data Stunting" → `/stunting/create`
- **Edit Data**: Klik tombol edit pada baris data → `/stunting/{id}/edit`
- **Detail Data**: Klik tombol detail → `/stunting/{id}`
- **Hapus Data**: Klik tombol hapus pada baris data

### 4. Perhitungan Fuzzy Time Series
- Akses `/fuzzy-time-series`
- Pilih wilayah dan periode data yang ingin dianalisis
- Klik "Hitung FTS" untuk wilayah tertentu atau "Hitung Semua Wilayah"
- Lihat hasil perhitungan di halaman result

## 🚀 Deployment

### Production
```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Variables
Pastikan semua environment variables sudah diset dengan benar untuk production.

## 🧪 Testing

```bash
php artisan test
```

## 📝 License

Project ini menggunakan license MIT.

## 👥 Kontributor

- **Liza** - Developer utama

## 📞 Kontak

- **Email**: email@gmail.com
- **Phone**: +62 812-3456-7890

## 🔄 Changelog

### v1.0.0
- Implementasi dasar sistem autentikasi
- Implementasi algoritma Fuzzy Time Series
- Manajemen data wilayah dan stunting
- Interface admin dan publik

---

**Note**: Project ini dikembangkan untuk keperluan akademis dan implementasi metode Fuzzy Time Series dalam konteks kesehatan masyarakat.
