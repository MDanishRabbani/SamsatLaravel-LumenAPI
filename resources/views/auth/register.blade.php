@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex flex-col items-center justify-center">
           
            <!-- Form Container -->
            <div class="border border-gray-300 rounded-lg p-8 w-full max-w-lg bg-white">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <!-- Heading -->
                    <div class="text-center">
                        <h3 class="text-gray-800 text-2xl md:text-3xl mt-0 font-extrabold">Create a New Account</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mt-0">
                            Enter your details below to create a new account.
                        </p>
                    </div>

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="text-gray-800 text-sm mb-1 block">Name</label>
                        <div class="relative flex items-center">
                            <input id="name" type="text" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name">
                        </div>
                        @error('name')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="text-gray-800 text-sm mb-1 block">Email Address</label>
                        <div class="relative flex items-center">
                            <input id="email" type="email" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="text-gray-800 text-sm mb-1 block">Password</label>
                        <div class="relative flex items-center">
                            <input id="password" type="password" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div>
                        <label for="password-confirm" class="text-gray-800 text-sm mb-1 block">Confirm Password</label>
                        <div class="relative flex items-center">
                            <input id="password-confirm" type="password" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-6">
                        <button type="submit" class="w-full tracking-wide font-semibold bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <span>{{ __('Register') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
