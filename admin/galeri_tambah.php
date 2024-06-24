<?php
require "../config.php";
session_start();

// Mengecek apakah user mempunyai role sebagai admin atau SuperAdmin
if (!isset($_SESSION['id_user']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'SuperAdmin' && $_SESSION['role'] !== 'Jurnalis')) {
    header("Location: ../index.php");
    exit;
}

// fungsi untuk memasukkan data galeri ke database
if (isset($_POST["submit"])) {
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    // target dimana gambar akan disimpan didalam projek
    $target_dir = "../public/image/uploads/galeri/";
    // menamai foto/file sesuai dengan nama asli
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    // memindahkan file kedalam ditrektori tujuan
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    // memasukkan data kedalam tabel galeri database
    $sql = "INSERT INTO galeri (img, judul, deskripsi) VALUES ('$target_file', '$judul', '$deskripsi')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location='?page=galeri';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
    }
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
                Tambah Galeri
            </h1>
        </div>
        <div class=" px-3 py-4 justify-between">
            <button class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                <a href="galeri.php">Kembali</a>
            </button>
        </div>
        <div class="sm:mx-auto sm:w-full">
            <form class="w-[90%] mx-auto pb-32" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="grid grid-cols-12 flex gap-5 p-5">
                    <div class="col-span-6">
                        <div class="mx-auto w-[100%]">
                            <label for="judul" class="block text-sm   font-medium leading-6 ">Judul</label>
                            <div class="mt-2">
                                <input id="judul" name="judul" type="text" autocomplete="off" placeholder="Judul" required class="block w-[100%]  rounded-md border-0 py-1.5 px-2 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mx-auto w-[100%]  ">
                            <label for="deskripsi" class="block text-sm font-medium leading-6 ">Deskripsi</label>
                            <div class="mt-2">
                                <textarea id="deskripsi" name="deskripsi" rows="2" cols="50" type="text" placeholder="Deskripsi Gambar" autocomplete="off" required class="block w-[100%] rounded-md border-0 py-1.5 px-2 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                        <div class="mx-auto w-[100%]">
                            <label for="foto" class="block text-sm font-medium leading-6 ">Gambar</label>
                            <div class="mt-2">
                                <input id="foto" name="foto" type="file" autocomplete="" multiple onchange="readURL(this)" required accept="image/*" class=" block w-[100%] p-5 file:mr-4 file:py-1 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-violet-100 file:cursor-pointer rounded-md border-0 py-1.5 px-2 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="flex col-span-6 mx-auto w-[100%] rounded-md bg-gray-300 justify-center items-center mx-auto">
                        <img src="" alt="Belum Ada Gambar" id="img" class="">
                    </div>
                </div>
                <div class="mx-auto w-[100%] p-5">
                    <button type="submit" name="submit" class="flex w-[35%] justify-center rounded-md mx-auto bg-blue-500 px-3 py-1.5 px-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kirim</button>
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
                img.style.height = '150px'; // Set tinggi default
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            img.removeAttribute("src"); // Hapus atribut src jika tidak ada file dipilih
            img.style.height = 'auto'; // Set tinggi ke auto untuk menyesuaikan tinggi teks
        }
    }
</script>