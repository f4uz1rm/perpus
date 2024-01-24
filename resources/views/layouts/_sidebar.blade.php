<nav class="sidebar" x-data="{ open: false }">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            E-Perpus
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Menu</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Transaksi</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" role="button" aria-expanded="false"
                    aria-controls="transaksi">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Transaksi</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="transaksi">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('list_peminjaman') }}" class="nav-link">Peminjaman Buku</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('list_pengembalian') }}" class="nav-link">Pengembalian Buku</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('list_denda') }}" class="nav-link">Denda</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('list_jadwalkunjungan') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Jadwal Kunjungan</span>
                </a>
            </li>
            <li class="nav-item nav-category">Master</li>
            <li class="nav-item">
                <a href="{{ route('list_kelas') }}" class="nav-link">
                    <i class="link-icon" data-feather="columns"></i>
                    <span class="link-title">Data Kelas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('list_buku') }}" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Data Buku</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('list_kategori') }}" class="nav-link">
                    <i class="link-icon" data-feather="bookmark"></i>
                    <span class="link-title">Kategori Buku</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('list_anggota') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Data Anggota</span>
                </a>
            </li>
          
            <li class="nav-item">
                <a href="{{ route('list_pengunjung') }}" class="nav-link">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">Data Pengunjung</span>
                </a>
            </li>


            <li class="nav-item nav-category">Laporan</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laporan" role="button" aria-expanded="false"
                    aria-controls="laporan">
                    <i class="link-icon" data-feather="printer"></i>
                    <span class="link-title">Laporan</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Keuangan</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Peminjaman / Pengembalian</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Pengunjung</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
