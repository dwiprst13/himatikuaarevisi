<?php
session_start();

// Mengecek apakah user mempunyai role sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

?>


<main class="flex">
    <?php
    include "sidebar.php";
    ?>
    <section class="w-5/6">
        <h2>Selamat datang di halaman admin website Himatik UAA</h2>
    </section>
</main>
