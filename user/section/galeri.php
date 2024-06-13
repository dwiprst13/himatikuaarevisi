<?php
include "config.php";
$dataGalerry = (mysqli_query($conn, "SELECT * FROM galeri"));
?>
<section class="bg-gray-900">
    <div class="container flex flex-nowrap w-[90%] gap-5 columns-3 mx-auto grid px-4 py-16 lg:grid-cols-12">
        <?php
        while ($galeri = mysqli_fetch_assoc($dataGalerry)) {
            $pathgambar = $galeri['img'];
            $gambar = str_replace('../', '', $pathgambar);
        ?>
            <button class="card-galeri justify-center p-2 text-gray-900 md:col-span-3 lg:col-span-3 rounded-lg bg-gray-400">
                <h1 class="text-center pt-3 text-lg"><b><?= $galeri['judul'] ?></b></h1>
                <img src="<?= $gambar ?>" alt="" class="h-40 pt-3 w-[100%]">
                <p class="text-justify text-sm pt-3 line-clamp-3"><?= $galeri['deskripsi'] ?></p>
            </button>
        <?php
        }
        ?>
    </div>
</section>