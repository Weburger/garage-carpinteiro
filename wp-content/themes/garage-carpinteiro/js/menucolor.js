document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('header');
    const logoSVG = document.getElementById('logo-svg');
    const links = document.querySelectorAll('#main-navigation a');
    const borderColor = window.getComputedStyle(header).borderBottomColor;
    const sections = document.querySelectorAll('[data-nav-color]');
    const defaultColor = header.getAttribute('data-default-color') || 'white';

    function updateNavColor() {
        let navColor = defaultColor;

        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= 0 && rect.bottom >= 0) {
                navColor = section.getAttribute('data-nav-color');
            }
        });

        if (navColor === 'black') {
            header.classList.add('scrolled-black');
            header.classList.remove('scrolled-white');
        } else {
            header.classList.add('scrolled-white');
            header.classList.remove('scrolled-black');
        }
    }

    window.addEventListener('scroll', updateNavColor);
    window.addEventListener('load', updateNavColor);
});