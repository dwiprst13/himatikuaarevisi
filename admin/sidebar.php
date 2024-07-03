<?php
$role = $_SESSION['role'];
$current_page = basename($_SERVER['PHP_SELF']); // Mendapatkan nama file halaman saat ini
$role = $_SESSION['role']; // Mengambil peran dari session
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMATIK UAA - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<aside class="w-full flex flex-col bg-gray-900 text-white h-screen justify-around p-3">
    <h2 class="text-center text-[1.4rem] font-bold">Himatik Admin</h2>
    <nav class="flex flex-col gap-5">
        <a class="w-full text-center rounded-lg p-2 <?php echo ($current_page == 'dashboard.php' ? 'bg-blue-600' : 'bg-gray-500'); ?>" href="dashboard.php">Dashboard</a>
        <?php if ($role == 'SuperAdmin' || $role == 'Admin') : ?>
            <a class="w-full text-center rounded-lg p-2 <?php echo (strpos($current_page, 'user') !== false ? 'bg-blue-600' : 'bg-gray-500'); ?>" href="user.php">User</a>
        <?php endif; ?>
        <a class="w-full text-center rounded-lg p-2 <?php echo (strpos($current_page, 'galeri') !== false ? 'bg-blue-600' : 'bg-gray-500'); ?>" href="galeri.php">Galeri</a>
        <a class="w-full text-center rounded-lg p-2 <?php echo (strpos($current_page, 'artikel') !== false ? 'bg-blue-600' : 'bg-gray-500'); ?>" href="artikel.php">Artikel</a>
        <a class="w-full text-center rounded-lg p-2 <?php echo (strpos($current_page, 'komentar') !== false ? 'bg-blue-600' : 'bg-gray-500'); ?>" href="komentar.php">Komentar</a>
    </nav>


    <a class="w-full text-center bg-red-600 p-2 rounded-lg" href="../logout.php">logout</a>
</aside>