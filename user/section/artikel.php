<?php
include "config.php";

function createSlug($string)
{
    $string = strtolower($string);
    $string = preg_replace('/\s+/', '-', $string); // Hanya menghapus spasi
    return $string;
}

?>
<section class="w-[100%] mx-auto py-10 bg-white">
    <div data-aos="fade-up" data-aos-duration="1500" class="w-[95%] mx-auto md:w-[90%] p-3 md:p-5 space-y-5">
        <h2 class="text-center font-bold text-[1.6rem] md:text-[2rem] lg:text-[2.5rem] text-[#072748]">Artikel</h2>
        <p class="text-[#072748] text-[1rem] md:text-[1.1rem] lg:text-[1.2rem] text-center">Selamat datang di artikel Himpunan Mahasiswa Informatika!.</p>
        <div class="flex">
            <?php
            $queryartikel = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id_artikel DESC");
            $count = 0; // Variabel untuk menghitung iterasi
            while ($row_artikel = mysqli_fetch_assoc($queryartikel)) {
                $count++; // Increment variabel count di setiap iterasi
            ?>
                <div class="w-[50%] mx-auto p-2">
                    <a href="artikel/<?= urlencode(createSlug($row_artikel['judul'])) ?>" class="h-36 md:h-40 flex items-center bg-gray-100 hover:bg-gray-200">
                        <div class="h-full p-2 flex flex-col md:flex-row items-center">
                            <div class="w-full flex flex-col items-center gap-3">
                                <div class="w-full">
                                    <div class="space-y-1">
                                        <h4 class="font-semibold text-[1.2rem] md:text-[1.4rem] lg:text-[1.6rem] text-gray-900"><?= $row_artikel['judul'] ?></h4>
                                        <div class="flex gap-3">
                                            <p class="text-[0.8rem] text-gray-900"><?= date('d F Y', strtotime($row_artikel['date'])) ?></p>
                                            <p class="text-[0.8rem] text-blue-600">Oleh <?= $row_artikel['author'] ?></p>
                                        </div>
                                        <div class="md:flex hidden text-gray-900">
                                            <p class="text-[1rem] text-justify line-clamp-2"><?= substr($row_artikel['content'], 0, 150) . '...' ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:hidden flex text-gray-900">
                                <p class="text-[0.8rem]"><?= substr($row_artikel['content'], 0, 75) . '...' ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="flex justify-center items-center my-3">
            <button onclick="window.location.href = 'artikel.php';" class="bg-[#072748] text-white font-bold py-2 px-5 rounded-lg">Baca Artikel</button>
        </div>
    </div>
</section>