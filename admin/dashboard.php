<?php
session_start();
require "../config.php";

// Mengecek apakah user mempunyai role sebagai admin atau SuperAdmin
if (!isset($_SESSION['id_user']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'SuperAdmin')) {
    header("Location: ../index.php");
    exit;
}

$user = "SELECT COUNT(*) AS jumlah_user FROM user";
$result_user = $conn->query($user);

$galeri = "SELECT COUNT(*) AS jumlah_galeri FROM galeri";
$result_galeri = $conn->query($galeri);

$artikel = "SELECT COUNT(*) AS jumlah_artikel FROM artikel";
$result_artikel = $conn->query($artikel);

if ($result_user->num_rows > 0) {
    $row = $result_user->fetch_assoc();
    $jumlah_user = $row['jumlah_user'];
} else {
    $jumlah_user = 0;
}

if ($result_galeri->num_rows > 0) {
    $row = $result_galeri->fetch_assoc();
    $jumlah_galeri = $row['jumlah_galeri'];
} else {
    $jumlah_galeri = 0;
}

if ($result_artikel->num_rows > 0) {
    $row = $result_artikel->fetch_assoc();
    $jumlah_artikel = $row['jumlah_artikel'];
} else {
    $jumlah_artikel = 0;
}

$nama = $_SESSION['nama'];
$role = $_SESSION['role'];
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
                    <h1 class="text-white font-bold">User</h1>
                </div>
            </nav>
        </header>
        <div class="p-5">
            <h2 class="text-[1.9rem] font-bold">Selamat Datang, <span class="text-blue-600"><?= $nama; ?></span> </h2>
            <p>Anda sekarang masuk sebagai <span class="text-red-600"><?= $role; ?></span>, Anda bisa mengontrol seluruh akses seluruh web ini</p>
            <p class="my-5 text-[1.3rem] font-bold">Menu</p>
            <div class="flex space-x-5">
                <a href="user.php" class="h-32 w-48 bg-blue-500 rounded-lg p-5 text-white text-center">
                    <p class="">User</p>
                    <p class="text-[3rem] font-bold">
                        <?=
                        $jumlah_user;
                        ?>
                    </p>
                </a>
                <a href="galeri.php" class="h-32 w-48 bg-orange-500 rounded-lg p-5 text-white text-center">
                    <p class="">Galeri</p>
                    <p class="text-[3rem] font-bold">
                        <?=
                        $jumlah_galeri;
                        ?>
                    </p>
                </a>
                <a href="artikel.php" class="h-32 w-48 bg-green-500 rounded-lg p-5 text-white text-center">
                    <p class="">Artikel</p>
                    <p class="text-[3rem] font-bold">
                        <?=
                        $jumlah_artikel;
                        ?>
                    </p>
                </a>
            </div>
        </div>
    </section>
</main>