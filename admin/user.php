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
    <div class="w-5/6">
        <table class="w-full text-md table-auto bg-white shadow-md rounded mb-4">
            <tbody>
                <tr class="bg-gray-500 text-white">
                    <td class="p-3 text-center px-5">ID</th>
                    <td class="p-3 text-center px-5">Nama</th>
                    <td class="p-3 text-center px-5">Username</th>
                    <td class="p-3 text-center px-5">Email</th>
                    <td class="p-3 text-center px-5">Nomor Telepon</th>
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
                        <td class="flex items-center justify-center">
                            <div class="flex gap-2 items-center">
                                <form action="user_edit.php" method="get">
                                    <input type="hidden" name="id_user" value="<?= $row_user['id_user'] ?>">
                                    <button type="submit" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</button>
                                </form>
                                <form action="" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
                                    <input type="hidden" name="id_user" value="<?= $row_user['id_user'] ?>">
                                    <button type="submit" name="hapus" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>