    <h3 class="text-[1.2rem] md:text-[1.3rem] lg:text-[1.5rem] font-bold text-center my-2 md:my-3 bg-gray-900 text-white rounded-xl p-2">Pengurus</h3>
    <div class="w-[100%] md:w-[90%] mx-auto flex flex-wrap justify-center my-5">
        <div class="w-4/12 md:w-[20%] p-2">
            <button id="bphButton" class="default-style w-full focus:outline-none focus:ring focus:ring-transparent rounded-full p-2 text-white" onclick="filterData('BPH', this)">
                BPH
            </button>
        </div>
        <div class="w-4/12 md:w-[20%] p-2">
            <button id="KominfoButton" class="default-style w-full focus:outline-none focus:ring focus:ring-transparent rounded-full p-2 text-white" onclick="filterData('Kominfo', this)">
                Kominfo
            </button>
        </div>
        <div class="w-4/12 md:w-[20%] p-2">
            <button id="diklatButton" class="default-style w-full focus:outline-none focus:ring focus:ring-transparent rounded-full p-2 text-white" onclick="filterData('Diklat', this)">
                Diklat
            </button>
        </div>
        <div class="w-4/12 md:w-[20%] p-2">
            <button id="SosmasButton" class="default-style w-full focus:outline-none focus:ring focus:ring-transparent rounded-full p-2 text-white" onclick="filterData('Sosmas', this)">
                Sosmas
            </button>
        </div>
        <div class="w-4/12 md:w-[20%] p-2">
            <button id="psdaButton" class="default-style w-full focus:outline-none focus:ring focus:ring-transparent rounded-full p-2 text-white" onclick="filterData('PSDA', this)">
                PSDA
            </button>
        </div>
        <div class="w-4/12 md:w-[20%] p-2">
            <button id="ekonomiButton" class="default-style w-full focus:outline-none focus:ring focus:ring-transparent rounded-full p-2 text-white" onclick="filterData('Ekonomi', this)">
                Ekonomi
            </button>
        </div>
        <div class="w-4/12 md:w-[20%] p-2">
            <button id="keagamaanButton" class="default-style w-full focus:outline-none focus:ring focus:ring-transparent rounded-full p-2 text-white" onclick="filterData('Agama', this)">
                Agama
            </button>
        </div>
    </div>
    <div class="w-[90%] md:w-[85%] mx-auto flex flex-wrap justify-center">
        <div id="tugasContainer">
        </div>
        <div class="w-[100%] md:w-[90%] mx-auto flex flex-wrap justify-center my-2" id="card-pengurus">
            <!-- Cards will be injected here by JavaScript -->
        </div>
    </div>

    <script>
        const tugasDivisi = [{
                divisi: "BPH",
                tugas: "BPH Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo illo laboriosam aliquam earum impedit eius asperiores facere atque eveniet, a pariatur recusandae sapiente autem aliquid."
            },
            {
                divisi: "Kominfo",
                tugas: "Kominfo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo illo laboriosam aliquam earum impedit eius asperiores facere atque eveniet, a pariatur recusandae sapiente autem aliquid."
            },
            {
                divisi: "Diklat",
                tugas: "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo illo laboriosam aliquam earum impedit eius asperiores facere atque eveniet, a pariatur recusandae sapiente autem aliquid."
            },
            {
                divisi: "Sosmas",
                tugas: "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo illo laboriosam aliquam earum impedit eius asperiores facere atque eveniet, a pariatur recusandae sapiente autem aliquid."
            },
            {
                divisi: "PSDA",
                tugas: "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo illo laboriosam aliquam earum impedit eius asperiores facere atque eveniet, a pariatur recusandae sapiente autem aliquid."
            },
            {
                divisi: "Ekonomi",
                tugas: "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo illo laboriosam aliquam earum impedit eius asperiores facere atque eveniet, a pariatur recusandae sapiente autem aliquid."
            },
            {
                divisi: "Agama",
                tugas: "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo illo laboriosam aliquam earum impedit eius asperiores facere atque eveniet, a pariatur recusandae sapiente autem aliquid."
            },
        ];

        const tugasContainer = document.getElementById('tugasContainer');

        // Fungsi untuk menampilkan tugas
        function displayTugas(divisiData) {
            tugasContainer.innerHTML = '';
            const tugasElement = document.createElement('p');
            tugasElement.classList.add('text-[1rem]', 'md:text-[1.1rem]', 'lg:text-[1.2rem]', 'text-center');
            tugasElement.textContent = divisiData.tugas;
            tugasContainer.appendChild(tugasElement);
        }
        displayTugas(tugasDivisi[0]);

        const daftarPengurus = [{
                name: "Ratnasari",
                posisi: "Sekretaris 1",
                divisi: "BPH",
                imgSrc: "public/image/pengurus/Ratna.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Andre Lahandu",
                posisi: "Sekretaris 2",
                divisi: "BPH",
                imgSrc: "public/image/pengurus/Andre.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Octa Putri Ramadhania",
                posisi: "Bendahara 1",
                divisi: "BPH",
                imgSrc: "public/image/pengurus/Octa.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Vina Salsabila",
                posisi: "Bendahara 2",
                divisi: "BPH",
                imgSrc: "public/image/pengurus/Vina.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Salma Mesias GWk",
                posisi: "Koordinator",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Salma.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Salman Rifki Yanuar",
                posisi: "Staff",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Salman.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Sunanan Al Ulya",
                posisi: "Staff",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Sunan.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Ahmad Safiq M",
                posisi: "Staff",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Safiq.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Haris Nur Ridlo",
                posisi: "Staff",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Haris.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Harlin Aprilianto",
                posisi: "Staff",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Harlin.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Nurul Fadilah",
                posisi: "Staff",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Fadilah.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Faiz Faturrahman",
                posisi: "Staff",
                divisi: "Kominfo",
                imgSrc: "public/image/pengurus/Faiz.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Riski Nurhadi",
                posisi: "Koordinator",
                divisi: "Diklat",
                imgSrc: "public/image/pengurus/Riski.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Dwi Prasetia",
                posisi: "Staff",
                divisi: "Diklat",
                imgSrc: "public/image/pengurus/Dwi.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Farras Daffa Yassarramadhan",
                posisi: "Staff",
                divisi: "Diklat",
                imgSrc: "public/image/pengurus/Farras.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Fajar Maulana",
                posisi: "Staff",
                divisi: "Diklat",
                imgSrc: "public/image/pengurus/Fajar.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Muhammad Khoerul Habibie",
                posisi: "Staff",
                divisi: "Diklat",
                imgSrc: "public/image/pengurus/Habib.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Nur Fauziatun Nazla",
                posisi: "Staff",
                divisi: "Diklat",
                imgSrc: "public/image/pengurus/Zia.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Tri Sugiantoro",
                posisi: "Koordinator",
                divisi: "PSDA",
                imgSrc: "public/image/pengurus/Toro.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Andrian Nur Prima Saputra",
                posisi: "Staff",
                divisi: "PSDA",
                imgSrc: "public/image/pengurus/Andrian.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Jehan Tri Khoerota",
                posisi: "Staff",
                divisi: "PSDA",
                imgSrc: "public/image/pengurus/Jehan.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Suparman Bere",
                posisi: "Staff",
                divisi: "PSDA",
                imgSrc: "public/image/pengurus/Suparman.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "M. Naufal Siang Jati Kusworo",
                posisi: "Staff",
                divisi: "PSDA",
                imgSrc: "public/image/pengurus/Nopal.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Zainal Mutaqqin",
                posisi: "Staff",
                divisi: "PSDA",
                imgSrc: "public/image/pengurus/Zainal.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Yuan Maulana Akhsan",
                posisi: "Koordinator",
                divisi: "Ekonomi",
                imgSrc: "public/image/pengurus/Yuan.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Farid Panjasela Ramadhani",
                posisi: "Staff",
                divisi: "Ekonomi",
                imgSrc: "public/image/pengurus/Farid.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Gilang Wahyu Ramadhan",
                posisi: "Staff",
                divisi: "Ekonomi",
                imgSrc: "public/image/pengurus/Gilang.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Fahrul Ikhsan Fudhori",
                posisi: "Staff",
                divisi: "Ekonomi",
                imgSrc: "public/image/pengurus/Fahrul.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Eksanda Naufal Fikri",
                posisi: "Staff",
                divisi: "Ekonomi",
                imgSrc: "public/image/pengurus/Eksanda.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Muhammad Alifian Noval R",
                posisi: "Staff",
                divisi: "Ekonomi",
                imgSrc: "public/image/pengurus/Alfian.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Audi Rio Ferdinan",
                posisi: "Koordinator",
                divisi: "Sosmas",
                imgSrc: "public/image/pengurus/Audi.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Muhammad Farid Deni Alfito",
                posisi: "Staff",
                divisi: "Sosmas",
                imgSrc: "public/image/pengurus/Fito.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Valdi Firmansyah",
                posisi: "Staff",
                divisi: "Sosmas",
                imgSrc: "public/image/pengurus/Valdi.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Yazid Syafrudin",
                posisi: "Staff",
                divisi: "Sosmas",
                imgSrc: "public/image/pengurus/Yazid.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Salma Laila K",
                posisi: "Staff",
                divisi: "Sosmas",
                imgSrc: "public/image/pengurus/Salma23.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "M. Saiful Romli M",
                posisi: "Koordinator",
                divisi: "Agama",
                imgSrc: "public/image/pengurus/Romli.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Afrizal Balya",
                posisi: "Staff",
                divisi: "Agama",
                imgSrc: "public/image/pengurus/Afrizal.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Afif Sahli Buton",
                posisi: "Staff",
                divisi: "Agama",
                imgSrc: "public/image/pengurus/Afif.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Deanova Bagas P",
                posisi: "Staff",
                divisi: "Agama",
                imgSrc: "public/image/pengurus/Deanova.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
            {
                name: "Syahrul Gunawan",
                posisi: "Staff",
                divisi: "Agama",
                imgSrc: "public/image/pengurus/Syahrul.jpg",
                instagram: "#",
                linkedin: "#",
                github: "#"
            },
        ];

        const cardContainerPengurus = document.getElementById('card-pengurus');

        document.addEventListener('DOMContentLoaded', function() {
            filterData('BPH', document.getElementById('bphButton'));
        });

        // Menampilkan data pengurus berdasarkan dari button divisi
        function filterData(divisi, button) {
            document.querySelectorAll('#card-pengurus button').forEach(btn => btn.classList.remove('active'));
            const filteredPengurus = daftarPengurus.filter(pengurus => pengurus.divisi === divisi);
            cardContainerPengurus.innerHTML = '';
            filteredPengurus.forEach(pengurus => {
                const cardPengurus = document.createElement('div');
                cardPengurus.classList.add('w-[50%]', 'md:w-[33.3333%]', 'lg:w-[25%]', 'py-[1rem]', 'md:py-[2rem]', 'p-2', 'my-3', 'flex', 'flex-col');
                // Memasukkan html ke dalam cardPengurus
                cardPengurus.innerHTML = `
                    <div class="relative flex justify-center">
                        <img src="${pengurus.imgSrc}" class="aspect-w-2 aspect-h-6 object-cover rounded-lg shadow-xl" alt="Profile picture of ${pengurus.name}">
                        <div class="absolute items-center text-transparent hover:text-white bg-opacity-0 rounded-lg h-full w-full hover:bg-black/80 hover:bg-opacity-50 transition duration-300 ease-in-out hover:shadow-2xl">
                            <div class="h-4/5 flex items-center text-center">
                                <text class="w-full">
                                    <p class="text-[1.2rem] p-2">${pengurus.name}</p>
                                    <p class="text-[1.1rem] p-2">${pengurus.posisi}</p>
                                </text>
                            </div>
                            <div class="h-1/5 w-full md:w-2/3 mx-auto items-center flex text-[1.5rem] px-5 justify-between">
                                <a href="${pengurus.instagram}" class="hover:text-blue-600"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                <a href="${pengurus.linkedin}" class="hover:text-blue-600"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                                <a href="${pengurus.github}" class="hover:text-blue-600"><i class="fab fa-github" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    `;
                cardContainerPengurus.appendChild(cardPengurus);
            });

            // Menampilkan Tugas dari masing masing divisi
            document.querySelectorAll('[onclick^="filterData"]').forEach(btn => btn.classList.remove('active-button'));
            button.classList.add('active-button');
            const filteredTugas = tugasDivisi.find(item => item.divisi === divisi);
            if (filteredTugas) {
                displayTugas(filteredTugas);
            } else {
                tugasContainer.innerHTML = '<p>Tugas tidak ditemukan untuk divisi ini.</p>';
            }

            // Membuat warna pada button
            document.querySelectorAll('#card-pengurus button').forEach(btn => btn.classList.remove('active'));
            // Reset warna semua tombol menjadi abu-abu
            var buttons = document.querySelectorAll('.default-style');
            buttons.forEach(function(btn) {
                btn.classList.remove('bg-blue-700');
                btn.classList.add('bg-gray-600');
            });

            // Ganti warna tombol yang diklik menjadi biru
            button.classList.add('bg-blue-700');
            button.classList.remove('bg-gray-600');
        }
    </script>