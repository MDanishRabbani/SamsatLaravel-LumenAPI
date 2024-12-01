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
        <a href="{{ route('admin.samsat') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Samsat</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Edit Samsat</a>
    </div>
</li>
@endsection

@section('content')
<div class="container mx-auto mt-6 p-4 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Edit Samsat</h2>
    <form action="{{ route('admin.samsat.update', $samsat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Samsat -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" 
                   value="{{ old('name', $samsat->name) }}"
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea id="address" name="address" rows="3" 
                      class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>{{ old('address', $samsat->address) }}</textarea>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude (default)</label>
                <input type="number" step="any" name="latitude" id="latitude" 
                       value="{{ old('latitude', $samsat->latitude) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude (default)</label>
                <input type="number" step="any" name="longitude" id="longitude" 
                       value="{{ old('longitude', $samsat->longitude) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
        </div>

        <!-- Kota -->
<div class="mb-4">
    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
    <select id="city" name="city" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
        @php
            $cities = [
                'KAB. ACEH BARAT',
                'KAB. ACEH BARAT DAYA',
                'KAB. ACEH BESAR',
                'KAB. ACEH JAYA',
                'KAB. ACEH SELATAN',
                'KAB. ACEH SINGKIL',
                'KAB. ACEH TAMIANG',
                'KAB. ACEH TENGAH',
                'KAB. ACEH TENGGARA',
                'KAB. ACEH TIMUR',
                'KAB. ACEH UTARA',
                'KAB. BENER MERIAH',
                'KAB. BIREUEN',
                'KAB. GAYO LUES',
                'KAB. NAGAN RAYA',
                'KAB. PIDIE',
                'KAB. PIDIE JAYA',
                'KAB. SIMEULUE',
                'KOTA BANDA ACEH',
                'KOTA LHOKSEUMAWE',
                'KOTA LANGSA',
                'KOTA SABANG',
                'KOTA SUBULUSSALAM'
            ];
        @endphp
        @foreach($cities as $city)
            <option value="{{ $city }}" {{ old('city', $samsat->city) === $city ? 'selected' : '' }}>
                {{ $city }}
            </option>
        @endforeach
    </select>
</div>


        <!-- Tipe -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select id="type" name="type" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="statis" {{ old('type', $samsat->type) === 'statis' ? 'selected' : '' }}>Statis</option>
                <option value="dinamis" {{ old('type', $samsat->type) === 'dinamis' ? 'selected' : '' }}>Dinamis</option>
            </select>
        </div>

        <!-- Aktif -->
        <div class="mb-4">
            <label for="is_active" class="block text-sm font-medium text-gray-700">Active</label>
            <select id="is_active" name="is_active" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="1" {{ old('is_active', $samsat->is_active) === 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_active', $samsat->is_active) === 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.samsat') }}" class="ml-4 text-blue-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
