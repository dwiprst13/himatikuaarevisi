<?php
include "config.php";
$sql = "SELECT * FROM galeri ORDER BY id_galeri DESC LIMIT 4";
$dataGalerry = $conn->query($sql);

?>
<section class="w-[100%] mx-auto py-10 bg-white">
    <div data-aos="fade-up" data-aos-duration="1500" class="w-[95%] mx-auto md:w-[90%] p-3 md:p-5 space-y-5">
        <h2 class="text-center font-bold text-[1.6rem] md:text-[2rem] lg:text-[2.5rem] text-[#072748]">Galeri</h2>
        <p class="text-gray-900 text-[1rem] md:text-[1.1rem] lg:text-[1.2rem] text-center">Beberapa dokumentasi berbagai kegiatan yang telah kami adakan.</p>
        <div class="container flex flex-wrap mx-auto px-4 py-2 justify-center">
            <?php
            while ($galeri = mysqli_fetch_assoc($dataGalerry)) {
                $pathgambar = $galeri['img'];
                $gambar = str_replace('../', '', $pathgambar);
            ?>
                <div class="w-full sm:w-1/2 md:w-1/4">
                    <button class="relative p-1 overflow-hidden group w-full" onclick="openModal('<?= $gambar ?>', '<?= $galeri['judul'] ?>', '<?= $galeri['deskripsi'] ?>')">
                        <div class="bg-black w-full flex justify-center items-center overflow-hidden">
                            <img src="<?= $gambar ?>" alt="" class="object-cover aspect-w-6 aspect-h-4 min-h-48">
                        </div>
                        <figcaption class="absolute top-0 left-0 w-full h-full opacity-0 group-hover:opacity-100 p-1 transition-opacity duration-300 text-white">
                            <div class="bg-black bg-opacity-70 w-full h-full flex items-center justify-center">
                                <div>
                                    <h1 class="flex items-center justify-center text-lg font-bold">
                                        <?= $galeri['judul'] ?>
                                    </h1>
                                    <p class="flex items-center justify-center text-sm line-clamp-3">
                                        <?= $galeri['deskripsi'] ?>
                                    </p>
                                </div>
                            </div>
                        </figcaption>
                    </button>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="flex justify-center items-center my-3">
            <button onclick="window.location.href = 'galeri.php';" class="bg-[#072748] text-white font-bold py-2 px-5 rounded-lg">Lihat Galeri</button>
        </div>
    </div>
    <!-- <div>
        <div id="imageModal" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-red-600 bg-opacity-50"></div>
            <div class="flex items-center justify-center h-screen">
                <div class="bg-white rounded-lg p-4 max-w-3xl relative h-[80vh] ">
                    <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800" onclick="closeModal()">
                        <p>X</p>
                    </button>
                    <div cs="mx-auto w-full h-full">
                        <img id="modalImage" src="" alt="" class="mx-auto w-full h-[85%] object-cover">
                        <div id="modalCaption" class="mt-2 text-center h-[15%]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>
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