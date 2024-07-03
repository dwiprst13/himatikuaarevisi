<?php
session_start();
include "config.php";
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
    <section class="flex bg-green-300 text-gray-900 min-h-screen">
        <div class="text-[2.2rem] text-[#072748] bg-blue-300 w-[90%] mx-auto">
            <?php
            $queryartikel = mysqli_query($conn, "SELECT * FROM artikel");
            while ($row_artikel = mysqli_fetch_assoc($queryartikel)) {
            ?>
                <a href="artikel_detail.php?id_artikel=<?= $row_artikel['id_artikel'] ?>" class="w-[100%] md:w-[85%] mx-auto h-36 md:h-48 flex items-center bg-red-200">
                    <div class="h-full p-2 flex flex-col md:flex-row items-center bg-blue-200">
                        <div class="w-full flex flex-col items-center gap-3">
                            <div class="w-full">
                                <div class="flex gap-2 text-white text-[1rem] ">
                                    <?php
                                    $tags = explode(' ', $row_artikel['tag']);
                                    foreach ($tags as $tag) {
                                        if (strpos($tag, '#') === 0) {
                                            $tag = substr($tag, 1);
                                            echo '<p class="bg-green-600 rounded-full px-2">' . $tag . '</p>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="space-y-2">
                                    <h4 class="font-semibold text-[1.2rem] md:text-[1.4rem] lg:text-[1.6rem] text-gray-900"><?= $row_artikel['judul'] ?></h4>
                                    <div class="flex gap-3">
                                        <p class="text-[1rem]  text-gray-900"><?= date('d F Y', strtotime($row_artikel['date'])) ?></p>
                                        <p class="text-[1rem]  text-blue-600">Oleh <?= $row_artikel['author'] ?></p>
                                    </div>
                                    <div class="md:flex hidden text-gray-900">
                                        <p class="text-[1rem] "><?= substr($row_artikel['content'], 0, 350) . '...' ?></p>
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
            }
            ?>
        </div>
    </section>
    <?php
    include "footer.php";
    ?>
</body>

</html>