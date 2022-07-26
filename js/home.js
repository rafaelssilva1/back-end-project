const heros = document.querySelectorAll(".hero");
const rightBtn = document.querySelector(".hero__slidebutton--right");
const leftBtn = document.querySelector(".hero__slidebutton--left");
let current = 0;

heros[0].setAttribute("class", "hero hero--active");

rightBtn.addEventListener("click", (e) => {
    if(current >= heros.length - 1) {
        current = 0;
    } else {
        current ++;
    }

    heros.forEach(hero => {
        hero.removeAttribute("class", "hero hero--active");
        hero.setAttribute("class", "hero");
    });

    heros[current].setAttribute("class", "hero hero--active");
});

leftBtn.addEventListener("click", (e) => {
    if(current <= 0) {
        current = heros.length - 1;
    } else {
        current --;
    }

    heros.forEach(hero => {
        hero.removeAttribute("class", "hero hero--active");
        hero.setAttribute("class", "hero");
    });

    heros[current].setAttribute("class", "hero hero--active");
});

const rightBtnSlide = document.querySelectorAll(".movieslideshow__slidebutton--right");
const leftBtnSlide = document.querySelectorAll(".movieslideshow__slidebutton--left");

rightBtnSlide.forEach(btn => {
    btn.addEventListener("click", (e) => {
        const slideShow = e.target.parentElement.parentElement.firstElementChild;
        let slideShowWidth = slideShow.getBoundingClientRect().width;
        slideShow.scrollLeft += slideShowWidth;
    });
});

leftBtnSlide.forEach(btn => {
    btn.addEventListener("click", (e) => {
        const slideShow = e.target.parentElement.parentElement.firstElementChild;
        let slideShowWidth = slideShow.getBoundingClientRect().width;
        slideShow.scrollLeft -= slideShowWidth;
    });
});