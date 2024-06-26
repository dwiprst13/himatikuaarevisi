<?php
require "../config.php";
session_start();
// Mengecek apakah user mempunyai role sebagai admin atau SuperAdmin
if (!isset($_SESSION['id_user']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'SuperAdmin')) {
    header("Location: ../index.php");
    exit;
}

// fungsi untuk melakukan hapus data
if (isset($_POST["hapus"])) {
    $id_user = $_POST['id_user'];

    // Prepared statement
    $stmt = $conn->prepare("DELETE FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user); // "i" untuk integer

    if ($stmt->execute()) {
        echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
    } else {
        echo "Terjadi kesalahan saat menghapus data user: " . $stmt->error; // Tampilkan pesan error dari MySQL
    }

    $stmt->close();
}

?>

<main class="flex">
    <aside class="sticky top-0 left-0 w-1/6 h-screen bg-gray-100 shadow-lg">
        <div class="w-full">
            <?php include "sidebar.php"; ?>
        </div>
    </aside>
    <section class="w-5/6">
        <header class="bg-gray-900 w-[100%] sticky left-0 top-0">
            <nav class="h-16 w-[100%] flex mx-auto ">
                <div class="place-self-center p-5">
                    <h1 class="text-white font-bold">Komentar</h1>
                </div>
            </nav>
        </header>
        <div class="flex flex-col pt-20 space-y-5">
            <div class="flex justify-between w-[95%] mx-auto items-center">
                <h3 class="text-[1.5rem]">Daftar Komentar</h3>
            </div>
        </div>
    </section>
</main>