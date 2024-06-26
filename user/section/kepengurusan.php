<section class="bg-white text-gray-900 items-center justify-center">
    <div data-aos="fade-up" data-aos-duration="1500" class="space-y-5 text-gray-900">
        <h2 class="text-center font-bold text-[1.6rem] md:text-[2rem] lg:text-[2.5rem] text-blue-700">Kepengurusan</h2>
        <div class="text-center p-5 rounded-2xl">
            <h2 class="text-[1.3rem] md:text-[1.6rem] lg:text-[1.9rem] font-bold text-center">Kepengurusan HIMATIK UAA Periode 2024/2025</h2>
            <div data-aos="fade-up" data-aos-duration="1500" class="pengurus-card">
                <?php
                include "./user/part/ketua.php";
                include "./user/part/pengurus.php";
                ?>
                <p class="text-center">Bosen sama muka muka mereka?</p>
            </div>
            <div class="w-full flex items-center justify-center">
                <button class="w-2/12 btn-open-pengurus-card p-2 text-white rounded-full bg-blue-600 hover:bg-blue-700 my-5">Kenali Kami Yuk</button>
                <button class="w-2/12 btn-close-pengurus-card p-2 text-white rounded-full bg-red-600 hover:bg-red-700 mt-5">Klik disini</button>
            </div>
        </div>
    </div>
    </div>

</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openButton = document.querySelector('.btn-open-pengurus-card');
        const closeButton = document.querySelector('.btn-close-pengurus-card');
        const pengurusCard = document.querySelector('.pengurus-card');
        closeButton.style.display = 'none';
        pengurusCard.style.display = 'none';

        openButton.addEventListener('click', function() {
            pengurusCard.style.display = 'block';
            openButton.style.display = 'none';
            closeButton.style.display = 'block'; 
        });

        closeButton.addEventListener('click', function() {
            pengurusCard.style.display = 'none'; 
            openButton.style.display = 'block'; 
            closeButton.style.display = 'none'; 
        });
    });
</script>