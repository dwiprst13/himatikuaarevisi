<section class="w-[100%] mx-auto py-10 bg-gray-900">
    <div data-aos="fade-up" data-aos-duration="1500" class="w-[95%] mx-auto md:w-[90%] p-3 md:p-5">
        <h2 class="font-bold text-[1.6rem] md:text-[2rem] lg:text-[2.5rem] text-blue-700 my-5">Hubungi Kami</h2>
        <p class="text-white">
            Anda ingin menghubungi kami? Silahkan kirim pesan dengan klik tombol dibawah ini
        </p>
        <form action="mailto:dwiprast01@gmail.com" method="POST" enctype="text/plain" class="text-white">
            <form action="/submitMessage" method="POST" class="text-white">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium py-2 text-white">Nama:</label>
                    <input type="text" id="name" name="name" autocomplete="off" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-none sm:text-sm autofill:bg-none">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium py-2 text-white">Email:</label>
                    <input type="email" id="email" name="email" required autocomplete="off" class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm autofill:bg-none">
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium py-2 text-white">Pesan:</label>
                    <textarea id="content" name="content" rows="4" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white rounded-full px-5 py-1 focus:outline-none">
                        Kirim Pesan <i class="fa fa-paper-plane"></i>
                    </button>
                </div>
            </form>
    </div>
    </div>
</section>