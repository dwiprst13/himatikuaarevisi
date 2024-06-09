<?php
require "../config.php";
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$user = "SELECT * FROM user";
$queryuser = mysqli_query($conn, $user);
include "sidebar.php";
?>


<h1>menu admin user</h1>
<?php
while ($row_user = mysqli_fetch_assoc($queryuser)) {
?>
    <div style="display: flex; width: full;">
        <p><?php echo $row_user['id_user'] ?></p>
        <p><?php echo $row_user['nama'] ?></p>
        <p><?php echo $row_user['username'] ?></p>
        <p><?php echo $row_user['email'] ?></p>
        <p><?php echo $row_user['phone'] ?></p>
    </div>
<?php
}
?>