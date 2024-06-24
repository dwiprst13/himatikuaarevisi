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
    $new_role = $_POST['new_role'];

    // mengecek apakah form password ada isinya atau tidak
    if (!empty($_POST['new_password'])) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    } else {
        $new_password = $row['password'];
    }
    // prepared statement, menyiapkan statement sql
    // $update_user = $conn->prepare("UPDATE user SET nama=?, username=?, email=?, phone=?, role=?, password=? WHERE id_user=?");
    // melakuklan binding variabel dan placeholder
    // $update_user->bind_param("sssssss", $new_nama, $new_username, $new_email, $new_phone, $new_role, $new_password, $id_user);

    if ($_SESSION['role'] === 'SuperAdmin') {
        // Jika SuperAdmin, gunakan query update dengan role
        $update_user = $conn->prepare("UPDATE user SET nama=?, username=?, email=?, phone=?, role=?, password=? WHERE id_user=?");
        $update_user->bind_param("sssssss", $new_nama, $new_username, $new_email, $new_phone, $new_role, $new_password, $id_user);
    } else {
        // Jika bukan SuperAdmin, gunakan query update tanpa role
        $update_user = $conn->prepare("UPDATE user SET nama=?, username=?, email=?, phone=?, password=? WHERE id_user=?");
        $update_user->bind_param("sssssi", $new_nama, $new_username, $new_email, $new_phone, $new_password, $id_user);
    }

    // output 
    if ($update_user->execute()) {
        $_SESSION['update_success'] = true;
        header("Location: user_edit.php?id_user=$id_user");
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }
    $update_user->close();
}
$update_success = false;
if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    $update_success = true;
    // Unset the session flag to avoid showing the alert again on refresh
    unset($_SESSION['update_success']);
}
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
                Edit User
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
                    <label for="new_nama" class="block text-gray-700 font-bold mb-2">Nama:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="new_nama" name="new_nama" value="<?php echo $row['nama']; ?>">
                </div>
                <div class="mb-2">
                    <label for="new_username" class="block text-gray-700 font-bold mb-2">Username:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="new_username" name="new_username" value="<?php echo $row['username']; ?>">
                </div>
                <div class="mb-2">
                    <label for="new_email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" id="new_email" name="new_email" value="<?php echo $row['email']; ?>">
                </div>
                <div class="mb-2">
                    <label for="new_phone" class="block text-gray-700 font-bold mb-2">Nomor HP:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="new_phone" name="new_phone" value="<?php echo $row['phone']; ?>">
                </div>
                <div class="mb-2" <?php echo $displayForm; ?>>
                    <label for="new_role" class="block text-gray-700 font-bold mb-2">Role:</label>
                    <select id="new_role" name="new_role" class="block w-full rounded-md p-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="User" <?= $row['role'] == 'User' ? 'selected' : '' ?>>User</option>
                        <option value="SuperAdmin" <?= $row['role'] == 'SuperAdmin' ? 'selected' : '' ?>>SuperAdmin</option>
                        <option value="Admin" <?= $row['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Jurnalis" <?= $row['role'] == 'Jurnalis' ? 'selected' : '' ?>>Jurnalis</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="new_password" class="block text-gray-700 font-bold mb-2">Password:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" id="new_password" name="new_password">
                </div>
                <div class="mb-5">
                    <label for="new_repassword" class="block text-gray-700 font-bold mb-2">Ulangi Password:</label>
                    <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" id="new_repassword" name="new_repassword">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($update_success) : ?>
            alert('Data berhasil diupdate!');
        <?php endif; ?>
    });
</script>