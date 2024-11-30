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
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a 1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
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
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea id="address" name="address" rows="3" 
                      class="w-full mt-1 p-2 border border-gray-300 rounded-md" required></textarea>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude (default)</label>
                <input type="number" step="any" name="latitude" id="latitude" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude (default)</label>
                <input type="number" step="any" name="longitude" id="longitude" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
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
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select id="type" name="type" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled selected>Select Type</option>
                <option value="statis">Statis</option>
                <option value="dinamis">Dinamis</option>
            </select>
        </div>

        <!-- Jadwal -->
        <div id="schedule-container" class="hidden">
            <h3 class="text-lg font-semibold mb-2">Schedules</h3>
            <div id="schedule-items"></div>
            <button type="button" id="add-schedule" 
                    class="bg-blue-500 text-white px-4 py-1 rounded">Add Schedule</button>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="is_active" name="is_active" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md">Submit</button>
        </div>
    </form>
</div>

<script>
    const typeField = document.getElementById('type');
const scheduleContainer = document.getElementById('schedule-container');
const scheduleItems = document.getElementById('schedule-items');
const addScheduleButton = document.getElementById('add-schedule');

const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

// Fungsi untuk menambahkan jadwal
function addSchedule(day = '', address = '', latitude = '', longitude = '') {
    const scheduleIndex = scheduleItems.children.length;

    const scheduleItem = document.createElement('div');
    scheduleItem.classList.add('mb-4', 'border', 'p-4', 'rounded', 'shadow-sm', 'bg-gray-50');
    scheduleItem.innerHTML = `
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700">Day</label>
            <select name="schedule[${scheduleIndex}][day]" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled ${day === '' ? 'selected' : ''}>Select Day</option>
                ${days.map(d => `<option value="${d}" ${d === day ? 'selected' : ''}>${d}</option>`).join('')}
            </select>
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" name="schedule[${scheduleIndex}][address]" 
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="${address}" required>
        </div>
        <div class="mb-2 grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="number" step="any" name="schedule[${scheduleIndex}][latitude]" 
                       class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="${latitude}" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="number" step="any" name="schedule[${scheduleIndex}][longitude]" 
                       class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="${longitude}" required>
            </div>
        </div>
        <button type="button" class="remove-schedule bg-red-500 text-white px-3 py-1 rounded mt-2">Remove</button>
    `;

    scheduleItems.appendChild(scheduleItem);

    // Attach event listener to the remove button
    scheduleItem.querySelector('.remove-schedule').addEventListener('click', () => {
        scheduleItem.remove();
    });
}

// Toggle schedule container visibility and add default days
typeField.addEventListener('change', () => {
    if (typeField.value === 'dinamis') {
        scheduleContainer.classList.remove('hidden');

        // Tambahkan jadwal default jika belum ada
        if (scheduleItems.children.length === 0) {
            ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'].forEach(day => addSchedule(day));
        }
    } else {
        scheduleContainer.classList.add('hidden');
        scheduleItems.innerHTML = ''; // Hapus semua jadwal jika tipe kembali ke 'statis'
    }
});

// Tambahkan jadwal manual menggunakan tombol
addScheduleButton.addEventListener('click', () => addSchedule());

</script>
@endsection

