<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rafi Fathan Gandari - C2383207002">
    <title>@yield('title', 'Rafi Blog - Modern Blog Platform')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#8b5cf6',
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        
        /* Custom Scrollbar Dark */
        .dark ::-webkit-scrollbar {
            width: 8px;
        }
        .dark ::-webkit-scrollbar-track {
            background: #1f2937;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #6366f1;
            border-radius: 4px;
        }
        
        /* Custom Scrollbar Light */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f3f4f6;
        }
        ::-webkit-scrollbar-thumb {
            background: #6366f1;
            border-radius: 4px;
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
        }
        
        /* Fade In Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
    
    <!-- Load Theme Sebelum Page Render (No Flash) -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
    
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 backdrop-blur-lg bg-white/80 dark:bg-gray-900/80 border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="text-xl font-bold text-white">R</span>
                    </div>
                    <span class="text-xl font-bold gradient-text">Rafi Blog</span>
                </a>
                
                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                        Home
                    </a>
                    
                    <!-- Theme Toggle -->
                    <button 
                        onclick="toggleTheme()" 
                        id="theme-toggle"
                        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all" 
                        title="Toggle Theme"
                        aria-label="Toggle Theme"
                    >
                        <!-- Sun Icon (Tampil di Dark Mode) -->
                        <svg id="theme-icon-sun" class="w-5 h-5 text-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                        </svg>
                        <!-- Moon Icon (Tampil di Light Mode) -->
                        <svg id="theme-icon-moon" class="w-5 h-5 text-indigo-600 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>
                    
                    <!-- Admin Link -->
                    <a href="{{ route('admin.login') }}" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition-all hover:scale-105">
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <span class="text-xl font-bold text-white">R</span>
                        </div>
                        <span class="text-xl font-bold gradient-text">Rafi Blog</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Platform blog modern untuk berbagi pengetahuan dan inspirasi.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Admin Panel</a></li>
                    </ul>
                </div>
                
                <!-- Student Info -->
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Developer</h3>
                    <ul class="space-y-1 text-gray-600 dark:text-gray-400 text-sm">
                        <li>Rafi Fathan Gandari</li>
                        <li>NIM: C2383207002</li>
                        <li>Kelas: PTI 5A</li>
                    </ul>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-200 dark:border-gray-800 mt-8 pt-8 text-center text-gray-600 dark:text-gray-400 text-sm">
                <p>&copy; 2026 — Rafi Fathan Gandari | C2383207002 | PTI 5A</p>
            </div>
        </div>
    </footer>
    
    <!-- Theme Toggle Script -->
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
            
            if (currentTheme === 'dark') {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
</body>
</html>