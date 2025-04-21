<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLINPLUSS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="app-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1 class="sidebar-title">KLINPLUSS</h1>
            </div>
            
            <nav class="sidebar-nav">
                <!-- Dashboard Section -->
                <div class="sidebar-section">
                    <h2 class="sidebar-section-title">DASHBOARD</h2>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                                <span class="menu-icon">🏠</span> Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- LAPORAN Section -->
                <div class="sidebar-section">
                    <h2 class="sidebar-section-title">LAPORAN</h2>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('order') }}" class="{{ request()->routeIs('order') ? 'active' : '' }}">
                                <span class="menu-icon">🛒</span> Order
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a href="{{ route('jadwal') }}" class="{{ request()->routeIs('jadwal') ? 'active' : '' }}">
                                <span class="menu-icon">🗓️</span> Jadwal
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a href="{{ route('pembayaran') }}" class="{{ request()->routeIs('order-selesai') ? 'active' : '' }}">
                                <span class="menu-icon">✅</span> Pembayaran
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('layanan-selesai') ? 'active' : '' }}">
                                <span class="menu-icon">🔁</span> Riwayat
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- MASTER DATA Section -->
                <div class="sidebar-section">
                    <h2 class="sidebar-section-title">MASTER DATA</h2>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                                <span class="menu-icon">👤</span> Pelanggan
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a href="#" class="{{ request()->routeIs('petugas.*') ? 'active' : '' }}">
                                <span class="menu-icon">🛠️</span> Petugas
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a href="#" class="{{ request()->routeIs('layanan.*') ? 'active' : '' }}">
                                <span class="menu-icon">🧾</span> Layanan
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Logout -->
                <div class="sidebar-logout">
                    <a href="#" class="logout-link">
                        <span class="menu-icon">🚪</span> Logout
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <!-- Navbar -->
            <header class="navbar">
                <div class="navbar-profile"></div>
            </header>
            
            <!-- Content Section -->
            <section class="content-section">
                <div class="welcome-message">
                    @yield('title-content')
                </div>
                
                <div class="content-container">
                    @yield('content')
                </div>
            </section>
            
            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright © 2025 • Design By PT.Sinergi Cakra Inovasi
                </div>
                <div class="footer-right">V1.0</div>
            </footer>
        </main>
    </div>
</body>
</html>