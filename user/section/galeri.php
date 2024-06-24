<?php
include "config.php";
$dataGalerry = (mysqli_query($conn, "SELECT * FROM galeri"));
?>
<section class="w-[100%] mx-auto py-10 bg-gray-900">
    <div data-aos="fade-up" data-aos-duration="1500" class="w-[95%] mx-auto md:w-[90%] p-3 md:p-5 space-y-5">
        <h2 class="text-center font-bold text-[1.6rem] md:text-[2rem] lg:text-[2.5rem] text-blue-700">Galeri</h2>
        <p class="text-white text-[1rem] md:text-[1.1rem] lg:text-[1.2rem] text-center">Beberapa dokumentasi berbagai kegiatan yang telah kami adakan.</p>
        <div class="container flex flex-wrap mx-auto px-4 gap-2 py-2">
            <?php
            while ($galeri = mysqli_fetch_assoc($dataGalerry)) {
                $pathgambar = $galeri['img'];
                $gambar = str_replace('../', '', $pathgambar);
            ?>
                <div class="w-full sm:w-1/2 md:w-1/3 xl:w-1/4 p-2">
                    <button class="relative bg-white rounded-lg p-1 overflow-hidden group w-full">
                        <div class="bg-black w-full flex justify-center items-center overflow-hidden">
                            <img src="<?= $gambar ?>" alt="" class="object-cover aspect-w-6 aspect-h-4 min-h-48">
                        </div>
                        <figcaption class="absolute top-0 left-0 w-full h-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-70 text-white flex items-center justify-center">
                            <text class="">
                                <h1 class="flex items-center justify-center text-lg font-bold">
                                    <?= $galeri['judul'] ?>
                                </h1>
                                <p class="flex items-center justify-center text-sm line-clamp-3">
                                    <?= $galeri['deskripsi'] ?>
                                </p>
                            </text>
                        </figcaption>
                    </button>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="flex justify-center items-center my-3">
            <button onclick="window.location.href = 'galeri.php';" class="bg-blue-700 text-white font-bold py-2 px-5 rounded-lg">Lihat Galeri</button>
        </div>
    </div>
</section>