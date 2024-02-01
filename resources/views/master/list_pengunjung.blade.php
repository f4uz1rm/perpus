<x-app-layout>

    <div class="card">

        <div class="card-header card-title row">
            <div class="col-sm">
                Data Pengunjung

            </div>
            <div class="col-sm d-flex justify-content-end">
                <select class="form-select" id="bulan">
                    <option value="" selected>Semua Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <select name="" id="tahun" class="form-control">
                    @for ($i = date('Y'); $i >= date('Y') - 2; $i--)
                        @if ($i == date('Y'))
                            <option value="{{ $i }}" selected>{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
                <button class="btn btn-warning dropdown-toggle mx-1" type="button" id="dropdown-export"
                    data-bs-toggle="dropdown" aria-haspopup="true" onclick="" aria-expanded="false">
                    Ekspor ke
                </button>
                <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a id="btn-excel-pengunjung" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-excel-o mx-2" aria-hidden="true"></i>Excel</a>
                    </li>
                    <li>
                        <a id="btn-pdf-pengunjung" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-pdf-o mx-2" aria-hidden="true"></i>PDF</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="card-body py-2">
            <div class="table-responsive">
                <x-table id="table-buku">
                    <thead>
                        <tr class="text-center">
                            <th class="searchable">
                                Tanggal Kunjungan
                            </th>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>
                                Kelas
                            </th>
                            <th>
                                Tujuan
                            </th>

                        </tr>
                    </thead>
                    <tbody id="tbody-pengunjung">

                    </tbody>
                </x-table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pengunjung" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingModalLabel">Tambah Pengunjung</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
                            <input type="search" class="form-control" id="tgl_kunjungan" readonly
                                placeholder="Otomatis Terisi" value="{{ date('d-m-Y h:i:s') }}">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="ketegori" class="form-label">Nama Lengkap</label>
                                    <input type="text" id="" class="form-control"
                                        placeholder="Nama Lengkap">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="ketegori" class="form-label">Kelas</label>
                                    <input type="text" id="" class="form-control" placeholder="Kelas">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="ketegori" class="form-label">Tujuan Ke Perpustakaan</label>
                                    <input type="text" id="" class="form-control"
                                        placeholder="Tujuan Ke Perpustakaan">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajax({
            metode: "GET",
            url: "{{ route('get_pengunjung') }}",
            beforeSend: function() {
                $("#tbody-pengunjung").html(`
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
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
                        html += `<td class="text-wrap">${item.tujuan}</td>`;
                        html += `</tr>`;
                    });
                    $("#tbody-pengunjung").html(html);
                    if ($("#table-pengunjung").hasClass("dataTable")) {
                        $("#table-pengunjung").DataTable().destroy();
                    }
                    let nama_table = "PENGUNJUNG";
                    let table_pengunjung = $('table').DataTable({
                        responsive: true,
                        buttons: [
                            //EXPORT EXCEL
                            {
                                extend: 'excelHtml5',
                                oriented: 'potrait',
                                pageSize: 'A4',
                                autoFilter: true,
                                sheetName: 'Data_Pengunjung',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]

                                },
                                filename: "Export " + nama_table + " - {{ date('Y-m-d') }}",
                                title: 'INFORMASI MASTER ' + nama_table +
                                    ' - MIFTAHUL ULUM',
                                messageTop: 'Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}',
                                // messageBottom: "Bandung, <?= date('d-m-Y') ?> \r\n\r\r Bagian {{ session('outlet') }}",
                                // messageBottom : function (x) { 
                                //     var sheet = x.xl.worksheets['sheet1.xml'];
                                //     $('row c[r^="A2"]', sheet).attr('s', '52');
                                //     $('[r] t', sheet).text('Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}');
                                //  },
                                // customize: function(xlsx) {
                                //     var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                //     $('[r=A2] t', sheet).text(
                                //         'Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}'
                                //         );
                                //     $('row c[r^="A1"]', sheet).attr('s',
                                //     '50'); //https://datatables.net/reference/button/excelHtml5
                                //     $('row c[r^="A2"]', sheet).attr('s', '50');
                                //     $('row:last c', sheet).attr('s', '52');

                                // },
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
                                            text: 'INFORMASI DATA MASTER BUKU',
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
                    $("#btn-excel-pengunjung").on("click", function() {
                        table_pengunjung.button('.buttons-excel').trigger();
                    });

                    $("#btn-pdf-pengunjung").on("click", function() {
                        table_pengunjung.button('.buttons-pdf').trigger();
                    });

                    $("#bulan").on("change", function() {
                        // table_pengunjung.column(0).search($(this).val()).draw();
                        // 2024-01-27 09:00:25
                        let  bulan =   this.value.substring(0, 2)  ;
                        table_pengunjung.columns(0).search(bulan).draw();
                        console.log(bulan);
                    })
                    $("#tahun").on("change", function() {
                       let  tahun =   this.value.substring(2, 4)  ;
                        table_pengunjung.columns(0).search(tahun).draw();
                    })
                } else {
                    $("#tbody-pengunjung").html(`
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data yang ditampilkan</td>
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
    </script>

</x-app-layout>
