

window.addEventListener("scroll", () => {
    if(window.scrollY>500) {

        navbar.style.position = "fixed"
    }
    else {
        navbar.style.position = "static"

    }
})