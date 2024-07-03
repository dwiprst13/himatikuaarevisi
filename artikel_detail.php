<?php
session_start();
include "config.php";
// ... (koneksi database) ...
function slugToTitle($slug)
{
    return str_replace('-', ' ', $slug);
}
$judul_artikel = slugToTitle(urldecode(basename($_SERVER['REQUEST_URI'])));

$query = "SELECT * FROM artikel WHERE judul = '$judul_artikel'";
$result = mysqli_query($conn, $query);
$artikel = mysqli_fetch_assoc($result);
$id_artikel = $artikel['id_artikel'];
$queryKomentar = mysqli_query($conn, "SELECT * FROM komentar WHERE id_artikel = '$id_artikel'");

// Filter Konten
$konten = $artikel['content'];
$konten = str_replace('<img src="../../uploads/gambar/', '<img class="h-60 mx-auto rounded-md object-cover my-5" src="/uploads/gambar/', $konten);
$konten = str_replace('<h2', '<h2 class="text-[1.7rem] font-bold"', $konten);
$konten = str_replace('<p>', '<p class="text-justify my-2"> ', $konten);
$konten = str_replace('width="300" height="168"', '', $konten);
$konten = str_replace('width="300" height="200"', '', $konten);
$konten = str_replace('<ul>', '<table class="pl-3">', $konten);
$konten = str_replace('</ul>', '</table>', $konten);
$konten = str_replace('<li>', '<tr class="flex gap-4"><td class="font-semibold">-</td><td>', $konten);
$konten = str_replace('</li>', '</td></tr>', $konten);
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
    <main class="bg-white">
        <section class="w-[100%] md:w-[90%] lg:w-[85%] flex mx-auto justify-center text-gray-900">
            <div class="md:w-[70%] p-2 pt-5 pb-10 rounded-lg ">
                <div class="text-gray-900 flex gap-2 text-[0.9rem] md:text-[1rem] lg:text-[1.1rem}">
                    <a href="/artikel">Artikel </a>
                    <span> / </span>
                    <p>Detail Artikel </p>
                    <span> / </span>
                    <p> <?= substr($artikel['judul'], 0, 15) . '...' ?></p>
                </div>
                <article class="px-3 py-3">
                    <h1 class="text-center pt-3 text-[2rem] md:text-[2.5rem]"><b><?= $artikel['judul'] ?></b></h1>
                    <div class="block md:flex text-[0.8rem] md:text-[0.9rem] my-2 space-x-0 md:space-x-2">
                        <div class="flex gap-2">
                            <p>Ditulis Oleh <span class="text-blue-600"><?= $artikel['author'] ?></span></p>
                            <p> / </p>
                            <p> <?= $artikel['date'] ?></p>
                        </div>
                        <p class="hidden md:block">/</p>
                        <div class="flex gap-1 text-gray-900">
                            <p>Keywords:</p>
                            <?php
                            $tags = explode(' ', $artikel['tag']);
                            foreach ($tags as $tag) {
                                if (strpos($tag, '#') === 0) {
                                    $tag = substr($tag, 1);
                                    echo '<p>' . $tag . '</p>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <img src="<?= $artikel['img'] ?>" alt="" class="h-60 md:h-72 lg:h-80 mt-5 mx-auto object-cover">
                    <p class="text-center text-gray-400 pt-1 pb-5">Gambar <?= $artikel['judul'] ?></p>
                    <p class="text-justify text-[1rem] pt-3"><?= $konten ?></p>
                </article>
            </div>
        </section>
        <section id="komentar" class="w-[100%] md:w-[85%] lg:w-[75%] mx-auto text-gray-900">
            <div class="md:w-[70%] mx-auto">
                <hr>
                <h3 class="px-3 py-3 text-[2rem]">Komentar</h3>
                <section id="komentar" class="w-full px-3 space-y-5">
                    <?php
                    if (isset($_SESSION['id_user']) && isset($_POST['submit'])) {
                        $idArtikel = (int)$_POST['id_artikel'];
                        $idUser = (int)$_SESSION['id_user'];
                        $komentar = htmlspecialchars(trim($_POST['komentar']));
                        if (empty($komentar)) {
                            echo "<p class='text-red-500'>Komentar tidak boleh kosong.</p>";
                        } else {
                            $sql = "INSERT INTO komentar (id_artikel, id_user, komentar) VALUES (?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("iis", $idArtikel, $idUser, $komentar);

                            if ($stmt->execute()) {
                                echo "<p class='text-green-500'>Komentar berhasil disimpan.</p>";
                            } else {
                                echo "<p class='text-red-500'>Terjadi kesalahan: " . $stmt->error . "</p>";
                            }

                            $stmt->close();
                        }
                    }
                    ?>
                    <?php if (isset($_SESSION['id_user'])) : ?>
                        <form action="" method="POST" class="flex gap-5">
                            <input type="hidden" name="id_artikel" value="<?php echo $artikel['id_artikel']; ?>">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                            <div class="flex gap-3 w-full">
                                <img src="" alt="" class="w-12 h-12 bg-gray-500 flex items-center text-center">
                                <textarea name="komentar" id="komentar" cols="30" class="p-2 w-full rounded-lg bg-gray-100 text-gray-900 placeholder:text-gray-700 focus:outline-none focus:border-none" placeholder="Komentar sebagai <?php echo $_SESSION['username']; ?>"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button id="submit" name="submit" class="bg-blue-600 text-white focus:outline-none rounded-lg p-2 px-4 h-fit w-fit">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    <?php else : ?>
                        <div class="text-[1.5rem] text-center text-gray-500">
                            <p>Masuk dengan akun anda terlebih dahulu untuk berkomentar.</p>
                        </div>
                    <?php endif; ?>
                    <div class="">
                        <p>Komentar Lainnya</p>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM komentar WHERE id_artikel = ? ORDER BY id_komentar DESC");
                        $stmt->bind_param("i", $artikel['id_artikel']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmtUsername = $conn->prepare("SELECT username FROM user WHERE id_user = ?");
                        while ($row = $result->fetch_assoc()) {
                            if ($result->num_rows > 0) {
                                $id_user = $row['id_user'];
                                $stmtUsername->bind_param("i", $id_user);
                                $stmtUsername->execute();
                                $resultUsername = $stmtUsername->get_result();
                                $rowUsername = $resultUsername->fetch_assoc();
                                if ($rowUsername) {
                        ?>
                                    <div class="bg-gray-300 rounded-md my-2 p-2">
                                        <div class="flex justify-between text-[0.9rem]">
                                            <p class=""><?= $rowUsername['username'] ?></p>
                                            <p class=""><?= $row['date'] ?></p>
                                        </div>
                                        <p class="bg-gray-100 rounded-md p-1"><?= $row['komentar'] ?></p>
                                    </div>
                        <?php
                                } else {
                                    echo "<p class=''>Unknown User</p>";
                                    echo "<p class=''>{$row['komentar']}</p>";
                                }
                            } else {
                                echo "<p>Belum ada komentar.</p>";
                            }
                        }

                        // Close both statements
                        $stmt->close();
                        $stmtUsername->close();

                        ?>
                    </div>
                </section>
            </div>
        </section>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>