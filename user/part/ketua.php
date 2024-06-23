    <h3 class="text-[1.2rem] md:text-[1.3rem] lg:text-[1.5rem] font-bold text-center my-2 md:my-3 bg-gray-900 text-white rounded-xl p-2">Ketua dan Wakil Ketua</h3>
    <div class="w-[90%] md:w-[85%] mx-auto flex flex-wrap justify-center">
        <div class="w-[100%] md:w-[90%] mx-auto flex flex-wrap justify-center my-2" id="card-ketua">
            <!-- Cards will be injected here by JavaScript -->
        </div>
    </div>

        <script>
            const members = [{
                    name: "Aizan Syalim",
                    position: "Ketua Himatik",
                    imgSrc: "public/image/pengurus/aizan.jpg",
                    instagram: "#",
                    linkedin: "#",
                    github: "#"
                },
                {
                    name: "R. M. Lukman Harjito",
                    position: "Wakil Ketua Himatik",
                    imgSrc: "public/image/pengurus/lukman.jpg",
                    instagram: "#",
                    linkedin: "#",
                    github: "#"
                }
            ];

            const cardContainer = document.getElementById('card-ketua');

            members.forEach(member => {
                const card = document.createElement('div');
                card.classList.add('w-[50%]', 'md:w-[33.3333%]', 'lg:w-[25%]', 'py-[1rem]', 'md:py-[2rem]', 'p-2', 'my-3', 'flex', 'flex-col');
                card.innerHTML = `
                <div class="relative flex justify-center">
                    <img src="${member.imgSrc}" class="aspect-w-2 aspect-h-6 object-cover rounded-lg shadow-xl" alt="Profile picture of ${member.name}">
                    <div class="absolute items-center text-transparent hover:text-white bg-opacity-0 rounded-lg h-full w-full hover:bg-black/80 hover:bg-opacity-50 transition duration-300 ease-in-out hover:shadow-2xl">
                        <div class="h-4/5 flex items-center text-center">
                            <text class="w-full">
                                <p class="text-[1.2rem] p-2">${member.name}</p>
                                <p class="text-[1.1rem] p-2">${member.position}</p>
                            </text>
                        </div>
                        <div class="h-1/5 w-full md:w-2/3 mx-auto items-center flex text-[1.5rem] px-5 justify-between">
                            <a href="${member.instagram}" class="hover:text-blue-600"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                            <a href="${member.linkedin}" class="hover:text-blue-600"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                            <a href="${member.github}" class="hover:text-blue-600"><i class="fab fa-github" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            `;
                cardContainer.appendChild(card);
            });
        </script>
        