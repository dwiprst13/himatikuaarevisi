<?php
session_start();
// Mengecek apakah user mempunyai role sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

include "sidebar.php";
?>
<h1>artikel Page</h1>