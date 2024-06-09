<header class="flex h-20 bg-gray-900 text-white fixed top-0 left-0 w-full">
    <div class="flex items-center justify-between w-[85%] mx-auto">
        <h2>HIMATIK UAA</h2>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="galeri.php">Galeri</a>
            <a href="artikel.php">Artikel</a>
            <a href="kontak.php">Kontak</a>
        </nav>
        <div>
            <?php
            if (!isset($_SESSION['id_user'])) {
            ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php
            }
            if (isset($_SESSION['id_user'])) { ?>
                <a href="logout.php">logout</a>
            <?php
            }
            ?>
        </div>
    </div>
</header>