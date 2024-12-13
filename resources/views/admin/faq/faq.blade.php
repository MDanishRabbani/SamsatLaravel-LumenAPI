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
        <a href="{{ route('admin.faq') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">FAQ</a>
    </div>
</li>

@endsection

@section('content') 
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50"> 
    <div>
        <h1 class="text-xl font-semibold mb-4">List FAQ</h1>
        <a href="{{ route('admin.faq.create') }}" class="btn-orange mb-4 inline-block">Add New FAQ</a>
        
        <table class="w-full text-sm text-left text-gray-500 border">
            <thead class="text-xs text-gray-700 bg-gray-50 border">
                <tr>
                    <th></th>
                    <th scope="col" class="px-6 py-3">Urutan</th>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Question</th>
                    <th scope="col" class="px-6 py-3">Answer</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody id="faq-list">
                @foreach ($faq as $item)
                <tr class="bg-white border-b hover:bg-gray-100" data-id="{{ $item->id }}">

                <!-- Drag handle -->
                <td class="px-4 py-4 cursor-move text-center" style="width: 30px;">
                        <span class="drag-handle">⇅</span> <!-- You can replace this with any icon -->
                    </td>
                    <td class="px-6 py-4 order-column">{{ $item->order_column }}</td> 
                    <td class="px-6 py-4">{{ $item->id }}</td>
                    <td class="px-6 py-4">{{ $item->question }}</td>
                    <td class="px-6 py-4">{{ $item->answer }}</td>                                         

                    <td class="px-6 py-4">
                        <a href="{{ route('admin.faq.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.faq.destroy', $item->id) }}" method="POST" style="display:inline;">
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

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('faq-list');
    
    new Sortable(el, {
        animation: 150,
        handle: '.drag-handle',  // Make only the drag handle draggable
        onStart(evt) {
            const rows = document.querySelectorAll('#faq-list tr');
            rows.forEach((row, index) => {
                row.setAttribute('data-original-order', index + 1);
            });
        },
        onEnd(evt) {
            const rows = document.querySelectorAll('#faq-list tr');
            let order = [];

            rows.forEach((row, index) => {
                const orderColumn = row.querySelector('.order-column');
                orderColumn.textContent = index + 1; // Update order column number
                order.push({ 
                    id: row.getAttribute('data-id'), 
                    order_column: index + 1 // Order starts from 1
                });
            });

            fetch('/faq/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Order updated successfully');
                } else {
                    console.error('Order update failed');
                }
            })
            .catch(err => console.error('Error:', err));
        }
    });
});
</script>
@endsection
