<?php
require "config.php";
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}
$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    if (empty($nama) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($repassword)) {
        $error[] = "Semua form wajib diisi";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email tidak memenuhi format";
        exit;
    }
    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $error[] = "Nomor telepon hanya bisa berupa angka.";
        exit;
    }
    if ($password !== $repassword) {
        $error[] = "Password tidak sesuai.";
        exit;
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ? OR phone = ?");
    $stmt->bind_param("sss", $username, $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $error[] = "Username, email, or nomor telepon sudah digunakan.";
    } else {
        $stmt = $conn->prepare("INSERT INTO user (nama, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nama, $username, $email, $phone, $hashed_password);
        if ($stmt->execute()) {
            $success[] = "Data Anda sudah terdaftar";
            $_SESSION['success'] = $success;
            header("Location: login.php");
            exit;
        } else {
            $error[] = "Failed to save data.";
        }
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<title>Halaman Daftar</title>
</head>

<body>
    <h2>Daftar</h2>
    <?php
    if (!empty($error)) {
        echo '<div>' . implode(", ", $error) . '</div>';
    }
    ?>
    <form action="register.php" method="post">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="phone">Nomor HP:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="password">Ulangi Password:</label><br>
        <input type="password" id="repassword" name="repassword"><br>
        <input type="submit" value="Register">
    </form>
</body>

</html>