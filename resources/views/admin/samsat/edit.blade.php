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
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Edit Samsat</a>
    </div>
</li>
@endsection

@section('content')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
    <h1 class="text-xl font-semibold mb-4">Edit Samsat</h1>
    <form action="{{ route('admin.samsat.update', $samsat->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $samsat->name) }}" 
                   class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address (default)</label>
            <input type="text" id="address" name="address" value="{{ old('address', $samsat->address) }}" 
                   class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude (default)</label>
                <input type="number" step="any" name="latitude" value="{{ old('latitude', $samsat->latitude) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude (default)</label>
                <input type="number" step="any" name="longitude" value="{{ old('longitude', $samsat->longitude) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
        </div>

        <div>
    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
    <select id="city" name="city" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
        <option value="KAB. ACEH BARAT" {{ $samsat->city === 'KAB. ACEH BARAT' ? 'selected' : '' }}>KAB. ACEH BARAT</option>
        <option value="KAB. ACEH BARAT DAYA" {{ $samsat->city === 'KAB. ACEH BARAT DAYA' ? 'selected' : '' }}>KAB. ACEH BARAT DAYA</option>
        <option value="KAB. ACEH BESAR" {{ $samsat->city === 'KAB. ACEH BESAR' ? 'selected' : '' }}>KAB. ACEH BESAR</option>
        <option value="KAB. ACEH JAYA" {{ $samsat->city === 'KAB. ACEH JAYA' ? 'selected' : '' }}>KAB. ACEH JAYA</option>
        <option value="KAB. ACEH SELATAN" {{ $samsat->city === 'KAB. ACEH SELATAN' ? 'selected' : '' }}>KAB. ACEH SELATAN</option>
        <option value="KAB. ACEH SINGKIL" {{ $samsat->city === 'KAB. ACEH SINGKIL' ? 'selected' : '' }}>KAB. ACEH SINGKIL</option>
        <option value="KAB. ACEH TAMIANG" {{ $samsat->city === 'KAB. ACEH TAMIANG' ? 'selected' : '' }}>KAB. ACEH TAMIANG</option>
        <option value="KAB. ACEH TENGAH" {{ $samsat->city === 'KAB. ACEH TENGAH' ? 'selected' : '' }}>KAB. ACEH TENGAH</option>
        <option value="KAB. ACEH TENGGARA" {{ $samsat->city === 'KAB. ACEH TENGGARA' ? 'selected' : '' }}>KAB. ACEH TENGGARA</option>
        <option value="KAB. ACEH TIMUR" {{ $samsat->city === 'KAB. ACEH TIMUR' ? 'selected' : '' }}>KAB. ACEH TIMUR</option>
        <option value="KAB. ACEH UTARA" {{ $samsat->city === 'KAB. ACEH UTARA' ? 'selected' : '' }}>KAB. ACEH UTARA</option>
        <option value="KAB. BENER MERIAH" {{ $samsat->city === 'KAB. BENER MERIAH' ? 'selected' : '' }}>KAB. BENER MERIAH</option>
        <option value="KAB. BIREUEN" {{ $samsat->city === 'KAB. BIREUEN' ? 'selected' : '' }}>KAB. BIREUEN</option>
        <option value="KAB. GAYO LUES" {{ $samsat->city === 'KAB. GAYO LUES' ? 'selected' : '' }}>KAB. GAYO LUES</option>
        <option value="KAB. NAGAN RAYA" {{ $samsat->city === 'KAB. NAGAN RAYA' ? 'selected' : '' }}>KAB. NAGAN RAYA</option>
        <option value="KAB. PIDIE" {{ $samsat->city === 'KAB. PIDIE' ? 'selected' : '' }}>KAB. PIDIE</option>
        <option value="KAB. PIDIE JAYA" {{ $samsat->city === 'KAB. PIDIE JAYA' ? 'selected' : '' }}>KAB. PIDIE JAYA</option>
        <option value="KAB. SIMEULUE" {{ $samsat->city === 'KAB. SIMEULUE' ? 'selected' : '' }}>KAB. SIMEULUE</option>
        <option value="KOTA BANDA ACEH" {{ $samsat->city === 'KOTA BANDA ACEH' ? 'selected' : '' }}>KOTA BANDA ACEH</option>
        <option value="KOTA LHOKSEUMAWE" {{ $samsat->city === 'KOTA LHOKSEUMAWE' ? 'selected' : '' }}>KOTA LHOKSEUMAWE</option>
        <option value="KOTA LANGSA" {{ $samsat->city === 'KOTA LANGSA' ? 'selected' : '' }}>KOTA LANGSA</option>
        <option value="KOTA SABANG" {{ $samsat->city === 'KOTA SABANG' ? 'selected' : '' }}>KOTA SABANG</option>
        <option value="KOTA SUBULUSSALAM" {{ $samsat->city === 'KOTA SUBULUSSALAM' ? 'selected' : '' }}>KOTA SUBULUSSALAM</option>
    </select>
</div>


        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select id="type" name="type" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                <option value="statis" {{ $samsat->type === 'statis' ? 'selected' : '' }}>Statis</option>
                <option value="dinamis" {{ $samsat->type === 'dinamis' ? 'selected' : '' }}>Dinamis</option>
            </select>
        </div>

        <div id="schedule-container" class="hidden">
            <h2 class="text-lg font-bold text-gray-800">Dynamic Schedules</h2>
            <div id="schedule-items" class="space-y-4"></div>
            <button type="button" id="add-schedule" 
                    class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Add Schedule</button>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="is_active" name="is_active" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                    <option value="1" {{ $samsat->is_active === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $samsat->is_active === '0' ? 'selected' : '' }}>InActive</option>
            
            </select>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md">Update Samsat</button>
        </div>
    </form>
</div>


    <script>
        // Variabel dari Backend
        const typeField = document.getElementById('type');
        const scheduleContainer = document.getElementById('schedule-container');
        const scheduleItems = document.getElementById('schedule-items');
        const addScheduleButton = document.getElementById('add-schedule');

        const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        // Fungsi untuk menambahkan jadwal
        function addSchedule(day = '', address = '', latitude = '', longitude = '', scheduleId = null) {
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


        // Load existing schedules (from backend)
        document.addEventListener('DOMContentLoaded', () => {
            if (typeField.value === 'dinamis') {
                scheduleContainer.classList.remove('hidden');
                @foreach ($samsat->schedules as $schedule)
                    addSchedule(
                        "{{ $schedule->day }}", 
                        "{{ $schedule->address }}", 
                        "{{ $schedule->latitude }}", 
                        "{{ $schedule->longitude }}", 
                        "{{ $schedule->id }}"
                    );
                @endforeach
            }
        });

        // Toggle dynamic schedule visibility
        typeField.addEventListener('change', () => {
            if (typeField.value === 'dinamis') {
                scheduleContainer.classList.remove('hidden');
                if (scheduleItems.children.length === 0) {
                    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'].forEach(day => addSchedule(day));
                }
            } else {
                scheduleContainer.classList.add('hidden');
                scheduleItems.innerHTML = ''; // Clear schedules
            }
        });

        // Add new schedule
        addScheduleButton.addEventListener('click', () => addSchedule());
    </script>

@endsection