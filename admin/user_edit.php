<?php
require '../config.php';
session_start();
// Mengecek apakah user mempunyai role sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Mengambil id_user dari url
$id_user = $_GET['id_user'];

// melakukan query data user berdasarkan id_user
$result = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");
$row = mysqli_fetch_assoc($result);

// fungsi untuk melakukan update data
if (isset($_POST["submit"])) {
    $new_nama = $_POST['new_nama'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_phone = $_POST['new_phone'];

    // mengecek apakah form password ada isinya atau tidak
    if (!empty($_POST['new_password'])) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    } else {
        $new_password = $row['password'];
    }

    $update_user = $conn->prepare("UPDATE user SET nama=?, username=?, email=?, phone=?, password=? WHERE id_user=?");
    $update_user->bind_param("ssssss", $new_nama, $new_username, $new_email, $new_phone, $new_password, $id_user);

    // output 
    if ($update_user->execute()) {
        echo "<script>window.location.href = '?page=edit_user&id_user=$id_user';</script>";
    } else {
        echo "Error updating user: " . $conn->error;
    }
    $update_user->close();
}
?>

<main class="flex">
    <?php
    include "sidebar.php";
    ?>
    <div class="w-5/6">
        <form action="" method="post">
            <label for="nama">Nama:</label><br>
            <input class="border border-black" type="text" id="new_nama" name="new_nama" value="<?php echo $row['nama']; ?>"><br>
            <label for="username">Username:</label><br>
            <input class="border border-black" type="text" id="new_username" name="new_username" value="<?php echo $row['username']; ?>"><br>
            <label for="email">Email:</label><br>
            <input class="border border-black" type="email" id="new_email" name="new_email" value="<?php echo $row['email']; ?>"><br>
            <label for="phone">Nomor HP:</label><br>
            <input class="border border-black" type="text" id="new_phone" name="new_phone" value="<?php echo $row['phone']; ?>"><br>
            <label for="password">Password:</label><br>
            <input class="border border-black" type="password" id="new_password" name="new_password"><br>
            <label for="password">Ulangi Password:</label><br>
            <input class="border border-black" type="password" id="new_repassword" name="new_repassword"><br>
            <button class="border border-black" type="submit" name="submit">Submit</button>
        </form>
    </div>
</main>