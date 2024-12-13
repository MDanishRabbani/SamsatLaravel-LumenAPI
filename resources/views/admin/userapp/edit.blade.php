@extends('layouts.admin')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="/{{ Auth::user()->role }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="{{ route('admin.admin') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Admin</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Edit Admin</a>
    </div>
</li>
@endsection

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <div class="">
        <h1 class="text-xl font-semibold mb-4">Edit User App</h1>
        <form action="{{ route('admin.userapp.update', $userapp->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NIK Field -->
            <div class="mb-4">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik', $userapp->nik) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Nama Field -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $userapp->nama) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Tempat Lahir Field -->
            <div class="mb-4">
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $userapp->tempat_lahir) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Tanggal Lahir Field -->
            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $userapp->tanggal_lahir) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Jenis Kelamin Field -->
            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
                    <option value="Pria" {{ old('jenis_kelamin', $userapp->jenis_kelamin) == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ old('jenis_kelamin', $userapp->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
            </div>

            <!-- Alamat KTP Field -->
            <div class="mb-4">
                <label for="alamat_ktp" class="block text-sm font-medium text-gray-700">Alamat KTP</label>
                <input type="text" name="alamat_ktp" id="alamat_ktp" value="{{ old('alamat_ktp', $userapp->alamat_ktp) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Nomor HP Field -->
            <div class="mb-4">
                <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp', $userapp->nomor_hp) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Email Field -->
            <div class="mb-4">
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email', $userapp->email) }}" 
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed" 
        readonly required>
</div>


            <!-- Pin Field -->
            <div class="mb-4">
                <label for="pin" class="block text-sm font-medium text-gray-700">PIN</label>
                <input type="text" name="pin" id="pin" value="{{ old('pin', $userapp->pin) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">Update User App</button>
        </form>
    </div>
</div>
@endsection
