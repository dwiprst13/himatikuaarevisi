<?php
require "../config.php";
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
    <div class="w-5/6">
        <a href="galeri_tambah.php">Tambah</a>
        <div class="container flex flex-nowrap w-[90%] gap-5 columns-3 mx-auto grid px-4 py-16 lg:grid-cols-12">
            <?php
            $dataGalerry = (mysqli_query($conn, "SELECT * FROM galeri"));
            while ($galeri = mysqli_fetch_assoc($dataGalerry)) {
            ?>
                <a href="?page=detail_galeri&id_galeri=<?= $galeri['id_galeri'] ?>" class="card-galeri justify-center p-2 text-gray-900 md:col-span-3 lg:col-span-3 rounded-lg bg-gray-400">
                    <h1 class="text-center pt-3 text-lg"><b><?= $galeri['judul'] ?></b></h1>
                    <img src="<?= $galeri['img'] ?>" alt="" class="h-40 pt-3 w-[100%]">
                    <p class="text-justify text-sm pt-3 line-clamp-3"><?= $galeri['deskripsi'] ?></p>
                </a>
            <?php
            }
            ?>
        </div>
    </div>
</main>