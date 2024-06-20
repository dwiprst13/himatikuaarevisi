<?php
require "../config.php";
session_start();

// fungsi untuk melakukan hapus data
if (isset($_POST["hapus"])) {
    $id_user = $_POST['id_user'];
    $delete_user = mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");
    if ($delete_user) {
        echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
    } else {
        $alert = "Terjadi kesalahan saat menghapus data user";
    }
}
?>

<main class="flex">
    <?php
    include "sidebar.php";
    ?>
    <section class="w-5/6">
        <header class="bg-gray-900 w-[100%] sticky left-0 top-0">
            <nav class="h-16 w-[100%] flex mx-auto ">
                <div class="place-self-center p-5">
                    <h1 class="text-white font-bold">User</h1>
                </div>
            </nav>
        </header>
        <div class="flex flex-col pt-20 space-y-5">
            <div class="flex justify-between w-[95%] mx-auto items-center">
                <h3 class="text-[1.5rem]">Daftar User</h3>
                <a href="user_tambah.php" class="p-2 bg-blue-600 rounded-lg text-white">Tambah</a>
            </div>
            <table class="w-[95%] mx-auto text-md table-auto bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="bg-gray-500 text-white">
                        <td class="p-3 text-center px-5">ID</th>
                        <td class="p-3 text-center px-5">Nama</th>
                        <td class="p-3 text-center px-5">Username</th>
                        <td class="p-3 text-center px-5">Email</th>
                        <td class="p-3 text-center px-5">Nomor Telepon</th>
                        <td class="p-3 text-center px-5">Role</th>
                        <td class="p-3 text-center px-5">Aksi</th>
                    </tr>
                    <?php
                    // Melakukan query data dari tabel user
                    $queryuser = mysqli_query($conn, "SELECT * FROM user");
                    // looping untuk menampilkan seluruh data yang berhasil di fetch
                    while ($row_user = mysqli_fetch_assoc($queryuser)) {
                    ?>
                        <tr>
                            <td class="p-3 text-center px-5"><?= $row_user['id_user'] ?></td>
                            <td class="p-3 text-center px-5"><?= $row_user['nama'] ?></td>
                            <td class="p-3 text-center px-5"><?= $row_user['username'] ?></td>
                            <td class="p-3 text-center px-5"><?= $row_user['email'] ?></td>
                            <td class="p-3 text-center px-5"><?= $row_user['phone'] ?></td>
                            <td class="p-3 text-center px-5"><?= $row_user['role'] ?></td>
                            <td class="p-3 text-center px-5 flex justify-between">
                                <form action="user_edit.php" method="get">
                                    <input type="hidden" name="page" value="edit_user">
                                    <input type="hidden" name="id_user" value="<?= $row_user['id_user'] ?>">
                                    <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</button>
                                </form>
                                <form action="" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
                                    <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                                    <button type="submit" name="hapus" class="mr-3 text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>