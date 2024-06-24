<?php
require "config.php"; // Pastikan file config.php berisi koneksi database Anda
session_start();

// Jika user sudah login, redirect ke index.php
if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}

$error = [];
$success = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone'] = $_POST['phone'];

    // Validasi input
    if (empty($nama) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($repassword)) {
        $error[] = "Semua form wajib diisi";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email tidak valid";
    }
    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $error[] = "Nomor telepon hanya bisa berupa angka (10-15 digit)";
    }
    if ($password !== $repassword) {
        $error[] = "Password tidak sesuai";
    }

    // Jika tidak ada error, lanjutkan proses registrasi
    if (empty($error)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah username, email, atau phone sudah terdaftar
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ? OR phone = ?");
        $stmt->bind_param("sss", $username, $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error[] = "Username, email, atau nomor telepon sudah digunakan";
        } else {
            // Jika belum terdaftar, lakukan insert data ke database
            $stmt = $conn->prepare("INSERT INTO user (nama, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nama, $username, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                $success[] = "Data Anda sudah terdaftar. Silakan login.";
                unset($_SESSION['nama']);
                unset($_SESSION['username']);
                unset($_SESSION['email']);
                unset($_SESSION['phone']);
            } else {
                $error[] = "Terjadi kesalahan saat menyimpan data. Silakan coba lagi nanti.";
            }
        }
        $stmt->close(); // Tutup statement setelah digunakan
    }
}

// Tutup koneksi database
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="asset/output.css" rel="stylesheet">
    <link rel="icon" href="public/image/logokabinet.png">
    <title>Daftar - HIMATIK UAA</title>
</head>

<body class="bg-white md:bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg md:shadow-lg w-full md:w-4/6 lg:w-1/3 h-full space-y-5">
        <h2 class="text-2xl font-bold mb-6 text-center">Daftar</h2>
        <?php if (!empty($error)) : ?>
            <div class="error bg-red-600 text-white rounded-lg p-1">
                <?php foreach ($error as $err) : ?>
                    <p><?php echo $err; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="success bg-green-600 text-white rounded-lg p-1">
                <?php foreach ($success as $msg) : ?>
                    <p><?php echo $msg; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="space-y-3">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required value="<?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : ''; ?>">
            </div>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan nama pengguna" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor HP:</label>
                <input type="text" id="phone" name="phone" placeholder="Masukkan nomor hp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" required value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : ''; ?>">
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