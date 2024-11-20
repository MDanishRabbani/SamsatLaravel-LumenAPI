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
        <a href="{{ route('admin.information') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Information</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Edit Information</a>
    </div>
</li>
@endsection

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <!-- <div class="relative overflow-x-auto shadow-lg sm:rounded-xl border-gray-50 border-3 p-4"> -->
    <div class="">
        <h1 class="text-xl font-semibold mb-4">Edit Information</h1>

        <form action="{{ route('admin.information.update', $information->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="image_url" class="block text-sm font-medium text-gray-700">Current Image</label>
                
               
                @if($information->image_url)
                    <img src="{{ env('IMAGE_STORAGE_URL') . basename($information->image_url) }}" alt="Current Image" class="mb-2" style="max-width: 200px; max-height: 200px;">
                @else
                    <p class="text-gray-500">No current image available.</p>
                @endif
                
                <!-- <label for="new_image_url" class="block text-sm font-medium text-gray-700 mt-2">Upload New Image</label>
                <input type="file" name="image_url" id="image_url" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                @error('image_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror -->
            </div>

<!--            
            <div id="preview-container" class="mt-4">
               
            </div> -->

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $information->title) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>{{ old('description', $information->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">

    <label for="date" class="block text-sm font-medium text-gray-700">Date and Time</label>
    <input type="datetime-local" name="date" id="date" 
           value="{{ old('date', $information->date ? \Carbon\Carbon::parse($information->date)->format('Y-m-d\TH:i') : '') }}"
           class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
    @error('date')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>


            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">Update Information</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('new_image_url').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            // Membuat elemen gambar
            const imgElement = document.createElement('img');
            imgElement.src = reader.result; // Menggunakan hasil pembacaan
            imgElement.style.maxWidth = '200px'; // Atur lebar maksimum
            imgElement.style.maxHeight = '200px'; // Atur tinggi maksimum
            imgElement.className = 'mb-2 mt-2'; // Menambahkan margin atas
            imgElement.alt = "Preview Image"; // Menambahkan atribut alt

            // Menghapus gambar preview sebelumnya jika ada
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Hapus gambar sebelumnya
            previewContainer.appendChild(imgElement); // Tambahkan gambar baru
        };
        reader.readAsDataURL(event.target.files[0]); // Membaca file gambar
    });
</script>
@endsection
