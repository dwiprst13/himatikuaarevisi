<?php
// Memanggil koneksi database 
require "config.php";
session_start();

// Mencegah user yang sudah punya sesi login untuk mengakses halaman ini
if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}
// Fungsi untuk melakukan login user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auth = trim($_POST['auth']);
    $password = $_POST['password'];
    // Mengecek apakah semua form telah diisi
    if (empty($auth) || empty($password)) {
        echo "Isi semua form tersebut";
        exit;
    }

    // Membuat sebuah statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ? OR phone = ?");
    $stmt->bind_param("sss", $auth, $auth, $auth);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) { // Melakukan verifikasi password di db dengan form password
            session_start();
            // Menyimpan data sesi user kedalam session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            // memastikan role user apa
            if ($user['role'] == 'admin'){
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "Password salah";
        }
    } else {
        echo "akun dengan data tersebut tidak ditemukan";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

<form action="" method="post">
    <label for="username">Masukkan username, email atau nomor telepon:</label>
    <input type="text" id="auth" name="auth" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>