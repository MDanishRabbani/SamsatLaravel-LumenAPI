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
        <option value="Aceh Barat" {{ old('city', $samsat->city) == 'Aceh Barat' ? 'selected' : '' }}>Aceh Barat</option>
        <option value="Aceh Barat Daya" {{ old('city', $samsat->city) == 'Aceh Barat Daya' ? 'selected' : '' }}>Aceh Barat Daya</option>
        <option value="Aceh Besar" {{ old('city', $samsat->city) == 'Aceh Besar' ? 'selected' : '' }}>Aceh Besar</option>
        <option value="Aceh Jaya" {{ old('city', $samsat->city) == 'Aceh Jaya' ? 'selected' : '' }}>Aceh Jaya</option>
        <option value="Aceh Selatan" {{ old('city', $samsat->city) == 'Aceh Selatan' ? 'selected' : '' }}>Aceh Selatan</option>
        <option value="Aceh Singkil" {{ old('city', $samsat->city) == 'Aceh Singkil' ? 'selected' : '' }}>Aceh Singkil</option>
        <option value="Aceh Tamiang" {{ old('city', $samsat->city) == 'Aceh Tamiang' ? 'selected' : '' }}>Aceh Tamiang</option>
        <option value="Aceh Tengah" {{ old('city', $samsat->city) == 'Aceh Tengah' ? 'selected' : '' }}>Aceh Tengah</option>
        <option value="Aceh Tenggara" {{ old('city', $samsat->city) == 'Aceh Tenggara' ? 'selected' : '' }}>Aceh Tenggara</option>
        <option value="Aceh Timur" {{ old('city', $samsat->city) == 'Aceh Timur' ? 'selected' : '' }}>Aceh Timur</option>
        <option value="Aceh Utara" {{ old('city', $samsat->city) == 'Aceh Utara' ? 'selected' : '' }}>Aceh Utara</option>
        <option value="Banda Aceh" {{ old('city', $samsat->city) == 'Banda Aceh' ? 'selected' : '' }}>Banda Aceh</option>
        <option value="Bener Meriah" {{ old('city', $samsat->city) == 'Bener Meriah' ? 'selected' : '' }}>Bener Meriah</option>
        <option value="Bireuen" {{ old('city', $samsat->city) == 'Bireuen' ? 'selected' : '' }}>Bireuen</option>
        <option value="Gayo Lues" {{ old('city', $samsat->city) == 'Gayo Lues' ? 'selected' : '' }}>Gayo Lues</option>
        <option value="Lhokseumawe" {{ old('city', $samsat->city) == 'Lhokseumawe' ? 'selected' : '' }}>Lhokseumawe</option>
        <option value="Langsa" {{ old('city', $samsat->city) == 'Langsa' ? 'selected' : '' }}>Langsa</option>
        <option value="Nagan Raya" {{ old('city', $samsat->city) == 'Nagan Raya' ? 'selected' : '' }}>Nagan Raya</option>
        <option value="Pidie" {{ old('city', $samsat->city) == 'Pidie' ? 'selected' : '' }}>Pidie</option>
        <option value="Pidie Jaya" {{ old('city', $samsat->city) == 'Pidie Jaya' ? 'selected' : '' }}>Pidie Jaya</option>
        <option value="Sabang" {{ old('city', $samsat->city) == 'Sabang' ? 'selected' : '' }}>Sabang</option>
        <option value="Simeulue" {{ old('city', $samsat->city) == 'Simeulue' ? 'selected' : '' }}>Simeulue</option>
        <option value="Subulussalam" {{ old('city', $samsat->city) == 'Subulussalam' ? 'selected' : '' }}>Subulussalam</option>
        <option value="Takengon" {{ old('city', $samsat->city) == 'Takengon' ? 'selected' : '' }}>Takengon</option>
        <option value="Tapaktuan" {{ old('city', $samsat->city) == 'Tapaktuan' ? 'selected' : '' }}>Tapaktuan</option>
        <!-- Tambahkan kota lainnya jika perlu -->
    </select>
</div>


            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">Update Samsat</button>
        </form>
    </div>
</div>
@endsection
