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
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <div class="">
        <h1 class="text-xl font-semibold mb-4">Edit Samsat</h1>
        <form action="{{ route('admin.samsat.update', $samsat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $samsat->name) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="address" id="address" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>{{ old('address', $samsat->address) }}</textarea>
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $samsat->latitude) }}" class="mt-1 block w-1/2 p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $samsat->longitude) }}" class="mt-1 block w-1/2 p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
    <select name="city" id="city" class="mt-1 block w-1/2 p-2 border border-gray-300 rounded-md shadow-sm" required>
    <option value="" disabled>Select a city</option>
    <option value="Kabupaten Aceh Selatan" {{ old('city', $samsat->city) == 'Kabupaten Aceh Selatan' ? 'selected' : '' }}>Kabupaten Aceh Selatan</option>
    <option value="Kabupaten Aceh Tenggara" {{ old('city', $samsat->city) == 'Kabupaten Aceh Tenggara' ? 'selected' : '' }}>Kabupaten Aceh Tenggara</option>
    <option value="Kabupaten Aceh Timur" {{ old('city', $samsat->city) == 'Kabupaten Aceh Timur' ? 'selected' : '' }}>Kabupaten Aceh Timur</option>
    <option value="Kabupaten Aceh Tengah" {{ old('city', $samsat->city) == 'Kabupaten Aceh Tengah' ? 'selected' : '' }}>Kabupaten Aceh Tengah</option>
    <option value="Kabupaten Aceh Barat" {{ old('city', $samsat->city) == 'Kabupaten Aceh Barat' ? 'selected' : '' }}>Kabupaten Aceh Barat</option>
    <option value="Kabupaten Aceh Besar" {{ old('city', $samsat->city) == 'Kabupaten Aceh Besar' ? 'selected' : '' }}>Kabupaten Aceh Besar</option>
    <option value="Kabupaten Pidie" {{ old('city', $samsat->city) == 'Kabupaten Pidie' ? 'selected' : '' }}>Kabupaten Pidie</option>
    <option value="Kabupaten Aceh Utara" {{ old('city', $samsat->city) == 'Kabupaten Aceh Utara' ? 'selected' : '' }}>Kabupaten Aceh Utara</option>
    <option value="Kabupaten Simeulue" {{ old('city', $samsat->city) == 'Kabupaten Simeulue' ? 'selected' : '' }}>Kabupaten Simeulue</option>
    <option value="Kabupaten Aceh Singkil" {{ old('city', $samsat->city) == 'Kabupaten Aceh Singkil' ? 'selected' : '' }}>Kabupaten Aceh Singkil</option>
    <option value="Kabupaten Bireuen" {{ old('city', $samsat->city) == 'Kabupaten Bireuen' ? 'selected' : '' }}>Kabupaten Bireuen</option>
    <option value="Kabupaten Aceh Barat Daya" {{ old('city', $samsat->city) == 'Kabupaten Aceh Barat Daya' ? 'selected' : '' }}>Kabupaten Aceh Barat Daya</option>
    <option value="Kabupaten Gayo Lues" {{ old('city', $samsat->city) == 'Kabupaten Gayo Lues' ? 'selected' : '' }}>Kabupaten Gayo Lues</option>
    <option value="Kabupaten Aceh Jaya" {{ old('city', $samsat->city) == 'Kabupaten Aceh Jaya' ? 'selected' : '' }}>Kabupaten Aceh Jaya</option>
    <option value="Kabupaten Nagan Raya" {{ old('city', $samsat->city) == 'Kabupaten Nagan Raya' ? 'selected' : '' }}>Kabupaten Nagan Raya</option>
    <option value="Kabupaten Aceh Tamiang" {{ old('city', $samsat->city) == 'Kabupaten Aceh Tamiang' ? 'selected' : '' }}>Kabupaten Aceh Tamiang</option>
    <option value="Kabupaten Bener Meriah" {{ old('city', $samsat->city) == 'Kabupaten Bener Meriah' ? 'selected' : '' }}>Kabupaten Bener Meriah</option>
    <option value="Kabupaten Pidie Jaya" {{ old('city', $samsat->city) == 'Kabupaten Pidie Jaya' ? 'selected' : '' }}>Kabupaten Pidie Jaya</option>
    <option value="Kota Banda Aceh" {{ old('city', $samsat->city) == 'Kota Banda Aceh' ? 'selected' : '' }}>Kota Banda Aceh</option>
    <option value="Kota Sabang" {{ old('city', $samsat->city) == 'Kota Sabang' ? 'selected' : '' }}>Kota Sabang</option>
    <option value="Kota Lhokseumawe" {{ old('city', $samsat->city) == 'Kota Lhokseumawe' ? 'selected' : '' }}>Kota Lhokseumawe</option>
    <option value="Kota Langsa" {{ old('city', $samsat->city) == 'Kota Langsa' ? 'selected' : '' }}>Kota Langsa</option>
    <option value="Kota Subulussalam" {{ old('city', $samsat->city) == 'Kota Subulussalam' ? 'selected' : '' }}>Kota Subulussalam</option>
</select>

</div>


            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">Update Samsat</button>
        </form>
    </div>
</div>
@endsection
