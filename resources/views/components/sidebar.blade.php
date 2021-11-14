<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link" style="color: white;">
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active" style="color: white;">
                    {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                    <p>
                        Data Transaksi
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('transaction.create') }}" class="nav-link" style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Data Transaksi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaction.index') }}" class="nav-link" style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Data Transaksi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaction.rekap') }}" class="nav-link" style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Rekap Transaksi</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

</div>
