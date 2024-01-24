<x-app-layout>

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Pengunjung
            </div>
            {{-- <x-btn-add /> --}}
        </div>
        <div class="card-body py-2">
            <div class="table-responsive">
                <x-table id="table-buku">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Tanggal Kunjungan
                            </th>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>
                                Kelas
                            </th>
                            <th>
                                Tujuan Ke Pespustakaan
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
                    $('table').DataTable();
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
