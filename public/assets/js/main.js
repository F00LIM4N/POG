const navbar = document.getElementById('navbar');
const navbar_nav = document.getElementById('navbar_nav');
const firstNavbarMid = document.querySelector('.FirstNavbarMid');



window.addEventListener('scroll', () => {
    if (window.scrollY > 670) {
        navbar.style.position="fixed";
        navbar.style.width="100%";
        navbar_nav.style.borderRadius="0px";
        navbar.style.transition = 'all 0.5s ease-in-out'; 
    }
    else {
        navbar.style.position="sticky";
        navbar.style.width="820px";
        navbar_nav.style.borderRadius="20px";
        navbar.style.transition = 'all 0.5s ease-in-out';
    }
})