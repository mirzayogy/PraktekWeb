<?php
// include "libs/library.php";
$nopage = "<meta http-equiv='refresh' content='1; url=pages/404.html'> ";
if(isset($_GET['page'])){
  $page = $_GET['page'];
  switch ($page) {
    case '' :
    // echo "<meta http-equiv='refresh' content='1; url=sign-in.php'> ";
      include "pages/home.php";
      break;

    case 'home':
      include "pages/home.php";
      break;

    case 'table':
      include "pages/table.php";
      break;

    case 'matakuliah':
      include "pages/matakuliah/matakuliah_read.php";
      break;

    case 'matakuliah_update':
      include "pages/matakuliah/matakuliah_update.php";
      break;

    case 'pengingat':
      include "pages/pengingat/pengingat_read.php";
      break;

    case 'pengingat_update':
      include "pages/pengingat/pengingat_update.php";
      break;


    case 'login':
      echo "<meta http-equiv='refresh' content='1; url=pages/auth/login.php'> ";
    break;


    default:
    echo $nopage;
    break;
  }
}else{
  include "pages/home.php";
}
?>
