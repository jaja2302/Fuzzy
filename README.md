# Fuzzy Time Series - Perkiraan Dinamis Stunting

Aplikasi Laravel untuk perhitungan Fuzzy Time Series dalam memprediksi kasus stunting berdasarkan data historis.

## 🚀 Fitur Utama

- **Fuzzy Time Series Algorithm**: Implementasi algoritma FTS untuk prediksi stunting
- **Manajemen Data Wilayah**: CRUD untuk data provinsi dan kabupaten
- **Manajemen Data Stunting**: CRUD untuk data kasus stunting per wilayah
- **Perhitungan Otomatis**: Sistem otomatis menghitung interval, fuzzy set, dan prediksi
- **Tampilan yang User-Friendly**: Interface yang mudah digunakan dengan Bootstrap

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 10.x
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Font Awesome
- **Algorithm**: Fuzzy Time Series (FTS)

## 📋 Persyaratan Sistem

- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 5.7 atau lebih tinggi
- Node.js & NPM (untuk asset compilation)

## 🔧 Instalasi

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
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi dan Seeder
```bash
php artisan migrate:fresh --seed
```

### 6. Compile Assets
```bash
npm run build
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 🗄️ Struktur Database

### Tabel `wilayahs`
- `ID_Wilayah` (Primary Key)
- `Provinsi`
- `Kabupaten`
- `nama_wilayah`
- `status_aktif`

### Tabel `stuntings`
- `id_stunting` (Primary Key)
- `id_wilayah` (Foreign Key ke wilayahs.ID_Wilayah)
- `tahun`
- `bulan`
- `jumlah`
- `persentase`

## 🔍 Algoritma Fuzzy Time Series

Aplikasi ini mengimplementasikan algoritma FTS dengan langkah-langkah:

1. **Pembentukan Universe of Discourse (UoD)**
2. **Pembagian Interval**
3. **Fuzzyfikasi Data**
4. **Pembentukan Fuzzy Logic Groups**
5. **Pembentukan Fuzzy Relationships**
6. **Defuzzyfikasi untuk Prediksi**

## 📱 Cara Penggunaan

### 1. Login sebagai Admin
- Akses `/login`
- Gunakan kredensial default dari seeder

### 2. Tambah Data Wilayah
- Akses `/wilayah/create`
- Isi data provinsi dan kabupaten

### 3. Tambah Data Stunting
- Akses `/stunting/create`
- Pilih wilayah dan isi data stunting

### 4. Hitung Fuzzy Time Series
- Akses `/fuzzy-time-series`
- Pilih wilayah dan periode data
- Klik "Hitung FTS"
- Lihat hasil perhitungan

## 🐛 Troubleshooting

### Error: "Column 'id' not found"
**Penyebab**: Laravel mencari kolom `id` sebagai primary key default
**Solusi**: Sudah diperbaiki dengan mengatur `protected $primaryKey = 'ID_Wilayah'` di model

### Error: "Table not found"
**Penyebab**: Migrasi belum dijalankan
**Solusi**: Jalankan `php artisan migrate:fresh --seed`

### Error: "Class not found"
**Penyebab**: Autoload belum di-update
**Solusi**: Jalankan `composer dump-autoload`

## 📊 Contoh Hasil Perhitungan

Aplikasi akan menampilkan:
- Data historis stunting
- Interval fuzzy yang terbentuk
- Fuzzy logic groups
- Fuzzy relationships matrix
- Hasil prediksi untuk periode berikutnya
- Grafik trend dan perbandingan

## 🔐 Default Login

Setelah menjalankan seeder, gunakan kredensial:
- **Email**: admin@example.com
- **Password**: password

## 📞 Support

Jika mengalami masalah, periksa:
1. Log Laravel di `storage/logs/laravel.log`
2. Konfigurasi database di `.env`
3. Versi PHP dan ekstensi yang dibutuhkan

## 📝 License

Proyek ini dibuat untuk keperluan akademis dan penelitian.
