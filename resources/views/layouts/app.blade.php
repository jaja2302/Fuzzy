<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Fuzzy Time Series') }}</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Glassmorphism sidebar */
        .sidebar-glass {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar animations */
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.5s ease;
            border-radius: 16px;
            position: relative;
            margin: 0 12px 8px 12px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transform: translateX(0) scale(1);
        }
        
        .sidebar-link:hover {
            transform: translateX(8px) scale(1.02);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            color: white;
        }
        
        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateX(8px) scale(1.05);
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -12px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: linear-gradient(180deg, #ff6b6b, #feca57);
            border-radius: 2px;
            box-shadow: 0 0 20px rgba(255, 107, 107, 0.6);
        }
        
        .sidebar-link i {
            width: 24px;
            height: 24px;
            margin-right: 16px;
            transition: all 0.5s ease;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }
        
        .sidebar-link:not(.active) i {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .sidebar-link:hover i {
            color: white;
        }
        
        .sidebar-link.active i {
            color: white;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }
        
        .sidebar-link span {
            font-size: 14px;
            font-weight: 600;
            transition: all 0.5s ease;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-link:not(.active) span {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .sidebar-link:hover span {
            color: white;
        }
        
        .sidebar-link.active span {
            color: white;
        }

        /* Logo section styling */
        .logo-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .logo-inner {
            background: rgba(255, 255, 255, 0.95);
            padding: 16px;
            border-radius: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        /* Navigation section styling */
        .nav-section {
            margin-bottom: 32px;
        }
        
        .nav-section-title {
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0 20px 16px 20px;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* User profile section */
        .user-profile {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 20px;
            margin: 0 12px 20px 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
        }
        
        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #ff6b6b, #feca57);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }
        
        /* Logout button styling */
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.5s ease;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }
        
        .logout-btn:hover {
            background: rgba(255, 107, 107, 0.2);
            border-color: rgba(255, 107, 107, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
            color: white;
        }

        /* Background gradient for sidebar */
        .sidebar-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            width: 320px;
        }

        .sidebar-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        /* Floating particles effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
                opacity: 0; 
            }
            50% { 
                transform: translateY(-20px) rotate(180deg); 
                opacity: 1; 
            }
        }
        
        /* Ensure sidebar content is properly positioned */
        .sidebar-content {
            position: relative;
            z-index: 10;
            padding: 32px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Logo text styling */
        .logo-text h1 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.025em;
            margin: 0;
            line-height: 1.2;
        }
        
        .logo-text p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            margin: 4px 0 0 0;
            line-height: 1.4;
        }
        
        /* Ensure proper spacing */
        .sidebar-nav {
            flex: 1;
            margin: 40px 0;
        }
        
        .sidebar-footer {
            margin-top: auto;
            padding-top: 32px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Enhanced Glassmorphism Sidebar -->
        <div class="sidebar-bg overflow-y-auto sidebar-scrollbar relative">
            <!-- Floating particles -->
            <div class="particles">
                <div class="particle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
                <div class="particle" style="top: 60%; left: 80%; animation-delay: 2s;"></div>
                <div class="particle" style="top: 80%; left: 20%; animation-delay: 4s;"></div>
                <div class="particle" style="top: 30%; left: 70%; animation-delay: 1s;"></div>
                <div class="particle" style="top: 70%; left: 30%; animation-delay: 3s;"></div>
            </div>
            
            <div class="sidebar-content">
                <!-- Logo Section -->
                <div class="flex items-center justify-center mb-10">
                    <div class="logo-container">
                        <div class="logo-inner">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain rounded-2xl">
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="sidebar-nav">
                    <!-- Main Navigation -->
                    <div class="nav-section">
                        <h3 class="nav-section-title">Main Menu</h3>
                        
                        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                        
                        <a href="{{ route('wilayah.index') }}" class="sidebar-link {{ request()->routeIs('wilayah.*') ? 'active' : '' }}">
                            <i class="fas fa-map-marked-alt"></i>
                            <span>Data Wilayah</span>
                        </a>
                        
                        <a href="{{ route('stunting.index') }}" class="sidebar-link {{ request()->routeIs('stunting.*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Data Stunting</span>
                        </a>
                    </div>
                    
                    <!-- Analysis Section -->
                    <div class="nav-section">
                        <h3 class="nav-section-title">Analysis</h3>
                        
                        <a href="{{ route('fuzzy-time-series.index') }}" class="sidebar-link {{ request()->routeIs('fuzzy-time-series.*') ? 'active' : '' }}">
                            <i class="fas fa-brain"></i>
                            <span>Fuzzy Time Series</span>
                        </a>
                        
                        <a href="{{ route('umum.results') }}" class="sidebar-link {{ request()->routeIs('umum.*') ? 'active' : '' }}">
                            <i class="fas fa-chart-pie"></i>
                            <span>Hasil Publik</span>
                        </a>
                    </div>
                </nav>
                
                <!-- User Profile Section -->
                <div class="sidebar-footer">
                    <div class="user-profile">
                        <div class="flex items-center mb-4">
                            <div class="user-avatar">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <p class="text-base font-bold text-white">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-sm text-white/70">Administrator</p>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Enhanced Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-100">
                <div class="flex items-center justify-between px-8 py-5">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-2xl font-bold text-gray-800">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-indigo-500 rounded-full"></div>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                        
                        <!-- User Menu -->
                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-500">Welcome back!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-auto p-8 bg-gradient-to-br from-gray-50 to-blue-50/30">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
