<!-- Sidebar -->
<!-- <nav> -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-archive">
                <!-- <img class="fa fa-archive" src="<?php base_url('assets/') ?>img/logo_uho.png" alt=""> -->
            </i>
        </div>
        <div class="sidebar-brand-text mx-3">PBL ADMIN</div>
        <!-- <div class="text-litle d-none d-md-inline">pengalaman bimbingan lapangan</div> -->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <hr class="sidebar-divider">
    <hr class="sidebar-divider">
    <!-- QUERY DARI MENU DATAABASE -->
    <?php
    $role_id = $this->session->userdata['role_id'];
    $queryMenu = "SELECT user_menu.id , menu
        FROM user_menu JOIN user_access_menu 
          ON user_menu.id = user_access_menu.menu_id
       WHERE user_access_menu.role_id = $role_id
       ORDER BY user_access_menu.menu_id ASC
       ";

    $menu = $this->db->query($queryMenu)->result_array();

    // var_dump($menu);

    // die;

    ?>

    <?php foreach ($menu as $m) : ?>

        <div class="sidebar-heading">
            <?= $m['menu'] ?>
        </div>

        <!-- siapkan sub menu sesuai menu user -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT * 
        FROM user_sub_menu JOIN user_menu 
          ON user_sub_menu.menu_id = user_menu.id
       WHERE user_sub_menu.menu_id = $menuId
       AND   user_sub_menu.is_active";

        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>
        <?php foreach ($subMenu as $sm) : ?>

            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>

            <?php endforeach; ?>
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>


        <!-- <li class="nav-item">
                                    <a class="nav-link" href="charts.html">
                                        <i class="fas fa-fw fa-chart-area"></i>
                                        <span>Charts</span></a>
                                    </li>
                                    
                                    <!-- Nav Item - Tables -->
        <!-- <li class="nav-item">
                                        <a class="nav-link" href="tables.html">
                                            <i class="fas fa-fw fa-table"></i>
                                            <span>Tables</span></a>
                                        </li>  -->
        <!-- Divider -->
        <hr class="sidebar-divider d-right d-md-block">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <hr class="sidebar-divider">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
        <hr class="sidebar-divider">

</ul>
<!-- </nav> -->

<!-- End of Sidebar -->