<?php
require "../config.php";
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
        <header class="bg-gray-900 w-[100%] sticky left-0 top-0">
            <nav class="h-16 w-[100%] flex mx-auto ">
                <div class="place-self-center p-5">
                    <h1 class="text-white font-bold">Galeri</h1>
                </div>
            </nav>
        </header>
        <div class="flex flex-col pt-20 space-y-5">
            <div class="flex justify-between w-[95%] mx-auto items-center">
                <h3 class="text-[1.5rem]">Daftar Galeri</h3>
                <a href="galeri_tambah.php" class="p-2 bg-blue-600 rounded-lg text-white">Tambah</a>
            </div>
            <div class="container flex flex-nowrap w-[90%] gap-5 columns-3 mx-auto grid px-4 lg:grid-cols-12">
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