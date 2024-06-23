<?php
session_start();
include "config.php";
$dataGalerry = (mysqli_query($conn, "SELECT * FROM galeri"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMATIK UAA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="../assets/js/script.js" defer></script>
</head>

<body>
    <?php
    // include merupakan sebuah aktivitas untuk menyertakan atau menyisipkan suatu file lain kedalam file tersebut
    include "header.php";
    ?>
    <main class="bg-gray-900">
        <h2 class="text-center text-white text-[2.2rem] font-bold py-5">Galeri</h2>
        <section class="container flex flex-wrap mx-auto px-4 gap-2 py-2 min-h-screen">
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
        </section>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>