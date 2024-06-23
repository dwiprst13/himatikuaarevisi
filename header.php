<header class="bg-gray-900 sticky top-0 z-50">
    <div class="flex relative justify-between items-center h-20 w-[90%] md:w-[85%] mx-auto">
        <div class="md:w-1/3 justify-start">
            <h1><a class="text-white text-2xl font-bold" href="">HIMATIK UAA</a></h1>
        </div>
        <nav class="w-full md:w-1/3 justify-center nav-links duration-500 bg-gray-900 lg:static absolute lg:min-h-fit min-h-[60vh] left-0 top-[-800%] text-white flex items-center px-5">
            <ul class="flex w-[85%] flex-col md:justify-center md:mx-auto lg:flex-row lg:items-center gap-5 my-10 md:my-0">
                <?php
                $current_page = basename($_SERVER['PHP_SELF']); 
                ?>
                <li>
                    <a class="hover:text-gray-500 flex justify-between <?php if ($current_page == 'himatikuaa' || $current_page == 'index.php') echo 'text-blue-600'; ?>" href="/himatikuaa/">
                        <p>Beranda</p>
                        <div class="block md:hidden"><i class="fas fa-chevron-right"></i></div>
                    </a>
                </li>
                <hr class="block md:hidden">
                <li>
                    <a class="hover:text-gray-500 flex justify-between <?php if ($current_page == 'galeri.php') echo 'text-blue-600'; ?>" href="galeri.php">
                        <p>Galeri</p>
                        <div class="block md:hidden"><i class="fas fa-chevron-right"></i></div>
                    </a>
                </li>
                <hr class="block md:hidden">
                <li>
                    <a class="hover:text-gray-500 flex justify-between <?php if ($current_page == 'artikel.php') echo 'text-blue-600'; ?>" href="artikel.php">
                        <p>Artikel</p>
                        <div class="block md:hidden"><i class="fas fa-chevron-right"></i></div>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="md:w-1/3 justify-end flex items-center gap-4 text-white">
            <?php
            // mengecek apakah ada aktivitas sesi login berdasarkan id_user
            if (!isset($_SESSION['id_user'])) {
            ?>
                <a class="px-2 p-1 rounded-lg bg-blue-600" href="login.php">Login</a>
                <a class="px-2 p-1 rounded-lg bg-orange-600" href="register.php">Register</a>
            <?php
            } else { ?>
                <a class="px-2 p-1 rounded-lg bg-red-600" href="logout.php">logout</a>
            <?php
            }
            ?>
            <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl text-white cursor-pointer lg:hidden"></ion-icon>
        </div>
</header>
<script>
    const navLinks = document.querySelector('.nav-links')

    function onToggleMenu(e) {
        e.name = e.name === 'menu' ? 'close' : 'menu'
        navLinks.classList.toggle('top-1')
    }

    const logoutForm = document.querySelector('.logout-form');
    logoutForm.addEventListener('submit', function(event) {
        if (!confirm('Apakah Anda yakin ingin logout?')) {
            event.preventDefault();
        }
    });
</script>