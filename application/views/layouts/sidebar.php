<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url("admin/dashboard");?>">
                <img src="<?= base_url("assets/image/tasik.png");?>" width="30px" class="mr-1">
                Kelurahan Ciakar</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url("admin/dashboard");?>">
                <img src="<?= base_url("assets/image/tasik.png");?>" width="30px">
            </a>
        </div>
        <ul class="sidebar-menu">
            <?php $sidebar_dashboard = "Dashboard"; ?>
            <li class="<?= ($sidebar_dashboard == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/dashboard");?>">
                    <i class="fas fa-fire"></i>
                    <span><?= $sidebar_dashboard;?></span>
                </a>
            </li>
            <li class="menu-header">User</li>
            <?php $sidebar_profil = "Profil"; ?>
            <li class="<?= ($sidebar_profil == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/profil");?>">
                    <i class="fas fa-address-card"></i>
                    <span><?= $sidebar_profil;?></span>
                </a>
            </li>
            <li class="menu-header">Main Menu</li>
            <?php if($session["role"] == 1):?>
            <?php $sidebar_user = "User"; ?>
            <li class="<?= ($sidebar_user == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/user");?>">
                    <i class="fas fa-user"></i>
                    <span><?= $sidebar_user;?></span>
                </a>
            </li>
            <?php endif;?>
            <?php $sidebar_artikel = "Artikel"; ?>
            <li class="<?= ($sidebar_artikel == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/artikel");?>">
                    <i class="fas fa-newspaper"></i>
                    <span><?= $sidebar_artikel;?></span>
                </a>
            </li>
            <?php $sidebar_staff = "Staff"; ?>
            <li class="<?= ($sidebar_staff == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/staff");?>">
                    <i class="fas fa-user-tie"></i>
                    <span><?= $sidebar_staff;?></span>
                </a>
            </li>
            <?php $sidebar_rukun = "RT / RW"; ?>
            <li class="<?= ($sidebar_rukun == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/rukun");?>">
                    <i class="fas fa-user-tag"></i>
                    <span><?= $sidebar_rukun;?></span>
                </a>
            </li>
            <?php $sidebar_penduduk = "Penduduk"; ?>
            <li class="<?= ($sidebar_penduduk == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/penduduk");?>">
                    <i class="fas fa-child"></i>
                    <span><?= $sidebar_penduduk;?></span>
                </a>
            </li>
            <?php $sidebar_bangunan = "Bangunan"; ?>
            <li class="<?= ($sidebar_bangunan == $title) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url("admin/bangunan");?>">
                    <i class="fas fa-school"></i>
                    <span><?= $sidebar_bangunan;?></span>
                </a>
            </li>
            <!-- <li class="menu-header">CMS</li>
            <li>
                <a class="nav-link" href="blank.html"><i class="fas fa-home"></i>
                    <span>Beranda</span></a>
            </li>
            <li>
                <a class="nav-link" href="blank.html"><i class="fas fa-user"></i>
                    <span>Profil</span></a>
            </li>
            <li>
                <a class="nav-link" href="blank.html"><i class="fas fa-newspaper"></i>
                    <span>Berita</span></a>
            </li>
            <li>
                <a class="nav-link" href="blank.html"><i class="fas fa-magnet"></i>
                    <span>Sarana Prasarana</span></a>
            </li> -->
        </ul>
    </aside>
</div>