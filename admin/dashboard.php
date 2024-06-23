<?php
session_start();

// Mengecek apakah user mempunyai role sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php");
    exit;
}

?>


<main class="flex">
    <aside class="sticky top-0 left-0 w-1/6 h-screen bg-gray-100 shadow-lg">
        <div class="w-full">
            <?php include "sidebar.php"; ?>
        </div>
    </aside>
    <section class="w-5/6">
        <h2>Selamat datang di halaman admin website Himatik UAA</h2>
    </section>
</main>