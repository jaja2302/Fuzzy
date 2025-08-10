<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTS - Fuzzy Time Series</title>
    <meta name="description" content="Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT">
    <meta name="author" content="Liza">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <!-- Top Header with Contact Info -->
        <header class="bg-gradient-to-r from-green-600 to-green-700 text-white py-3">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex flex-wrap items-center gap-6 mb-4 md:mb-0">
                        <a href="#" class="flex items-center gap-2 hover:text-green-200 transition-colors">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-sm"></i>
                            </div>
                            <span class="text-sm">Fuzzy Time Series</span>
                        </a>
                        <a href="mailto:email@gmail.com" class="flex items-center gap-2 hover:text-green-200 transition-colors">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-envelope text-sm"></i>
                            </div>
                            <span class="text-sm">email@gmail.com</span>
                        </a>
                        <a href="tel:+6281234567890" class="flex items-center gap-2 hover:text-green-200 transition-colors">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-phone text-sm"></i>
                            </div>
                            <span class="text-sm">+62 812-3456-7890</span>
                        </a>
                    </div>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Header with Logo and Title -->
        <section class="bg-gradient-to-br from-green-500 to-green-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="mb-8">
                    <div class="w-20 h-20 bg-white/90 rounded-2xl shadow-lg flex items-center justify-center border-2 border-green-200 mx-auto">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-2xl">
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                    Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT
                </h1>
            </div>
        </section>

        <!-- Navigation -->
        <nav class="bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                        </div>
                        <div class="ml-2 text-xl font-bold text-gray-900">Fuzzy Time Series</div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl md:text-5xl">
                                <span class="block xl:inline">Sistem Prediksi Stunting</span>
                                <span class="block text-green-600 xl:inline">Menggunakan Fuzzy Logic</span>
                            </h2>
                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Aplikasi prediksi stunting menggunakan Fuzzy Time Series untuk membantu BKKBN SUMUT dalam perencanaan program kesehatan yang lebih efektif.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="{{ route('fuzzy-time-series.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                                        <i class="fas fa-play mr-2"></i>
                                        Coba Analisis Fuzzy
                                    </a>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <a href="{{ route('public.results') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 md:py-4 md:text-lg md:px-10">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        Lihat Hasil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-green-600 font-semibold tracking-wide uppercase">Fitur</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Semua yang Anda butuhkan untuk analisis fuzzy
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        Sistem komprehensif kami menyediakan semua alat yang diperlukan untuk analisis dan prediksi fuzzy time series yang efektif.
                    </p>
                </div>

                <div class="mt-10">
                    <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                <i class="fas fa-brain text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Mesin Fuzzy Logic</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Algoritma fuzzy logic canggih untuk menangani ketidakpastian dan ketidakpresisian dalam data time series.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Analisis Time Series</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Analisis time series komprehensif dengan kemampuan visualisasi dan prediksi.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Manajemen Pengguna</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Autentikasi pengguna yang aman dan kontrol akses berbasis peran untuk data dan analisis Anda.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                <i class="fas fa-database text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Manajemen Data</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Operasi CRUD yang efisien untuk mengelola data wilayah dan stunting dengan validasi penuh.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Public Data Section -->
        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-green-600 font-semibold tracking-wide uppercase">Data Publik</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Akses wawasan tanpa registrasi
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        Jelajahi data dan hasil publik kami untuk melihat kekuatan analisis fuzzy logic dalam aksi.
                    </p>
                </div>

                <div class="mt-10">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-chart-line text-green-600 text-3xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Hasil Analisis</h3>
                                        <p class="text-sm text-gray-500">Lihat hasil fuzzy time series terbaru</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('public.results') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        Lihat Hasil
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-child text-green-600 text-3xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Data Stunting</h3>
                                        <p class="text-sm text-gray-500">Jelajahi statistik stunting publik</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('public.stunting-data') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        Lihat Data
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-green-600 text-3xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Data Regional</h3>
                                        <p class="text-sm text-gray-500">Jelajahi informasi wilayah</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('public.wilayah-data') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        Lihat Data
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-green-700">
            <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Siap untuk memulai?</span>
                    <span class="block">Mulai analisis fuzzy Anda hari ini.</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-green-200">
                    Bergabunglah dengan ribuan pengguna yang mempercayai sistem fuzzy logic kami untuk prediksi dan wawasan yang akurat.
                </p>
                <div class="mt-8 flex justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50 sm:w-auto">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-500 border border-transparent rounded-md hover:bg-green-600 sm:w-auto">
                            <i class="fas fa-user-plus mr-2"></i>
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gradient-to-br from-green-600 to-green-700 text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-heartbeat text-2xl mr-3"></i>
                            <span class="text-xl font-bold">FTS BKKBN</span>
                        </div>
                        <p class="text-green-100 mb-6">
                            Aplikasi prediksi stunting menggunakan Fuzzy Time Series untuk membantu BKKBN SUMUT dalam perencanaan program kesehatan yang lebih efektif.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('fuzzy-time-series.index') }}" class="text-green-100 hover:text-white transition-colors">Analisis Fuzzy</a></li>
                            <li><a href="{{ route('public.results') }}" class="text-green-100 hover:text-white transition-colors">Hasil Publik</a></li>
                            <li><a href="{{ route('public.stunting-data') }}" class="text-green-100 hover:text-white transition-colors">Data Stunting</a></li>
                            <li><a href="{{ route('public.wilayah-data') }}" class="text-green-100 hover:text-white transition-colors">Data Wilayah</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <div class="space-y-2">
                            <div class="flex items-center text-green-100">
                                <i class="fas fa-envelope w-5 text-yellow-300"></i>
                                <span>email@gmail.com</span>
                            </div>
                            <div class="flex items-center text-green-100">
                                <i class="fas fa-phone w-5 text-yellow-300"></i>
                                <span>+62 812-3456-7890</span>
                            </div>
                            <div class="flex items-center text-green-100">
                                <i class="fas fa-map-marker-alt w-5 text-yellow-300"></i>
                                <span>BKKBN Sumatera Utara</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-green-500">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-green-100">
                            &copy; 2025 <strong>Liza</strong> - Fuzzy Time Series Application
                        </p>
                        <p class="text-green-100 mt-2 md:mt-0">
                            Designed & Developed by <strong>UPU</strong>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button -->
        <div id="scroll-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-green-700 transition-all opacity-0 invisible hover:scale-110">
            <i class="fas fa-chevron-up"></i>
        </div>

        <script>
            // Scroll to top functionality
            document.addEventListener('DOMContentLoaded', function() {
                const scrollBtn = document.getElementById('scroll-to-top');
                
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 100) {
                        scrollBtn.style.opacity = '1';
                        scrollBtn.style.visibility = 'visible';
                    } else {
                        scrollBtn.style.opacity = '0';
                        scrollBtn.style.visibility = 'hidden';
                    }
                });
                
                scrollBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    </body>
</html>
