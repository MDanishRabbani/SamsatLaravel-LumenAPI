

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
<div class="container mx-auto mt-6 p-4 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Add Samsat</h2>
    <form action="{{ route('admin.samsat.store') }}" method="POST">
        @csrf

        <!-- Nama Samsat -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" 
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
        </div>

        

        <!-- Alamat -->
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address (default)</label>
            <textarea id="address" name="address" rows="3" 
                      class="w-full mt-1 p-2 border border-gray-300 rounded-md"></textarea>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude (default)</label>
                <input type="text" name="latitude" id="latitude" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude (default)</label>
                <input type="text" name="longitude" id="longitude" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
        </div>

        <!-- Kota -->
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input type="text" id="city" name="city" 
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Tipe Samsat -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Type (Statis/Dinamis)</label>
            <select id="type" name="type" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled selected>Select Type</option>
                <option value="statis">Statis (Induk)</option>
                <option value="dinamis">Dinamis (Penjadwalan) (Keliling/Jempol)</option>>
            </select>
        </div>

        <!-- Jadwal Samsat (Dynamic) -->
        <div id="schedule-container" class="hidden">
            <h3 class="text-lg font-semibold mb-2">Schedules</h3>
            <div id="schedule-items">
                <div class="schedule-item border p-3 mb-4 rounded-lg">
                    <div class="mb-2">
                        <label for="day[]" class="block text-sm font-medium text-gray-700">Day</label>
                        <input type="text" name="day[]" class="w-full p-2 border rounded-md" required>
                    </div>
                    <div class="mb-2">
                        <label for="address[]" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="schedule_address[]" class="w-full p-2 border rounded-md" required>
                    </div>
                    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="latitude[]" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude[]" id="latitude[]" class="mt-1 block w-full border rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="longitude[]" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude[]" id="longitude[]" class="mt-1 block w-full border rounded-md shadow-sm" required>
            </div>
        </div>
                    
                    <button type="button" class="remove-schedule bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                </div>
            </div>
            <button type="button" id="add-schedule" class="bg-blue-500 text-white  px-4 py-1 rounded">Add Schedule</button>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="is_active" class="block text-sm font-medium text-gray-700 mt-4">Status (Active/Inactive)</label>
            <select id="is_active" name="is_active" class="w-full mt-1 p-2 border rounded-md">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add Samsat
                </button>
            </div>
    </form>
</div>

<script>
    const typeField = document.getElementById('type');
    const scheduleContainer = document.getElementById('schedule-container');
    const addScheduleBtn = document.getElementById('add-schedule');
    const scheduleItems = document.getElementById('schedule-items');

    typeField.addEventListener('change', function () {
        if (this.value === 'dinamis' || this.value === 'jempol') {
            scheduleContainer.classList.remove('hidden');
        } else {
            scheduleContainer.classList.add('hidden');
        }
    });

    addScheduleBtn.addEventListener('click', function () {
        const newSchedule = document.createElement('div');
        newSchedule.classList.add('schedule-item', 'border', 'p-3', 'mb-4', 'rounded-lg');
        newSchedule.innerHTML = `
            <div class="mb-2">
                <label for="day[]" class="block text-sm font-medium text-gray-700">Day</label>
                <input type="text" name="day[]" class="w-full p-2 border rounded-md" required>
            </div>
            <div class="mb-2">
                <label for="address[]" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="schedule_address[]" class="w-full p-2 border rounded-md" required>
            </div>
            <div class="mb-2">
                <label for="latitude[]" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude[]" class="w-full p-2 border rounded-md">
            </div>
            <div class="mb-2">
                <label for="longitude[]" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude[]" class="w-full p-2 border rounded-md">
            </div>
            <button type="button" class="remove-schedule bg-red-500 text-white px-2 py-1 rounded">Remove</button>
        `;
        scheduleItems.appendChild(newSchedule);
    });

    scheduleItems.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-schedule')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endsection
