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

    <div class="h6 mb-4">
        Selamat Datang di Dashboard
    </div>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Denda Terkumpul</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h3 class="mb-2 mt-2">Rp. 0</h3>
                                    {{-- <div class="d-flex align-items-baseline justify-content-center">
                                        <p class="text-success">
                                            <span>denda yang terkumpul sampai tanggal {{ date('d-m-y') }} </span>
                                        </p>
                                    </div> --}}
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    {{-- <div id="growthChart" class="mt-md-3 mt-xl-0"></div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Peminjaman</h6>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h3 class="mb-2 mt-2" id="total_peminjam">0</h3>
                                    {{-- <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>-2.8%</span>
                                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                        </p>
                                    </div> --}}
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Pengembalian</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h3 class="mb-2 mt-2" id="total_pengembalian">0</h3>
                                    {{-- <div class="d-flex align-items-baseline justify-content-center">
                                        <p class="text-success">
                                            <span>denda yang terkumpul sampai tanggal {{ date('d-m-y') }} </span>
                                        </p>
                                    </div> --}}
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    {{-- <div id="growthChart" class="mt-md-3 mt-xl-0"></div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Buku</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2 mt-2" id="total_buku">0</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Pengunjung</h6>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-12">
                                    <h3 class="mb-2 mt-2" id="total_pengunjung">0</h3>
                                    {{-- <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>-2.8%</span>
                                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                        </p>
                                    </div> --}}
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Anggota</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2 mt-2" id="total_anggota">0</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $.ajax({
        url: "{{ route('count_dashboard') }}",
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            $('#total_buku').html('Loading...');
            $('#total_pengunjung').html('Loading...');
            $('#total_anggota').html('Loading...');
            $('#total_peminjam').html('Loading...');
            $('#total_pengembalian').html('Loading...');
            $('#total_denda').html('Loading...');
        },
        success: function(data) {
            $('#total_buku').html(data.total_buku);
            $('#total_pengunjung').html(data.total_pengunjung);
            $('#total_anggota').html(data.total_anggota);
            $('#total_peminjam').html(data.total_peminjam);
            $('#total_pengembalian').html(data.total_pengembalian)
            $('#total_denda').html(data.total_denda)
        },
        error: function(error) {
            console.log(error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi Kesalahan!',
            })
        }
    });
</script>
