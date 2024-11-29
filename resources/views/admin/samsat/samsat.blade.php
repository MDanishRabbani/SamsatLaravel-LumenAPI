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
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Samsat</a>
    </div>
</li>
@endsection

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <div class="">
        <h1 class="text-xl font-semibold mb-4">List Samsat</h1>
        <a href="{{ route('admin.samsat.create') }}" class="btn-orange mb-4 inline-block">
            Add New Samsat
        </a>
        <table class="w-full text-sm text-left text-gray-500 border">
            <thead class="text-xs text-gray-700 bg-gray-50 border">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Address</th>
                    <th scope="col" class="px-6 py-3">Latitude</th>
                    <th scope="col" class="px-6 py-3">Longitude</th>
                    <th scope="col" class="px-6 py-3">City</th>
                    <th scope="col" class="px-6 py-3">Schedules</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($samsat as $samsat)
                <tr class="bg-white border-b hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $samsat->id }}</td>
                    <td class="px-6 py-4">{{ $samsat->name }}</td>
                    <td class="px-6 py-4">{{ $samsat->address }}</td>
                    <td class="px-6 py-4">{{ $samsat->latitude }}</td>
                    <td class="px-6 py-4">{{ $samsat->longitude }}</td>
                    <td class="px-6 py-4">{{ $samsat->city }}</td>
                    <td class="px-6 py-4">
                    @if (is_array($samsat->schedules) ? count($samsat->schedules) > 0 : $samsat->schedules->isNotEmpty())

                            <ul>
                                @foreach ($samsat->schedules as $schedule)
                                <li><strong>{{ $schedule->day }}</strong>: {{ $schedule->address }} ({{ $schedule->latitude }}, {{ $schedule->longitude }})</li>
                                @endforeach
                            </ul>
                        @else
                            No schedules available
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.samsat.edit', $samsat->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.samsat.destroy', $samsat->id) }}" method="POST" style="display:inline;">
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