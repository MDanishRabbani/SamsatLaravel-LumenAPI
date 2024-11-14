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
    <div class="relative overflow-x-auto shadow-lg sm:rounded-xl border-gray-50 border-3">
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
        <option value="Aceh Barat">Aceh Barat</option>
        <option value="Aceh Barat Daya">Aceh Barat Daya</option>
        <option value="Aceh Besar">Aceh Besar</option>
        <option value="Aceh Jaya">Aceh Jaya</option>
        <option value="Aceh Selatan">Aceh Selatan</option>
        <option value="Aceh Singkil">Aceh Singkil</option>
        <option value="Aceh Tamiang">Aceh Tamiang</option>
        <option value="Aceh Tengah">Aceh Tengah</option>
        <option value="Aceh Tenggara">Aceh Tenggara</option>
        <option value="Aceh Timur">Aceh Timur</option>
        <option value="Aceh Utara">Aceh Utara</option>
        <option value="Banda Aceh">Banda Aceh</option>
        <option value="Bener Meriah">Bener Meriah</option>
        <option value="Bireuen">Bireuen</option>
        <option value="Gayo Lues">Gayo Lues</option>
        <option value="Lhokseumawe">Lhokseumawe</option>
        <option value="Langsa">Langsa</option>
        <option value="Nagan Raya">Nagan Raya</option>
        <option value="Pidie">Pidie</option>
        <option value="Pidie Jaya">Pidie Jaya</option>
        <option value="Sabang">Sabang</option>
        <option value="Simeulue">Simeulue</option>
        <option value="Subulussalam">Subulussalam</option>
        <option value="Takengon">Takengon</option>
        <option value="Tapaktuan">Tapaktuan</option>
    </select>
</div>

            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">Add Samsat</button>
        </form>
    </div>
</div>
@endsection
