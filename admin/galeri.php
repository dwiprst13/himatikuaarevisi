<?php
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
include "sidebar.php";
?>

<h1>Galeri Page</h1>