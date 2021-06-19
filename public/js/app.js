// menu
document.querySelector(".nav__menu").addEventListener("click", () => {
    document.querySelector(".menu").classList.toggle("visible");
});

// scroll
let up = document.querySelector(".up");
up.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});
window.addEventListener("scroll", () => {
    if(window.scrollY > 150 && up.classList.value == "up invisible")
        up.classList.remove("invisible");
    else if(window.scrollY < 150 && up.classList.value != "up invisible")
        up.classList.add("invisible");
});