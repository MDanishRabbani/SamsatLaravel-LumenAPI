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
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Information</a>
    </div>
</li>
@endsection

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <div class="relative overflow-x-auto shadow-lg sm:rounded-xl border-gray-50 border-3">
        <h1 class="text-xl font-semibold mb-4">List Information</h1>
        <a href="{{ route('admin.information.create') }}" class="text-blue-500 hover:underline mb-4 inline-block">Add New Information</a>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Desctiption</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($information as $info) <!-- Change variable name to avoid confusion -->
                <tr class="bg-white border-b hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $info->id }}</td>
                    <td class="px-6 py-4">{{ $info->title }}</td>
                    <td class="px-6 py-4">{{ $info->description }}</td>
                    <td class="px-6 py-4">{{ $info->date }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ env('IMAGE_STORAGE_URL') . basename($info->image_url) }}" alt="Image" class="h-16 w-16 object-cover">
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.information.edit', $info->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.information.destroy', $info->id) }}" method="POST" style="display:inline;">
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
