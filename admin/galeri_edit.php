<?php
require "../config.php";
session_start();

// Mengecek apakah user mempunyai role sebagai admin atau SuperAdmin
if (!isset($_SESSION['id_user']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'SuperAdmin' && $_SESSION['role'] !== 'Jurnalis')) {
    header("Location: ../index.php");
    exit;
}

// fungsi untuk melakukan hapus data
if (isset($_POST["hapus"])) {
    $id_galeri = $_POST['id_galeri'];

    // Prepared statement
    $stmt = $conn->prepare("DELETE FROM galeri WHERE id_galeri = ?");
    $stmt->bind_param("i", $id_galeri); // "i" untuk integer

    if ($stmt->execute()) {
        header("Location: galeri.php");
        exit;
    } else {
        echo "Terjadi kesalahan saat menghapus data galeri: " . $stmt->error; // Tampilkan pesan error dari MySQL
    }

    $stmt->close();
}

$id_gambar = $_GET["id_galeri"];
// fungsi untuk memasukkan data galeri ke database
if (isset($_POST["submit"])) {
    $id_galeri = $id_gambar;
    $new_judul = $_POST["new_judul"];
    $new_deskripsi = $_POST["new_deskripsi"];

    // Check if a new image has been uploaded
    if (!empty($_FILES["new_foto"]["name"])) {
        $target_dir = "../public/image/uploads/galeri/";
        $target_file = $target_dir . basename($_FILES["new_foto"]["name"]);
        move_uploaded_file($_FILES["new_foto"]["tmp_name"], $target_file);
        $new_img = $target_file;
    } else {
        $sql_old_img = "SELECT img FROM galeri WHERE id_galeri = $id_galeri";
        $result = $conn->query($sql_old_img);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_img = $row["img"];
        } else {
            $new_img = "";
        }
    }

    $sql = "UPDATE galeri SET img = '$new_img', judul = '$new_judul', deskripsi = '$new_deskripsi' WHERE id_galeri = $id_galeri";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['update_success'] = true;
        header("Location: galeri_edit.php?id_galeri=$id_galeri");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
    }
}

$result = mysqli_query($conn, "SELECT * FROM galeri WHERE id_galeri='$id_gambar'");
$row = mysqli_fetch_assoc($result);

$update_success = false;
if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    $update_success = true;
    // Unset the session flag to avoid showing the alert again on refresh
    unset($_SESSION['update_success']);
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
                    <h1 class="text-white font-bold">Galeri</h1>
                </div>
            </nav>
        </header>
        <div class="p-4 flex">
            <h1 class="text-xl">
                Edit Galeri
            </h1>
        </div>
        <div class=" px-3 py-4 justify-between flex">
            <div>
                <button onclick="window.location.href='galeri.php'" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                    Kembali
                </button>
            </div>
            <form action="" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus Gambar ini?');">
                <input type="hidden" name="id_galeri" value="<?= $id_gambar ?>">
                <button type="submit" name="hapus" class="mr-3 text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                    Hapus
                </button>
            </form>
        </div>
        <div class="sm:mx-auto sm:w-full">
            <form class="w-[90%] mx-auto pb-32" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="grid grid-cols-12 gap-5 p-5">
                    <div class="col-span-6">
                        <div class="mx-auto w-[100%]">
                            <label for="new_judul" class="block text-sm   font-medium leading-6 ">Judul</label>
                            <div class="mt-2">
                                <input id="new_judul" name="new_judul" type="text" autocomplete="off" placeholder="Judul" required class="block w-[100%]  rounded-md border-0 py-1.5 px-2 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?= $row['judul'] ?>">
                            </div>
                        </div>
                        <div class="mx-auto w-[100%]  ">
                            <label for="new_deskripsi" class="block text-sm font-medium leading-6 ">Deskripsi</label>
                            <div class="mt-2">
                                <textarea id="new_deskripsi" name="new_deskripsi" rows="2" cols="50" type="text" placeholder="Deskripsi Gambar" autocomplete="off" required class="block w-[100%] rounded-md border-0 py-1.5 px-2 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $row['deskripsi'] ?></textarea>
                            </div>
                        </div>
                        <div class="mx-auto w-[100%]">
                            <label for="new_foto" class="block text-sm font-medium leading-6 ">Gambar</label>
                            <div class="mt-2">
                                <input id="new_foto" name="new_foto" type="file" autocomplete="" multiple onchange="readURL(this)" accept="image/*" class=" block w-[100%] p-5 file:mr-4 file:py-1 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-violet-100 file:cursor-pointer rounded-md border-0 py-1.5 px-2 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="flex col-span-6 mx-auto w-[100%] rounded-md bg-gray-300 justify-center items-center">
                        <img src="<?= isset($row['img']) ? $row['img'] : ''; ?>" alt="Belum Ada Gambar" id="img" class="">
                    </div>
                </div>
                <div class="mx-auto w-[100%] p-5">
                    <button type="submit" name="submit" class="flex w-[35%] justify-center rounded-md mx-auto bg-blue-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kirim</button>
                </div>
            </form>
        </div>
        </div>
</main>
<script>
    function readURL(input) {
        var img = document.querySelector("#img");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.setAttribute("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            gambarText.style.display = "block";
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($update_success) : ?>
            alert('Data berhasil diupdate!');
        <?php endif; ?>
    });
</script>