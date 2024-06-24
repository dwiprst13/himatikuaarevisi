<?php
require '../config.php';
session_start();
// Mengecek apakah user mempunyai role sebagai admin atau SuperAdmin
if (!isset($_SESSION['id_user']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'SuperAdmin')) {
    header("Location: ../index.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'SuperAdmin') {
    $displayForm = 'style="display:none;"';
} else {
    $displayForm = '';
}

$error = [];
$success = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $role = trim($_POST['role']);
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
            // Jika belum terdaftar, lakukan insert data ke db
            $stmt = $conn->prepare("INSERT INTO user (nama, username, email, phone, role, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nama, $username, $email, $phone, $role, $hashed_password);
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
<main class="flex">
    <aside class="sticky top-0 left-0 w-1/6 h-screen bg-gray-100 shadow-lg">
        <div class="w-full">
            <?php include "sidebar.php"; ?>
        </div>
    </aside>
    <section class="w-5/6">
        <header class="bg-gray-900 w-[100%] sticky left-0 top-0">
            <nav class="h-16 w-[100%] flex mx-auto ">
                <div class="place-self-center p-5">
                    <h1 class="text-white font-bold">User</h1>
                </div>
            </nav>
        </header>
        <div class="p-4 flex">
            <h1 class="text-xl">
                Tambah User
            </h1>
        </div>
        <div class=" px-3 py-4 justify-between">
            <button class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                <a href="user.php">Kembali</a>
            </button>
        </div>
        <div class="p-4">
            <form action="" method="post" class="bg-white p-4 rounded-lg shadow-md border border-gray-200">
                <div class="mb-2">
                    <label for="nama" class="block text-gray-700 font-bold mb-2">Nama:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="nama" name="nama">
                </div>
                <div class="mb-2">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="username" name="username">
                </div>
                <div class="mb-2">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" id="email" name="email">
                </div>
                <div class="mb-2">
                    <label for="phone" class="block text-gray-700 font-bold mb-2">Nomor HP:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="phone" name="phone">
                </div>
                <div class="mb-2" <?php echo $displayForm; ?>>
                    <label for="role" class="block text-gray-700 font-bold mb-2">Role:</label>
                    <select id="role" name="role" class="block w-full rounded-md p-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="User">User</option>
                        <option value="SuperAdmin">SuperAdmin</option>
                        <option value="Admin">Admin</option>
                        <option value="Jurnalis">Jurnalis</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" id="password" name="password">
                </div>
                <div class="mb-5">
                    <label for="repassword" class="block text-gray-700 font-bold mb-2">Ulangi Password:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" id="repassword" name="repassword">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>