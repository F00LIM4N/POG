const navbar = document.getElementById('navbar');
const navbar_nav = document.getElementById('navbar_nav');
const firstNavbarMid = document.querySelector('.FirstNavbarMid');
const navbarLogo = document.querySelector('.navbar_logo_pog');


window.addEventListener('scroll', () => {
    if (window.scrollY > 670) {
        navbar.style.position="fixed";
        navbar.style.width="100%";
        navbar_nav.style.borderRadius="0px";
        navbarLogo.classList.add('show'); // Ajouter la classe show pour afficher navbarLogo

        navbar.style.transition = 'all 0.5s ease-in-out';
    }
    else {
        navbar.style.position="sticky";
        navbar.style.width="820px";
        navbar_nav.style.borderRadius="20px";
        navbarLogo.classList.remove('show'); // Supprimer la classe show pour cacher navbarLogo

        navbar.style.transition = 'all 0.5s ease-in-out';
    }
})