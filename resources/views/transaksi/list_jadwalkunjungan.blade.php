<x-app-layout>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div id="full-calender"></div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header card-title d-flex justify-content-between">
                    Jadwal Kunjungan
                    <div class="">
                        <a href="#" class="btn btn-success btn-sm">
                            <i class="icon-sm" data-feather="plus"></i>
                            Tambah Data</a>
                    </div>
                </div>
                <div class="card-body py-2">
                    <x-table id="table-jadwalkunjungan">
                        <thead class="text-center">
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-jadwalkunjungan">
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                    </x-table>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('full-calender');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
          locale: 'id',
        });
        calendar.render();
      });
    </script>


    <script>
        function get_jadwalkunjungan() {
            $.ajax({
            metode: "GET",
            url: "{{ route('get_jadwalkunjungan') }}",
            
            beforeSend: function() {
                $("#tbody-jadwalkunjungan").html(`
                    <tr>
                        <td colspan="5" class="text-center">Loading...</td>
                    </tr>
                `);
            },
            success: function(data) {
                if (data.data.length > 0) {
                    let html = "";
                    data.data.forEach((item, index) => {
                        html += `<tr>`;
                        html += `<td class="text-center">${item.tgl_kunjungan}</td>`;
                        html += `<td class="text-wrap">${item.nm_lengkap}</td>`;
                        html += `<td class="text-center">${item.nm_kelas}</td>`;
                        html += `<td class="text-wrap">${item.keterangan}</td>`;
                        html += `<td class="text-center">`;
                        html +=
                            `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_jadwalkunjungan(${item.id_kunjungan})">Hapus</button>`;
                        html +=
                            `<button class="btn btn-sm btn-success mx-1" onclick="ubah_jadwalkunjungan(${item.id_kunjungan})" >Ubah</button>`;
                        html += `</td>`;
                        html += `</tr>`;
                    });
                    $("#tbody-jadwalkunjungan").html(html);
                    if ($("#table-jadwalkunjungan").hasClass("dataTable")) {
                        $("#table-jadwalkunjungan").DataTable().destroy();
                    }
                    let nama_table = "JADWAL KUNJUNGAN";
                    let table_pengunjung = $('table').DataTable({
                        responsive: true,
                        buttons: [
                            //EXPORT EXCEL
                            {
                                extend: 'excelHtml5',
                                oriented: 'potrait',
                                pageSize: 'A4',
                                autoFilter: true,
                                sheetName: 'Data_JadwalKunjungan',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
            
                                },
                                filename: "Export " + nama_table + " - {{ date('Y-m-d') }}",
                                title: 'INFORMASI MASTER ' + nama_table +
                                    ' - MIFTAHUL ULUM',
                                messageTop: 'Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}',
                            },
                            //EXPORT PDF
                            {
                                extend: 'pdf',
                                oriented: 'potrait',
                                pageSize: 'A4',
                                title: '',
                                download: 'download',
                                filename: "Export " + nama_table + " - {{ date('Y-m-d') }}",
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
            
                                },
                                customize: function(doc) {
                                    doc.content.unshift([{
                                            text: 'INFORMASI DATA MASTER JADWAL KUNJUNGAN',
                                            style: 'font-size: 15px;'
                                        },
            
                                        {
                                            text: "Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}",
                                            margin: [0, 0, 0, 10]
                                        },
            
                                    ]);
            
                                }
            
                            },
                        ],
                    });
                    $("#btn-excel-jadwal-kunjungan").on("click", function() {
                        table_jadwalkunjungan.button('.buttons-excel').trigger();
                    });
            
                    $("#btn-pdf-jadwal-kunjungan").on("click", function() {
                        table_jadwalkunjungan.button('.buttons-pdf').trigger();
                    });
            
                    // $("#bulan").on("change", function() {
                    //     let  bulan =   this.value.substring(0, 2)  ;
                    //     table_pengunjung.columns(0).search(bulan).draw();
                    //     console.log(bulan);
                    // })
                    // $("#tahun").on("change", function() {
                    //    let  tahun =   this.value.substring(2, 4)  ;
                    //     table_pengunjung.columns(0).search(tahun).draw();
                    // })
                } else {
                    $("#tbody-jadwalkunjungan").html(`
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data yang ditampilkan</td>
                        </tr>
                    `);
                }
            }
            }).fail(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Gagal memuat data, silahkan refresh halaman"
                })
            })
        }

        function ubah_jadwalkunjungan(){
            
        }
    </script>
</x-app-layout>