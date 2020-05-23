<?php
session_start();
if(isset($_SESSION['PR_id']))
    echo "<meta http-equiv='refresh' content='0; url=main.php'>";
else
    echo "<meta http-equiv='refresh' content='0; url=pages/auth/login.php'>";

 ?>
