@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 ">
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <!-- Logo -->
            <img src="{{ asset('images/logo2.ico') }}" 
                class="h-20 bg-white rounded-3xl mb-8" 
                alt="E-Samsat App Admin" />

            <!-- Form Container -->
            <div class="border border-gray-300 rounded-lg p-8 pt-2 w-full max-w-lg bg-white">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <!-- Heading -->
                    <div class="text-center">
    <h3 class="text-gray-800 text-2xl md:text-3xl font-extrabold mt-0 mb-2">Sign in</h3>
    <p class="text-gray-500 text-sm leading-relaxed mt-0 mb-0">
        Selamat Datang di Web Pengelolaan Admin Seudati
    </p>
</div>


                    <!-- Input Email -->
                    <div>
                        <label for="email" class="text-gray-800 text-sm mb-1 block">Email</label>
                        <div class="relative flex items-center">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') is-invalid @enderror" 
                                placeholder="Enter email address" />
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="text-gray-800 text-sm mb-1 block">Password</label>
                        <div class="relative flex items-center">
                            <input id="password" name="password" type="password" required 
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') is-invalid @enderror" 
                                placeholder="Enter password" />
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" 
                            class="form-check-input mr-2 focus:ring-blue-500" {{ old('remember') ? 'checked' : '' }} />
                        <label for="remember" class="text-sm text-gray-600">Remember Me</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full mt-4 md:mt-6 tracking-wide font-semibold bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span>Sign In</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
