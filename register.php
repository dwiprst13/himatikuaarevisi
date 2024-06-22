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
        // $error[] = "Username, email, or nomor telepon sudah digunakan.";
        echo "Username, email, or nomor telepon sudah digunakan.";
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
            // $error[] = "Failed to save data.";
            echo "Error Brooooo!!!!";
        }
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
    <link href="asset/output.css" rel="stylesheet">
</head>

<body class="bg-white md:bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg md:shadow-lg w-full md:w-4/6 lg:w-1/3 h-full space-y-5">
        <h2 class="text-2xl font-bold mb-6 text-center">Daftar</h2>
        <?php
        if (!empty($error)) {
            echo '<div class="bg-red-100 text-red-800 p-4 rounded mb-4">' . implode(", ", $error) . '</div>';
        }
        ?>
        <form action="" method="post" class="space-y-3">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required>
            </div>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan nama pengguna" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required>
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor HP:</label>
                <input type="text" id="phone" name="phone" placeholder="Masukkan nomor hp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" name="password" placeholder="Buat password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required>
            </div>
            <div>
                <label for="repassword" class="block text-sm font-medium text-gray-700">Ulangi Password:</label>
                <input type="password" id="repassword" name="repassword" placeholder="Ulangi password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required>
            </div>
            <div>
                <button type="submit" value="POST" class="w-full flex justify-center py-2 px-4 border border-transparent rounded shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Register</button>
            </div>
        </form>
        <p>Sudah punya akun? <a class="text-blue-600" href="login.php">Masuk</a></p>
    </div>
</body>

</html>