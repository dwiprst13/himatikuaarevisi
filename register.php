<?php
// Membuatkoneksi ke database
require "config.php";
session_start();
// Mengecek apakah user memiliki role sebagai admin
if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}
// Menyimpan pesan error
$error = [];

// fungsi untuk menyimpan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menginisialisasi variabel dengan value input form
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    // mengecek form yang kosong
    if (empty($nama) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($repassword)) {
        $error[] = "Semua form wajib diisi";
        exit;
    }
    // memvalidasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email tidak memenuhi format";
        exit;
    }
    // memvalidasi karakter input
    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $error[] = "Nomor telepon hanya bisa berupa angka.";
        exit;
    }
    // memvalidasi kecocokan password 
    if ($password !== $repassword) {
        $error[] = "Password tidak sesuai.";
        exit;
    }
    // hashing password untuk mengamankan pasword
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // membuat statement sql
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ? OR phone = ?");
    // binding statement
    $stmt->bind_param("sss", $username, $email, $phone);
    // mengeksekusi statement
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $error[] = "Username, email, or nomor telepon sudah digunakan.";
    } else {
        // prepared statement, bingung? google apa itu prepared statement
        $stmt = $conn->prepare("INSERT INTO user (nama, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        // melakukan binding antara variabel dan placeholder
        $stmt->bind_param("sssss", $nama, $username, $email, $phone, $hashed_password);
        // fungsi mengecek apakah statement sebelumnya sudah dilaksanakan
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