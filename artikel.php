<?php
session_start();
include "config.php";
function createSlug($string)
{
    $string = strtolower($string);
    $string = preg_replace('/\s+/', '-', $string); // Hanya menghapus spasi
    return $string;
}

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
    ?> <main class="bg-white">
        <div class="flex flex-col space-y-5 py-10 w-[90%] mx-auto">
            <h2 class="text-center text-[#072748] text-[2.2rem] font-bold">Artikel</h2>
            <p class="text-center">Selamat datang di artikel Himpunan Mahasiswa Informatika!. Di halaman ini, kami akan membawa Anda dalam perjalanan pengetahuan yang menginspirasi, memberikan wawasan yang tajam terkait teknologi informasi yang dapat membantu Anda melihat berbagai perspektif. Berikut beberapa Tulisan kami yang menginspiratif dan mengedukasi.</p>
            <div class="w-5/6 md:w-1/2 lg:w-1/3 mx-auto my-5">
                <form action="" method="get" class="flex h-8">
                    <input name="searchPost" type="text" autocomplete="off" placeholder="Cari Postingan..." class="bg-slate-200 text-gray-900 placeholder:text-gray-600 w-[80%] focus:outline-none rounded-l-lg p-2" value="">
                    <button type="submit" class="w-[20%] bg-[#072748] text-white focus:outline-none rounded-r-lg">Cari</button>
                </form>
            </div>
        </div>
        <section class="flex text-gray-900 min-h-screen">
            <div class="text-[2.2rem] text-[#072748] w-[90%] mx-auto">
                <?php
                $queryartikel = mysqli_query($conn, "SELECT * FROM artikel");
                $count = 0; // Variabel untuk menghitung iterasi
                while ($row_artikel = mysqli_fetch_assoc($queryartikel)) {
                    $count++; // Increment variabel count di setiap iterasi
                ?>
                    <a href="artikel/<?= urlencode(createSlug($row_artikel['judul'])) ?>" class="w-[100%] md:w-[85%] mx-auto h-36 md:h-48 flex items-center hover:bg-gray-100">
                        <div class="h-full p-2 flex flex-col md:flex-row items-center">
                            <div class="w-full flex flex-col items-center gap-3">
                                <div class="w-full">
                                    <div class="flex gap-2 text-white text-[0.8rem]">
                                        <?php
                                        $tags = explode(' ', $row_artikel['tag']);
                                        foreach ($tags as $tag) {
                                            if (strpos($tag, '#') === 0) {
                                                $tag = substr($tag, 1);
                                                echo '<p class="bg-blue-600 bg-opacity-70 rounded-xl p-1 px-2">' . $tag . '</p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="space-y-2">
                                        <h4 class="font-semibold text-[1.2rem] md:text-[1.4rem] lg:text-[1.6rem] text-gray-900"><?= $row_artikel['judul'] ?></h4>
                                        <div class="flex gap-3">
                                            <p class="text-[0.8rem] text-gray-900"><?= date('d F Y', strtotime($row_artikel['date'])) ?></p>
                                            <p class="text-[0.8rem] text-blue-600">Oleh <?= $row_artikel['author'] ?></p>
                                        </div>
                                        <div class="md:flex hidden text-gray-900">
                                            <p class="text-[1rem] text-justify line-clamp-2"><?= substr($row_artikel['content'], 0, 250) . '...' ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:hidden flex text-gray-900">
                                <p class="text-[0.8rem]"><?= substr($row_artikel['content'], 0, 75) . '...' ?></p>
                            </div>
                        </div>
                    </a>
                <?php
                    if ($count < mysqli_num_rows($queryartikel)) { // Tampilkan <hr> jika bukan iterasi terakhir
                        echo '<hr class="w-[100%] md:w-[85%] mx-auto border-none h-1 bg-gray-500 rounded-full my-2">';
                    }
                }
                ?>
            </div>
        </section>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>