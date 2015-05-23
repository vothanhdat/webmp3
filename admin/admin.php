<?php
if (isset($_SESSION['admin'])) {                   
    if (isset($_GET['logout'])) {
		$_SESSION['admin'] = null;
		echo "<script> window.location.assign('index.php')</script>";
    } else {
        include 'layout/admin.php';
    }
}
?>
