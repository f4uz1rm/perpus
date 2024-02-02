<x-app-layout>
    <div class="card">
        <div class="card-header card-title row">
            <div class="col-sm">
                Denda
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
                <select id="tahun" class="form-control">
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
                        <a id="btn-excel-denda" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-excel-o mx-2" aria-hidden="true"></i>Excel</a>
                    </li>
                    <li>
                        <a id="btn-pdf-denda" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-pdf-o mx-2" aria-hidden="true"></i>PDF</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <x-table id="table-denda">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Peminjam</th>
                        <th>Kelas</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data</td>
                    </tr>
                </tbody>
            </x-table>
        </div>
    </div>
</x-app-layout>