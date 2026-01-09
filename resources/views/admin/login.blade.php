<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Rafi Blog</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8 float-animation">
            <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-4 shadow-2xl">
                <span class="text-4xl font-bold text-white">R</span>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>
            <p class="text-gray-400">Sign in to Rafi Blog Admin Panel</p>
        </div>
        
        <!-- Login Card -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-900/30 border border-green-700 rounded-lg text-green-100 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($errors->has('login'))
                <div class="mb-6 p-4 bg-red-900/30 border border-red-700 rounded-lg text-red-100 text-sm">
                    {{ $errors->first('login') }}
                </div>
            @endif
            
            @if($errors->has('access'))
                <div class="mb-6 p-4 bg-red-900/30 border border-red-700 rounded-lg text-red-100 text-sm">
                    {{ $errors->first('access') }}
                </div>
            @endif
            
            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                
                <!-- Username -->
                <div class="mb-6">
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}"
                        required
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        placeholder="Enter your username"
                    >
                    @error('username')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        placeholder="Enter your password"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-lg transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                >
                    Sign In
                </button>
            </form>
            
          
       
        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"/>
                </svg>
                Back to Home
            </a>
        </div>
        
        <!-- Footer Info -->
        <div class="mt-8 text-center text-gray-500 text-sm">
            <p>&copy; 2026 Rafi Blog - Rafi Fathan Gandari</p>
            <p class="text-xs mt-1">C2383207002 | PTI 5A</p>
        </div>
    </div>
    
</body>
</html>