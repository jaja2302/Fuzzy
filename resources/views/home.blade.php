@extends('welcome')

@section('title', 'FTS - Fuzzy Time Series')
@section('description', 'Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT')

@section('content')
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
                    Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="{{ route('fuzzy-time-series.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                                <i class="fas fa-play mr-2"></i>
                                Login
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="{{ route('umum.results') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 md:py-4 md:text-lg md:px-10">
                                <i class="fas fa-chart-line mr-2"></i>
                                PERKIRAAN
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
@endsection
