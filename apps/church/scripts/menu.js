const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

function setMenuOpen(isOpen) {
    navLinks.classList.toggle("show", isOpen);
    menuToggle.setAttribute("aria-expanded", String(isOpen));
    menuToggle.setAttribute(
        "aria-label",
        isOpen ? "Close navigation menu" : "Open navigation menu"
    );
}

menuToggle.addEventListener("click", function() {
    setMenuOpen(!navLinks.classList.contains("show"));
});

document.querySelectorAll(".nav-links a").forEach(function(link) {
    link.addEventListener("click", function() {
        setMenuOpen(false);
    });
});

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape" && navLinks.classList.contains("show")) {
        setMenuOpen(false);
        menuToggle.focus();
    }
});