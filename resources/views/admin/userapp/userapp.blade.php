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
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">User App</a>
    </div>
</li>
@endsection

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <div class="">
        <h1 class="text-xl font-semibold mb-4">List User App</h1>
        <a href="{{ route('admin.userapp.create') }}" class="btn-orange mb-4 inline-block">Add New User App</a>
        <table class="w-full text-sm text-left text-gray-500 border">
            <thead class="text-xs text-gray-700 bg-gray-50 border">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">NIK</th>
            <th scope="col" class="px-6 py-3">Nama</th>
            <th scope="col" class="px-6 py-3">Tempat Lahir</th>
            <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
            <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
            <th scope="col" class="px-6 py-3">Alamat KTP</th>
            <th scope="col" class="px-6 py-3">Nomor HP</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">PIN</th>
            <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userapp as $userapp)
                <tr class="bg-white border-b hover:bg-gray-100">
                <td class="px-6 py-4">{{ $userapp->id }}</td>
                <td class="px-6 py-4">{{ $userapp->nik }}</td>
                <td class="px-6 py-4">{{ $userapp->nama }}</td>
                <td class="px-6 py-4">{{ $userapp->tempat_lahir }}</td>
                <td class="px-6 py-4">{{ $userapp->tanggal_lahir }}</td>
                <td class="px-6 py-4">{{ $userapp->jenis_kelamin == 'Pria' ? 'Pria' : 'Wanita' }}</td>
                <td class="px-6 py-4">{{ $userapp->alamat_ktp }}</td>
                <td class="px-6 py-4">{{ $userapp->nomor_hp }}</td>
                <td class="px-6 py-4">{{ $userapp->email }}</td>
                <td class="px-6 py-4">{{ $userapp->pin }}</td>
                  
                    <td class="px-6 py-4">
                    <a href="{{ route('admin.userapp.edit', $userapp->id) }}" class="text-blue-500 hover:underline">Edit</a>

                        <form action="{{ route('admin.userapp.destroy', $userapp->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
