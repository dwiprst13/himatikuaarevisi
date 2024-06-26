<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMATIK UAA</title>
    <!-- <link rel="stylesheet" href="asset/output.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="icon" href="public/image/logokabinet.png">
    <script src="../assets/js/script.js" defer></script>
</head>

<body>
    <?php
    // include merupakan sebuah aktivitas untuk menyertakan atau menyisipkan suatu file lain kedalam file tersebut
    include "header.php";
    include "user/section/banner.php";
    include "user/section/about.php";
    include "user/section/kepengurusan.php";
    include "user/section/galeri.php";
    include "user/section/artikel.php";
    include "user/section/kontak.php";
    include "footer.php";
    ?>
</body>

</html>