<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
?>

<div class="sidebar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="?page=home" class="nav-link px-2 <?php if ($page == 'home' || $page == '')  echo "active" ?>"><i class="material-icons icon">dashboard</i>
                <span class="text">Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a href="?page=matakuliah" class="nav-link px-2  <?php if ($page == 'matakuliah' || $page == 'matakuliah_update')  echo "active" ?>"><i class="material-icons icon">school</i>
                <span class="text">Matakuliah</span></a>
        </li>
        <li class="nav-item">
            <a href="?page=pengingat" class="nav-link px-2 <?php if ($page == 'pengingat' || $page == 'pengingat_update')  echo "active" ?>"><i class="material-icons icon">assignment</i>
                <span class="text">Pengingat</span></a>
        </li>
        <!-- <li class="nav-item">
            <a href="?page=table" class="nav-link px-2"><i class="material-icons icon">list</i>
                <span class="text">Table</span></a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link px-2"><i class="material-icons icon">person</i>
                <span class="text">Profile</span></a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link px-2"><i class="material-icons icon">insert_chart</i>
                <span class="text">Charts</span></a>
        </li>
        <li class="nav-item">

            <a href="#" class="nav-link px-2"><i class="material-icons icon">settings</i>
                <span class="text">Settings</span></a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link px-2"><i class="material-icons icon">computer</i>
                <span class="text">Demo</span></a>
        </li> -->
        <!-- <li class="nav-item">
            <a href="#" class="nav-link sideMenuToggler px-2"><i class="material-icons icon">view_list</i>
                <span class="text">Resize</span></a>
        </li> -->
    </ul>
</div>