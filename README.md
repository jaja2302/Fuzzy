# Fuzzy Time Series (FTS) - Prediksi Stunting BKKBN SUMUT

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC.svg)](https://tailwindcss.com)

## 📖 Apa Itu Program Ini?

Program ini adalah **aplikasi web** yang dibuat untuk membantu **BKKBN SUMUT** (Badan Kependudukan dan Keluarga Berencana Nasional Sumatera Utara) dalam **memprediksi kenaikan stunting** di wilayah mereka.

**Stunting** adalah kondisi dimana anak-anak mengalami gangguan pertumbuhan yang menyebabkan tubuh mereka lebih pendek dari ukuran normal untuk usianya.

**Fuzzy Time Series (FTS)** adalah metode matematika yang digunakan untuk memprediksi masa depan berdasarkan data-data yang sudah terjadi sebelumnya. Bayangkan seperti melihat pola cuaca untuk menebak cuaca besok.

## 🎯 Apa yang Bisa Dilakukan Program Ini?

### 1. **Menyimpan Data Wilayah**
- Menyimpan informasi tentang provinsi, kabupaten, dan nama wilayah
- Contoh: Provinsi Sumatera Utara, Kabupaten Medan, Nama Wilayah: Medan Kota

### 2. **Menyimpan Data Stunting**
- Mencatat berapa banyak kasus stunting di setiap wilayah setiap tahun
- Contoh: Di Medan Kota tahun 2023 ada 150 kasus stunting

### 3. **Memprediksi Stunting**
- Menggunakan data masa lalu untuk menebak berapa kasus stunting yang mungkin terjadi di masa depan
- Contoh: Jika tahun 2021 ada 100 kasus, 2022 ada 120 kasus, 2023 ada 150 kasus, maka 2024 mungkin ada 180 kasus

### 4. **Melihat Hasil**
- Menampilkan data dalam bentuk tabel dan grafik
- Membuat laporan untuk perencanaan program penanganan stunting

## 🏗️ Bagaimana Program Ini Dibuat?

### **Framework Laravel - "Rumah" Program**
Laravel adalah seperti **"rumah"** yang sudah jadi untuk membuat program web. Kita tidak perlu membuat dari nol, tinggal pakai yang sudah ada.

**File penting**: `composer.json` (berisi daftar bahan-bahan yang dibutuhkan)

### **Database MySQL - "Gudang Data"**
MySQL adalah seperti **"gudang"** tempat menyimpan semua data. Data wilayah, data stunting, data user, semuanya disimpan di sini.

**File penting**: 
- `.env` (berisi alamat gudang dan kunci masuk)
- `database/migrations/` (berisi denah gudang)

### **Frontend Tailwind CSS - "Tampilan Cantik"**
Tailwind CSS adalah seperti **"cat dan dekorasi"** untuk membuat tampilan program terlihat bagus dan mudah digunakan.

**File penting**: 
- `tailwind.config.js` (aturan dekorasi)
- `resources/css/` (file CSS)

## 📁 Struktur File Program (Seperti Denah Rumah)

```
luckniteshoots/                    ← Ini adalah "rumah" utama program
├── app/                          ← Ini adalah "ruang kerja" utama
│   ├── Http/Controllers/         ← Ini adalah "otak" program
│   │   ├── AuthController.php    ← Mengatur login, register, logout
│   │   ├── FuzzyTimeSeriesController.php ← Mengatur perhitungan FTS
│   │   ├── StuntingController.php ← Mengatur data stunting
│   │   ├── WilayahController.php ← Mengatur data wilayah
│   │   └── PublicController.php  ← Mengatur halaman publik
│   ├── Models/                   ← Ini adalah "cetakan" data
│   │   ├── User.php             ← Model untuk data user
│   │   ├── Stunting.php         ← Model untuk data stunting
│   │   └── Wilayah.php          ← Model untuk data wilayah
│   └── Services/                 ← Ini adalah "rumah" untuk logika rumit
│       └── FuzzyTimeSeriesService.php ← Rumus-rumus FTS
├── database/                     ← Ini adalah "gudang data"
│   ├── migrations/              ← Denah gudang
│   └── seeders/                 ← Data awal yang sudah disiapkan
├── resources/                    ← Ini adalah "bahan tampilan"
│   └── views/                   ← Template halaman (seperti stensil)
├── routes/                       ← Ini adalah "peta jalan" program
│   └── web.php                  ← Semua alamat halaman program
├── public/                       ← Ini adalah "halaman depan" yang dilihat user
├── .env                         ← File konfigurasi (alamat gudang, kunci, dll)
├── composer.json                ← Daftar bahan-bahan PHP yang dibutuhkan
└── package.json                 ← Daftar bahan-bahan JavaScript yang dibutuhkan
```

## 🔧 Cara Install Program (Step by Step)

### **Langkah 1: Siapkan Komputer**
Pastikan komputer Anda sudah punya:
- **PHP 8.2+** (seperti "mesin" untuk menjalankan program)
- **Composer** (seperti "tukang" yang menginstall bahan-bahan)
- **MySQL** (seperti "gudang" untuk menyimpan data)
- **Node.js & NPM** (seperti "tukang" untuk mengatur tampilan)

### **Langkah 2: Download Program**
```bash
# Buka Command Prompt atau Terminal
# Ketik perintah ini untuk download program
git clone <alamat-repository>
cd luckniteshoots
```

### **Langkah 3: Install Bahan-bahan**
```bash
# Install bahan-bahan PHP
composer install

# Install bahan-bahan JavaScript
npm install
```

### **Langkah 4: Setup Gudang Data**
```bash
# Copy file konfigurasi
cp .env.example .env

# Buat kunci rahasia program
php artisan key:generate
```

### **Langkah 5: Atur Gudang Data**
Buka file `.env` dengan notepad atau editor lain, lalu ubah bagian ini:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1          ← Alamat gudang (biasanya localhost)
DB_PORT=3306                ← Pintu masuk gudang
DB_DATABASE=fts_stunting    ← Nama gudang
DB_USERNAME=root            ← Nama pemilik gudang
DB_PASSWORD=                ← Password gudang (kosong jika tidak ada)
```

### **Langkah 6: Buat Gudang dan Isi Data Awal**
```bash
# Buat gudang sesuai denah
php artisan migrate

# Isi data awal yang sudah disiapkan
php artisan db:seed
```

### **Langkah 7: Siapkan Tampilan**
```bash
# Compile file CSS dan JavaScript
npm run dev
```

### **Langkah 8: Jalankan Program**
```bash
# Jalankan server program
php artisan serve
```

Sekarang buka browser dan ketik: `http://localhost:8000`

## 🔐 Cara Kerja Login (Contoh Detail)

### **1. User Klik Tombol Login**
User membuka halaman `/login` di browser

### **2. Browser Kirim Request ke Server**
```
Browser → Server: "Halo, saya mau login"
URL: http://localhost:8000/login
Method: GET
```

### **3. Server Terima Request**
File `routes/web.php` mengarahkan request ke `AuthController@showLogin`

### **4. Controller Kerja**
File `app/Http/Controllers/AuthController.php`:
```php
public function showLogin()
{
    // Tampilkan halaman login
    return view('auth.login');
}
```

### **5. View Ditampilkan**
File `resources/views/auth/login.blade.php` ditampilkan ke user

### **6. User Isi Form dan Submit**
User isi email dan password, lalu klik tombol "Login"

### **7. Browser Kirim Data Login**
```
Browser → Server: "Ini email dan password saya"
URL: http://localhost:8000/login
Method: POST
Data: email=user@example.com, password=123456
```

### **8. Controller Proses Login**
File `app/Http/Controllers/AuthController.php`:
```php
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}
```

### **9. Cek Database**
Controller mengecek apakah email dan password ada di database:
- Tabel: `users`
- Kolom: `email`, `password`

### **10. Hasil Login**
- **Berhasil**: User diarahkan ke `/dashboard`
- **Gagal**: User kembali ke halaman login dengan pesan error

## 📊 Cara Kerja Simpan Data Wilayah

### **1. User Klik "Tambah Wilayah"**
User buka halaman `/wilayah/create`

### **2. Form Ditampilkan**
File `resources/views/wilayah/create.blade.php` ditampilkan

### **3. User Isi Form**
User isi:
- Provinsi: Sumatera Utara
- Kabupaten: Medan
- Nama Wilayah: Medan Kota
- Status Aktif: ✓ (centang)

### **4. User Klik "Simpan"**
Browser kirim data ke server:
```
URL: http://localhost:8000/wilayah
Method: POST
Data: Provinsi=Sumatera Utara, Kabupaten=Medan, nama_wilayah=Medan Kota, status_aktif=1
```

### **5. Controller Terima Data**
File `app/Http/Controllers/WilayahController.php`:
```php
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'Provinsi' => 'required|string|max:100',
        'Kabupaten' => 'required|string|max:100',
        'nama_wilayah' => 'nullable|string|max:255',
        'status_aktif' => 'boolean'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    try {
        $wilayah = new Wilayah();
        $wilayah->Provinsi = $request->Provinsi;
        $wilayah->Kabupaten = $request->Kabupaten;
        $wilayah->nama_wilayah = $request->nama_wilayah ?: $request->Provinsi . ' - ' . $request->Kabupaten;
        $wilayah->status_aktif = $request->has('status_aktif');
        $wilayah->save();

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}
```

### **6. Data Disimpan ke Database**
Data masuk ke tabel `wilayahs`:
```
ID_Wilayah: 1
Provinsi: Sumatera Utara
Kabupaten: Medan
nama_wilayah: Medan Kota
status_aktif: 1
created_at: 2024-01-15 10:30:00
updated_at: 2024-01-15 10:30:00
```

### **7. User Diarahkan ke Halaman Daftar**
User melihat halaman `/wilayah` dengan pesan "Wilayah berhasil ditambahkan"

## 🧮 Cara Kerja Perhitungan FTS

### **1. User Pilih Wilayah dan Klik "Hitung FTS"**
User buka halaman `/fuzzy-time-series`, pilih wilayah "Medan Kota", klik "Hitung FTS"

### **2. Controller Terima Request**
File `app/Http/Controllers/FuzzyTimeSeriesController.php`:
```php
public function calculate(Request $request)
{
    $request->validate([
        'wilayah_id' => 'nullable|exists:wilayahs,ID_Wilayah',
        'tahun_awal' => 'nullable|integer|min:2000|max:2030',
        'tahun_akhir' => 'nullable|integer|min:2000|max:2030',
        'tahun_perkiraan' => 'nullable|integer|min:2000|max:2030',
    ]);

    $wilayahId = $request->input('wilayah_id');
    $tahunAwal = $request->input('tahun_awal');
    $tahunAkhir = $request->input('tahun_akhir');
    $tahunPerkiraan = $request->input('tahun_perkiraan', date('Y') + 1);

    // Set tahun prediksi di service
    $this->ftsService->setPredictionYear($tahunPerkiraan);

    // Jalankan perhitungan FTS menggunakan service
    $this->ftsService->getStuntingData($wilayahId, $tahunAwal, $tahunAkhir);
    
    // Gunakan method defuzzification
    $results = $this->ftsService->defuzzification();

    if (empty($results)) {
        return redirect()->back()
            ->withErrors(['message' => 'Tidak ada data stunting yang ditemukan dengan filter yang diberikan.']);
    }

    return view('fuzzy-time-series.result', compact('results', 'wilayahId', 'tahunAwal', 'tahunAkhir', 'tahunPerkiraan'));
}
```

### **3. Service FTS Kerja**
File `app/Services/FuzzyTimeSeriesService.php`:
```php
public function calculate($data)
{
    // Langkah 1: Tentukan Universe of Discourse (UoD)
    $min = $data->min('jumlah_stunting');
    $max = $data->max('jumlah_stunting');
    $uod = $this->calculateUoD($min, $max);

    // Langkah 2: Fuzzification (ubah data ke fuzzy sets)
    $fuzzySets = $this->fuzzification($data, $uod);

    // Langkah 3: Buat fuzzy logic groups
    $fuzzyGroups = $this->createFuzzyGroups($fuzzySets);

    // Langkah 4: Buat fuzzy relationships
    $relationships = $this->createRelationships($fuzzyGroups);

    // Langkah 5: Defuzzification (hitung prediksi)
    $prediction = $this->defuzzification($relationships);

    return [
        'data_asli' => $data,
        'uod' => $uod,
        'fuzzy_sets' => $fuzzySets,
        'prediksi' => $prediction
    ];
}
```

### **4. Hasil Ditampilkan**
File `resources/views/fuzzy-time-series/result.blade.php` menampilkan:
- Data asli stunting
- Perhitungan UoD
- Fuzzy sets
- Hasil prediksi

## 🗂️ Penjelasan File-File Penting

### **File Controller (Otak Program)**

#### **AuthController.php** - `app/Http/Controllers/AuthController.php`
**Fungsi**: Mengatur semua hal tentang login, register, dan logout
**Isi**:
- `showLogin()` - Tampilkan halaman login
- `login()` - Proses login user
- `showRegister()` - Tampilkan halaman register
- `register()` - Proses register user baru
- `logout()` - Proses logout user
- `dashboard()` - Tampilkan dashboard user

#### **WilayahController.php** - `app/Http/Controllers/WilayahController.php`
**Fungsi**: Mengatur semua hal tentang data wilayah
**Isi**:
- `index()` - Tampilkan daftar semua wilayah dengan pagination dan search
- `create()` - Tampilkan form tambah wilayah
- `store()` - Simpan wilayah baru ke database
- `show()` - Tampilkan detail wilayah dengan data stunting terkait
- `edit()` - Tampilkan form edit wilayah
- `update()` - Update data wilayah
- `destroy()` - Hapus wilayah

#### **StuntingController.php** - `app/Http/Controllers/StuntingController.php`
**Fungsi**: Mengatur semua hal tentang data stunting
**Isi**:
- `index()` - Tampilkan daftar data stunting dengan filter dan pagination
- `create()` - Tampilkan form tambah data stunting
- `store()` - Simpan data stunting baru dengan validasi duplikasi
- `show()` - Tampilkan detail data stunting
- `edit()` - Tampilkan form edit data stunting
- `update()` - Update data stunting
- `destroy()` - Hapus data stunting

#### **FuzzyTimeSeriesController.php** - `app/Http/Controllers/FuzzyTimeSeriesController.php`
**Fungsi**: Mengatur semua hal tentang perhitungan FTS
**Isi**:
- `index()` - Tampilkan halaman utama FTS dengan pilihan wilayah
- `calculate()` - Hitung FTS untuk wilayah tertentu
- `calculateAllWilayah()` - Hitung FTS untuk semua wilayah
- `data()` - Tampilkan data stunting untuk analisis
- `result()` - Tampilkan hasil perhitungan

### **File Model (Cetakan Data)**

#### **User.php** - `app/Models/User.php`
**Fungsi**: Model untuk data user (pengguna program)
**Isi**:
- `$fillable` - Kolom apa saja yang bisa diisi
- `$hidden` - Kolom apa saja yang tidak ditampilkan
- Relasi dengan tabel lain

#### **Wilayah.php** - `app/Models/Wilayah.php`
**Fungsi**: Model untuk data wilayah
**Isi**:
- `$fillable` - Kolom yang bisa diisi
- `stuntings()` - Relasi dengan data stunting
- `$casts` - Tipe data kolom

#### **Stunting.php** - `app/Models/Stunting.php`
**Fungsi**: Model untuk data stunting
**Isi**:
- `$fillable` - Kolom yang bisa diisi
- `wilayah()` - Relasi dengan data wilayah
- `$casts` - Tipe data kolom

### **File Service (Rumus-Rumus)**

#### **FuzzyTimeSeriesService.php** - `app/Services/FuzzyTimeSeriesService.php`
**Fungsi**: Berisi semua rumus dan logika perhitungan FTS
**Isi**:
- `setPredictionYear()` - Set tahun untuk prediksi
- `getStuntingData()` - Ambil data stunting sesuai filter
- `defuzzification()` - Hitung prediksi akhir menggunakan algoritma FTS

### **File Routes (Peta Jalan)**

#### **web.php** - `routes/web.php`
**Fungsi**: Berisi semua alamat halaman program
**Contoh isi**:
```php
// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Halaman wilayah
Route::resource('wilayah', WilayahController::class);

// Halaman stunting
Route::resource('stunting', StuntingController::class)->parameters([
    'stunting' => 'id_stunting'
]);

// Halaman FTS
Route::get('/fuzzy-time-series', [FuzzyTimeSeriesController::class, 'index']);
Route::post('/fuzzy-time-series/calculate', [FuzzyTimeSeriesController::class, 'calculate']);
Route::post('/fuzzy-time-series/calculate-all', [FuzzyTimeSeriesController::class, 'calculateAllWilayah']);
```

### **File View (Template Halaman)**

#### **login.blade.php** - `resources/views/auth/login.blade.php`
**Fungsi**: Template untuk halaman login
**Isi**: HTML + Tailwind CSS untuk form login

#### **wilayah/index.blade.php** - `resources/views/wilayah/index.blade.php`
**Fungsi**: Template untuk halaman daftar wilayah
**Isi**: Tabel daftar wilayah dengan search, pagination, dan tombol tambah, edit, hapus

#### **stunting/create.blade.php** - `resources/views/stunting/create.blade.php`
**Fungsi**: Template untuk form tambah data stunting
**Isi**: Form input untuk data stunting dengan dropdown pilihan wilayah

#### **fuzzy-time-series/index.blade.php** - `resources/views/fuzzy-time-series/index.blade.php`
**Fungsi**: Template untuk halaman utama FTS
**Isi**: Form pilihan wilayah dan parameter untuk perhitungan FTS

## 🔍 Cara Debug (Troubleshooting)

### **Program Tidak Bisa Dibuka**
1. **Cek apakah server jalan**:
   ```bash
   php artisan serve
   ```
   Pastikan ada pesan "Server running on http://localhost:8000"

2. **Cek file .env**:
   Pastikan file `.env` ada dan berisi konfigurasi yang benar

3. **Cek database**:
   Pastikan MySQL jalan dan database `fts_stunting` sudah dibuat

### **Error "Class not found"**
1. **Install ulang dependencies**:
   ```bash
   composer install
   ```

2. **Clear cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

### **Halaman Kosong atau Error**
1. **Cek log error**:
   File `storage/logs/laravel.log`

2. **Cek apakah database ada data**:
   ```bash
   php artisan tinker
   >>> App\Models\Wilayah::count();
   >>> App\Models\Stunting::count();
   ```

## 📚 Istilah-Istilah Programming yang Perlu Diketahui

### **Backend vs Frontend**
- **Backend**: Bagian program yang tidak terlihat (database, logika)
- **Frontend**: Bagian program yang terlihat (halaman web, tombol)

### **Controller**
Seperti "otak" yang mengatur apa yang harus dilakukan program

### **Model**
Seperti "cetakan" untuk data yang disimpan di database

### **View**
Seperti "template" atau "stensil" untuk tampilan halaman

### **Route**
Seperti "alamat" atau "peta jalan" untuk mengarahkan user ke halaman yang benar

### **Migration**
Seperti "denah" untuk membuat struktur database

### **Seeder**
Seperti "data awal" yang sudah disiapkan untuk testing

### **Middleware**
Seperti "penjaga" yang memeriksa apakah user boleh masuk ke halaman tertentu

## 🎯 Kesimpulan

Program ini adalah aplikasi web yang dibuat dengan:
1. **Laravel** sebagai framework utama
2. **MySQL** sebagai database
3. **Tailwind CSS** untuk tampilan
4. **Fuzzy Time Series** untuk perhitungan prediksi

Program ini membantu BKKBN SUMUT untuk:
1. **Menyimpan** data wilayah dan stunting
2. **Menganalisis** pola data stunting
3. **Memprediksi** kemungkinan stunting di masa depan
4. **Membuat laporan** untuk perencanaan program

Untuk menjalankan program:
1. Install semua bahan yang dibutuhkan
2. Setup database
3. Jalankan `php artisan serve`
4. Buka browser ke `http://localhost:8000`

---

**Note**: Program ini dibuat untuk keperluan akademis dan implementasi metode Fuzzy Time Series dalam konteks kesehatan masyarakat. Jika ada pertanyaan atau masalah, bisa dicek di file log atau hubungi developer.
