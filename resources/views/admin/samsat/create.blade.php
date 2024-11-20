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
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a 1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="{{ route('admin.samsat') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Samsat</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Add Samsat</a>
    </div>
</li>
@endsection

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <!-- <div class="relative overflow-x-auto shadow-lg sm:rounded-xl border-gray-50 border-3"> -->
    <div class="">
        <h1 class="text-xl font-semibold mb-4">Add Samsat</h1>
        <form action="{{ route('admin.samsat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" id="address" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
            </div>

            <div class="mb-4">
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="mt-1 block w-1/2 p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="mt-1 block w-1/2 p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
    <label for="city" class="block text-sm w-1/2 font-medium text-gray-700">City</label>
    <select name="city" id="city" class="mt-1 block w-1/2 p-2 border border-gray-300 rounded-md shadow-sm" required>
    <option value="" selected disabled>Select a city</option>
    <option value="Kabupaten Aceh Selatan">Kabupaten Aceh Selatan</option>
    <option value="Kabupaten Aceh Tenggara">Kabupaten Aceh Tenggara</option>
    <option value="Kabupaten Aceh Timur">Kabupaten Aceh Timur</option>
    <option value="Kabupaten Aceh Tengah">Kabupaten Aceh Tengah</option>
    <option value="Kabupaten Aceh Barat">Kabupaten Aceh Barat</option>
    <option value="Kabupaten Aceh Besar">Kabupaten Aceh Besar</option>
    <option value="Kabupaten Pidie">Kabupaten Pidie</option>
    <option value="Kabupaten Aceh Utara">Kabupaten Aceh Utara</option>
    <option value="Kabupaten Simeulue">Kabupaten Simeulue</option>
    <option value="Kabupaten Aceh Singkil">Kabupaten Aceh Singkil</option>
    <option value="Kabupaten Bireuen">Kabupaten Bireuen</option>
    <option value="Kabupaten Aceh Barat Daya">Kabupaten Aceh Barat Daya</option>
    <option value="Kabupaten Gayo Lues">Kabupaten Gayo Lues</option>
    <option value="Kabupaten Aceh Jaya">Kabupaten Aceh Jaya</option>
    <option value="Kabupaten Nagan Raya">Kabupaten Nagan Raya</option>
    <option value="Kabupaten Aceh Tamiang">Kabupaten Aceh Tamiang</option>
    <option value="Kabupaten Bener Meriah">Kabupaten Bener Meriah</option>
    <option value="Kabupaten Pidie Jaya">Kabupaten Pidie Jaya</option>
    <option value="Kota Banda Aceh">Kota Banda Aceh</option>
    <option value="Kota Sabang">Kota Sabang</option>
    <option value="Kota Lhokseumawe">Kota Lhokseumawe</option>
    <option value="Kota Langsa">Kota Langsa</option>
    <option value="Kota Subulussalam">Kota Subulussalam</option>
</select>

<div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add Samsat
                </button>
            </div>
                </form>
    </div>
</div>
@endsection
