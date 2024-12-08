@extends('layouts.admin')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
        <a href="/{{ Auth::user()->role }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
        <a href="{{ route('admin.userapp.create') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">UserApp</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Create New UserApp</a>
    </div>
</li>
@endsection

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <div class="mb-4">
        <h1 class="text-xl font-semibold mb-4">Create New User App</h1>
        <form action="{{ route('admin.userapp.store') }}" method="POST">
            @csrf

            <!-- NIK -->
            <div class="mb-4">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" name="nik" id="nik" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nik') border-red-500 @enderror" value="{{ old('nik') }}" required>
                @error('nik')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama') border-red-500 @enderror" value="{{ old('nama') }}" required>
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Place of Birth -->
            <div class="mb-4">
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('tempat_lahir') border-red-500 @enderror" value="{{ old('tempat_lahir') }}" required>
                @error('tempat_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('tanggal_lahir') border-red-500 @enderror" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('jenis_kelamin') border-red-500 @enderror" required>
                    <option value="">Jenis Kelamin</option>
                    <option value="Pria" {{ old('jenis_kelamin') == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
                @error('jenis_kelamin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="alamat_ktp" class="block text-sm font-medium text-gray-700">Alamat (KTP)</label>
                <textarea name="alamat_ktp" id="alamat_ktp" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('alamat_ktp') border-red-500 @enderror" required>{{ old('alamat_ktp') }}</textarea>
                @error('alamat_ktp')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" name="nomor_hp" id="nomor_hp" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nomor_hp') border-red-500 @enderror" value="{{ old('nomor_hp') }}" required>
                @error('nomor_hp')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PIN -->
            <div class="mb-4">
                <label for="pin" class="block text-sm font-medium text-gray-700">PIN</label>
                <input type="text" name="pin" id="pin" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('pin') border-red-500 @enderror" value="{{ old('pin') }}" required>
                @error('pin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
