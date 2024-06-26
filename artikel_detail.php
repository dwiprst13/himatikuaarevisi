<?php
session_start();
include "config.php";
$id_artikel = $_GET['id_artikel'];

$dataArtikel = mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel='$id_artikel'");
$artikel = mysqli_fetch_assoc($dataArtikel);

$queryKomentar = mysqli_query($conn, "SELECT * FROM komentar WHERE id_artikel = '$id_artikel'");
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
    <section class="flex bg-gray-900 text-white min-h-screen">
        <div class="fle">
            <h3><?= $artikel['judul']; ?></h3><br>
            <p><?= $artikel['content']; ?></p>
            <p><?= $artikel['date']; ?></p>
            <div>
                <h3>Komentar</h3>
                <?php
                while ($row_komentar = mysqli_fetch_assoc($queryKomentar)) {
                ?>
                    <p><?= $row_komentar['komentar']; ?></p>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    include "footer.php";
    ?>
</body>

</html>