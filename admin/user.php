<?php
require "../config.php";
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$user = "SELECT * FROM user";
$queryuser = mysqli_query($conn, $user);

if (isset($_POST["hapus"])) {
    $id_user = $_POST['id_user'];
    $delete_user = mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");
    if ($delete_user) {
        echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
    } else {
        $alert = "<div class='alert alert-danger'>Error deleting user</div>";
    }
}
include "sidebar.php";
?>


<h1>Menu User</h1>
<?php
while ($row_user = mysqli_fetch_assoc($queryuser)) {
    $userId = $row_user['id_user'];
    $editUrl = 'user_edit.php?id_user=' . $userId;
?>
    <div class="flex gap-3">
        <p><?php echo $row_user['id_user'] ?></p>
        <p><?php echo $row_user['nama'] ?></p>
        <p><?php echo $row_user['username'] ?></p>
        <p><?php echo $row_user['email'] ?></p>
        <p><?php echo $row_user['phone'] ?></p>
        <a href="<?php echo $editUrl; ?>">Edit</a>
        <form action="" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
            <input type="hidden" name="id_user" value="<?= $row_user['id_user'] ?>">
            <button type="submit" name="hapus" class="mr-3 text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Hapus</button>
        </form>
    </div>
<?php
}
?>