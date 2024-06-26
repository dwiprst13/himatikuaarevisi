<?php
// Memanggil koneksi database 
require "config.php";
session_start();

// Mencegah user yang sudah punya sesi login untuk mengakses halaman ini (simple auth)
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
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            // memastikan role user apa
            $allowedRoles = ['Admin', 'SuperAdmin', 'Jurnalis'];
            if (in_array($user['role'], $allowedRoles)) {
                $_SESSION['show_popup'] = true; 
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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/image/logokabinet.png">
    <title>Login - HIMATIK UAA</title>
    <link href="asset/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md space-y-5">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form action="" method="post" class="space-y-3">
            <div>
                <label for="auth" class="block text-sm font-medium text-gray-700">Masukkan username, email atau nomor telepon:</label>
                <input type="text" placeholder="Username, email atau nomor telepon" id="auth" name="auth" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" autocomplete="off" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" placeholder="Password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none sm:text-sm" autocomplete="off" required>
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Login</button>
            </div>
        </form>
        <p>Belum punya akun? <a class="text-blue-600" href="register.php">Daftar</a></p>
    </div>
</body>

</html>