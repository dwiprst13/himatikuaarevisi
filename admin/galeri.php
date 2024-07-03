<?php
require "../config.php";
session_start();

// Mengecek apakah user mempunyai role sebagai admin atau SuperAdmin
if (!isset($_SESSION['id_user']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'SuperAdmin' && $_SESSION['role'] !== 'Jurnalis')) {
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
            <?php
            $dataGalerry = mysqli_query($conn, "SELECT * FROM galeri");
            $jumlahData = mysqli_num_rows($dataGalerry);

            if ($jumlahData > 0) {
            ?>
                <div class="container flex-nowrap gap-5 columns-3 mx-auto grid px-4 lg:grid-cols-12">
                    <?php
                    // Jika ada data galeri, tampilkan galeri
                    while ($galeri = mysqli_fetch_assoc($dataGalerry)) {
                    ?>
                        <form action="galeri_edit.php" method="get" class="justify-center p-2 text-gray-900 md:col-span-3 lg:col-span-3 rounded-lg bg-gray-400">
                            <input type="hidden" name="id_galeri" value="<?= $galeri['id_galeri'] ?>">
                            <button type="submit" class="card-galeri flex justify-center flex-col">
                                <h1 class="text-center pt-3 text-lg line-clamp-1 w-full"><b><?= $galeri['judul'] ?></b></h1>
                                <img src="<?= $galeri['img'] ?>" alt="" class="h-40 mt-3 w-[100%] mx-auto">
                            </button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <div class="h-96 w-full flex items-center">
                    <p class="text-center text-gray-500 text-[1.9rem] w-full">Tidak ada dokumentasi yang tersedia.</p>
                </div>
            <?php
            }
            ?>
        </div>
</main>