<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FTS - Fuzzy Time Series')</title>
    <meta name="description" content="@yield('description', 'Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT')">
    <meta name="author" content="Liza">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 300;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .filter-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .filter-section h3 {
            margin: 0 0 20px 0;
            color: #374151;
            font-size: 1.3rem;
        }
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }
        .form-group select,
        .form-group input {
            padding: 10px 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        .form-group select:focus,
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        .filter-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .results-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        .section-header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 20px 25px;
            margin: 0;
        }
        .section-content {
            padding: 25px;
        }
        .table-container {
            overflow-x: auto;
        }
        .table-auto {
            width: 100%;
            border-collapse: collapse;
        }
        .table-auto th {
            background-color: #f3f4f6;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        .table-auto td {
            padding: 15px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .table-auto tbody tr:hover {
            background-color: #f9fafb;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-up {
            background-color: #10b981;
            color: white;
        }
        .status-down {
            background-color: #ef4444;
            color: white;
        }
        .type-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .type-validation {
            background-color: #3b82f6;
            color: white;
        }
        .type-prediction {
            background-color: #f59e0b;
            color: white;
        }
        .chart-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        .chart-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 20px 25px;
            margin: 0;
        }
        .chart-content {
            padding: 25px;
        }
        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .info-box h6 {
            margin: 0 0 15px 0;
            color: #1e40af;
            font-size: 1.1rem;
        }
        .info-box ul {
            margin: 0;
            padding-left: 20px;
        }
        .info-box li {
            margin-bottom: 8px;
            color: #1e40af;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        .empty-state h3 {
            margin: 0 0 10px 0;
            font-size: 1.5rem;
        }
        .empty-state p {
            margin: 0;
            font-size: 1.1rem;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('additional_css')
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <!-- Unified Header with Contact Info and Navigation -->
        <header class="bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg sticky top-0 z-50">
            <!-- Top section with contact info and social media -->
            <div class="border-b border-green-500/30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="flex flex-wrap items-center gap-4 mb-2 md:mb-0">
                            <a href="{{ route('home') }}" class="flex items-center gap-2 hover:text-green-200 transition-colors text-sm">
                                <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-chart-line text-xs"></i>
                                </div>
                                <span>Fuzzy Time Series</span>
                            </a>
                            <a href="mailto:email@gmail.com" class="flex items-center gap-2 hover:text-green-200 transition-colors text-sm">
                                <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-xs"></i>
                                </div>
                                <span>Liza@gmail.com</span>
                            </a>
                            <a href="tel:+6281234567890" class="flex items-center gap-2 hover:text-green-200 transition-colors text-sm">
                                <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-phone text-xs"></i>
                                </div>
                                <span>+62 812-3456-7890</span>
                            </a>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex gap-2">
                                <a href="#" class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                                    <i class="fab fa-facebook-f text-xs"></i>
                                </a>
                                <a href="#" class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                                    <i class="fab fa-twitter text-xs"></i>
                                </a>
                                <a href="#" class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-green-600 transition-all">
                                    <i class="fab fa-linkedin-in text-xs"></i>
                                </a>
                            </div>
                            <div class="flex items-center space-x-3">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="bg-white/20 hover:bg-white hover:text-green-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        Dashboard
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-white/90 hover:text-white px-3 py-1 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                            Logout
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="text-white/90 hover:text-white px-3 py-1 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        Login
                                    </a>
                                    <!-- <a href="{{ route('register') }}" class="bg-white/20 hover:bg-white hover:text-green-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        Register
                                    </a> -->
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        @yield('content')

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
                        Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT
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
                            <li><a href="{{ route('umum.results') }}" class="text-green-100 hover:text-white transition-colors">Hasil Publik</a></li>
                            <li><a href="{{ route('umum.stunting-data') }}" class="text-green-100 hover:text-white transition-colors">Data Stunting</a></li>
                            <li><a href="{{ route('umum.wilayah-data') }}" class="text-green-100 hover:text-white transition-colors">Data Wilayah</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <div class="space-y-2">
                            <div class="flex items-center text-green-100">
                                <i class="fas fa-envelope w-5 text-yellow-300"></i>
                                <span>Liza@gmail.com</span>
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
        @yield('additional_js')
    </body>
</html>
