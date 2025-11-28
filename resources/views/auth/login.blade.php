{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row bg-gray-50 dark:bg-gray-900">
        {{-- Left Side - Image --}}
        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 150)"
            x-show="show" x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 -translate-x-10"
            x-transition:enter-end="opacity-100 translate-x-0"
            class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-blue-600 to-purple-700">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&q=80"
                alt="Modern workspace" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 flex flex-col justify-center px-16 text-white">
                <h1 class="text-5xl font-bold mb-6">Welcome Back!</h1>
                <p class="text-xl opacity-90">
                    Sign in to continue to your dashboard and manage your workspace efficiently.
                </p>
            </div>
        </div>

        {{-- Right Side - Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div x-data="{ showForm: false }" x-init="setTimeout(() => showForm = true, 300)"
                x-show="showForm"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="w-full max-w-md space-y-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-10">

                {{-- Header --}}
                <div class="text-center space-y-2">
                    <svg class="h-16 w-auto mx-auto text-indigo-600" fill="none" viewBox="0 0 80 80"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="35" fill="#3B82F6" />
                        <path d="M40 20v20l15 15" stroke="white" stroke-width="4" stroke-linecap="round" />
                    </svg>
                    <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">Sistem Pengaduan</h2>
                    <p class="text-gray-500 dark:text-gray-400">Masuk ke akun Anda</p>
                </div>

                {{-- Validation --}}
                <x-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">{{ session('status') }}</div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                        <div class="relative">
                            <x-icon.mail class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" />
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                                autocomplete="username"
                                class="pl-10 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="name@example.com" />
                        </div>
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <div x-data="{ show: false }" class="relative">
                            <x-icon.lock class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" />
                            <input id="password" name="password" :type="show ? 'text' : 'password'" required
                                autocomplete="current-password"
                                class="pl-10 pr-10 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter your password" />
                            <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <template x-if="!show">
                                    <x-icon.eye class="h-5 w-5" />
                                </template>
                                <template x-if="show">
                                    <x-icon.eye-off class="h-5 w-5" />
                                </template>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Remember Me + Forgot --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-indigo-600 hover:underline">Forgot password?</a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg focus:outline-none focus:ring focus:ring-indigo-300 transition">
                        Sign In
                    </button>
                </form>

                {{-- Divider --}}
                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white dark:bg-gray-800 px-4 text-gray-500 text-sm">Or continue with</span>
                    </div>
                </div>

                {{-- Social Buttons --}}
                <div class="grid grid-cols-2 gap-4">
                    <button type="button"
                        class="flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-md py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="mr-2 h-5 w-5" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92..." fill="#4285F4" />
                        </svg>
                        Google
                    </button>
                    <button type="button"
                        class="flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-md py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12..." />
                        </svg>
                        GitHub
                    </button>
                </div>


                {{-- Register --}}
                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
