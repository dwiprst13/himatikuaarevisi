document.addEventListener("DOMContentLoaded", function () {
  const members = [
    {
      name: "Aizan Syalim",
      position: "Ketua Himatik",
      imgSrc: "public/image/pengurus/aizan.jpg",
      instagram: "#",
      linkedin: "#",
      github: "#",
    },
    {
      name: "R. M. Lukman Harjito",
      position: "Wakil Ketua Himatik",
      imgSrc: "public/image/pengurus/lukman.jpg",
      instagram: "#",
      linkedin: "#",
      github: "#",
    },
  ];

  const cardContainer = document.getElementById("card-container");

  members.forEach((member) => {
    const card = document.createElement("div");
    card.classList.add(
      "w-[50%]",
      "md:w-[33.3333%]",
      "lg:w-[25%]",
      "py-[1rem]",
      "md:py-[2rem]",
      "p-2",
      "my-3",
      "flex",
      "flex-col"
    );
    card.innerHTML = `
            <div class="relative flex justify-center">
                <img src="${member.imgSrc}" class="aspect-w-2 aspect-h-6 object-cover rounded-lg shadow-xl" alt="Profile picture of ${member.name}">
                <div class="absolute flex flex-col items-center text-transparent hover:text-white bg-opacity-0 rounded-lg h-full w-full hover:bg-black/80 hover:bg-opacity-50 transition duration-300 ease-in-out hover:shadow-2xl">
                    <div class="h-4/5 flex items-center">
                        <p class="text-[1.2rem] p-2">${member.name}</p>
                        <p class="text-[1.1rem] p-2">${member.position}</p>
                    </div>
                    <div class="h-1/5 w-2/3 mx-auto items-center flex text-[1.5rem] px-5 justify-between">
                        <a href="${member.instagram}" class="hover:text-blue-600"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        <a href="${member.linkedin}" class="hover:text-blue-600"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                        <a href="${member.github}" class="hover:text-blue-600"><i class="fab fa-github" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        `;
    cardContainer.appendChild(card);
  });
});
