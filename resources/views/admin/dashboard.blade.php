@extends('layouts.admin')

@section('breadcrumb')
<li>
    <div class="flex items-center ">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
    </div>
</li>
@endsection

@section('content')
<div class="p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
       
        <div class="bg-white shadow-lg rounded-lg p-6 border border-blue-200">
            <div class="flex items-center justify-between">
                <div class="text-lg font-medium text-gray-700">Total Information</div>
                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 4V12H6V16H18V12H12V4Z" /></svg>
            </div>
            <div class="mt-4 text-3xl font-semibold text-gray-900">{{ $informationCount }}</div>
        </div>

       
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-lg font-medium text-gray-700">Total Samsat</div>
                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.03 20 3 15.97 3 11C3 6.03 7.03 2 12 2C16.97 2 21 6.03 21 11C21 15.97 16.97 20 12 20ZM13 7V12H16V14H13V19H11V14H8V12H11V7H13Z" /></svg>
            </div>
            <div class="mt-4 text-3xl font-semibold text-gray-900">{{ $samsatCount }}</div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-lg font-medium text-gray-700">Total Faq</div>
                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 4V12H6V16H18V12H12V4Z" /></svg>
            </div>
            <div class="mt-4 text-3xl font-semibold text-gray-900">{{ $faqCount }}</div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-lg font-medium text-gray-700">Total Admin</div>
                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 4V12H6V16H18V12H12V4Z" /></svg>
            </div>
            <div class="mt-4 text-3xl font-semibold text-gray-900">{{ $adminCount }}</div>
        </div>
    </div>
</div>
@endsection
