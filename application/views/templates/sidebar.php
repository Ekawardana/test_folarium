<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('dashboard') ?>"><i class="fas fa-user mr-2" style="font-size:1rem;"></i>E-Pegawai</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('dashboard') ?>">E-P</a>
        </div>
        <ul class="sidebar-menu">
            <li class="<?= (strpos(current_url(), "dashboard") !== false) ? "active" : ""; ?>">
                <a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            </li>

            <!-- Data Master -->
            <li class="dropdown <?= (strpos(current_url(), "master") !== false) ? "active" : ""; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data Master</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= (strpos(current_url(), "Pegawai") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('master/Pegawai') ?>"><span>Pegawai</span></a>
                    </li>
                    <li class="<?= (strpos(current_url(), "Jabatan") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('master/Jabatan') ?>"><span>Jabatan</span></a>
                    </li>
                    <li class="<?= (strpos(current_url(), "Kontrak") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('master/Kontrak') ?>"><span>Kontrak</span></a>
                    </li>
                </ul>
            </li>
            <!-- End Data Master -->
        </ul>
    </aside>
</div>