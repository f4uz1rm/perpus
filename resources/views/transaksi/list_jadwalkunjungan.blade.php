<x-app-layout>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <div class="row">
        <div class="col-md">
            <div id="full-calender"></div>
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
                    <x-table id="table">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
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
        });
        calendar.render();
      });
    </script>
</x-app-layout>