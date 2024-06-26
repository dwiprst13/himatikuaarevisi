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
    <!-- <link rel="stylesheet" href="asset/output.css"> -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="icon" href="public/image/logokabinet.png">
    <script src="../assets/js/script.js" defer></script>
</head>

<body>
    <?php
    // include merupakan sebuah aktivitas untuk menyertakan atau menyisipkan suatu file lain kedalam file tersebut
    include "header.php";
    ?>
    <main class="bg-gray-900">
        <h2 class="text-center text-white text-[2.2rem] font-bold py-5">Galeri</h2>

        <section class="container flex flex-wrap mx-auto px-4 py-2 justify-center">
            <?php
            while ($galeri = mysqli_fetch_assoc($dataGalerry)) {
                $pathgambar = $galeri['img'];
                $gambar = str_replace('../', '', $pathgambar);
            ?>
                <div class="w-full sm:w-1/2 md:w-1/3 xl:w-1/4 p-2">
                    <button class="relative bg-white rounded-lg p-1 overflow-hidden group w-full" onclick="openModal('<?= $gambar ?>', '<?= $galeri['judul'] ?>', '<?= $galeri['deskripsi'] ?>')">
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
        </section>\
        <div id="imageModal" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-black bg-opacity-50"></div>
            <div class="flex items-center justify-center h-screen">
                <div class="bg-white rounded-lg p-4 max-w-3xl relative h-[80vh] ">
                    <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800" onclick="closeModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="mx-auto w-full h-full">
                        <img id="modalImage" src="" alt="" class="mx-auto w-full h-[85%] object-cover">
                        <div id="modalCaption" class="mt-2 text-center h-[15%]"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>
<script>
    function openModal(imageSrc, title, description) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalCaption').innerHTML = `
        <h1 class="text-lg font-bold">${title}</h1>
        <p class="text-sm">${description}</p>
    `;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>