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
            <input type="text" id="name" name="name" value="{{ old('name', $samsat->name) }}"
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
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $samsat->latitude) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $samsat->longitude) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
        </div>
        
        <!-- Kota -->
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <select id="city" name="city" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                @foreach (['KAB. ACEH BARAT', 'KAB. ACEH BARAT DAYA', 'KAB. ACEH BESAR', 'KAB. ACEH JAYA', 'KAB. ACEH SELATAN', 'KAB. ACEH SINGKIL', 'KAB. ACEH TAMIANG', 'KAB. ACEH TENGAH', 'KAB. ACEH TENGGARA', 'KAB. ACEH TIMUR', 'KAB. ACEH UTARA', 'KAB. BENER MERIAH', 'KAB. BIREUEN', 'KAB. GAYO LUES', 'KAB. NAGAN RAYA', 'KAB. PIDIE', 'KAB. PIDIE JAYA', 'KAB. SIMEULUE', 'KOTA BANDA ACEH', 'KOTA LHOKSEUMAWE', 'KOTA LANGSA', 'KOTA SABANG', 'KOTA SUBULUSSALAM'] as $city)
                    <option value="{{ $city }}" {{ $samsat->city === $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tipe Samsat -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select id="type" name="type" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="statis" {{ $samsat->type === 'statis' ? 'selected' : '' }}>Statis</option>
                <option value="dinamis" {{ $samsat->type === 'dinamis' ? 'selected' : '' }}>Dinamis</option>
            </select>
        </div>

        <!-- Jadwal -->
        <div id="schedule-container" class="hidden">
            <h3 class="text-lg font-semibold mb-2">Schedules</h3>
            <div id="schedule-items">
                @foreach ($samsat->schedules as $schedule)
                    @php
                        $scheduleIndex = $loop->index;
                    @endphp
                    <div class="mb-4 border p-4 rounded shadow-sm bg-gray-50">
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700">Day</label>
                            <select name="schedule[{{ $scheduleIndex }}][day]" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                                <option value="" disabled>Select Day</option>
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <option value="{{ $day }}" {{ $schedule->day === $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="schedule[{{ $scheduleIndex }}][address]" class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ $schedule->address }}" required>
                        </div>
                        <div class="mb-2 grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Latitude</label>
                                <input type="number" step="any" name="schedule[{{ $scheduleIndex }}][latitude]" class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ $schedule->latitude }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Longitude</label>
                                <input type="number" step="any" name="schedule[{{ $scheduleIndex }}][longitude]" class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ $schedule->longitude }}" required>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="px-6 py-2 mt-4 bg-blue-600 text-white rounded-md">Update Samsat</button>
    </form>
</div>
@endsection
