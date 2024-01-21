<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    <div class="h6 mb-1">
        Selamat Datang di Dashboard
    </div>
    <div class="row">
        <div class="col-sm mt-2">
            <div class="card">
                <div class="card-title card-header">Total Buku</div>
                <div class="card-body py-0">
                    <h1 class="text-center">
                        100
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm mt-2">
            <div class="card">
                <div class="card-title card-header">Total Pengunjung</div>
                <div class="card-body py-0">
                    <h1 class="text-center">
                        100
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm mt-2">
            <div class="card">
                <div class="card-title card-header">Total Pengembalian</div>
                <div class="card-body py-0">
                    <h1 class="text-center">
                        100
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm mt-2">
            <div class="card">
                <div class="card-title card-header">Total Peminjam</div>
                <div class="card-body py-0">
                    <h1 class="text-center">
                        100
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
