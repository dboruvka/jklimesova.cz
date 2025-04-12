document.addEventListener('DOMContentLoaded', function() {
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const toggleButton = document.querySelector('.navbar-toggler');
    
    // Přidání/odebrání třídy na body při otevření/zavření menu
    function toggleMenuState() {
        const isOpen = navbarCollapse.classList.contains('show');
        document.body.classList.toggle('menu-open', isOpen);
    }

    // Sledování změn v menu
    toggleButton.addEventListener('click', toggleMenuState);
    l
    // Zavření menu při kliknutí na křížek
    navbarCollapse.addEventListener('click', function(e) {
        if (e.target.matches('.navbar-collapse::before')) {
            this.classList.remove('show');
            toggleMenuState();
        }
    });

    // Zavření menu při kliknutí na odkaz
    const menuLinks = document.querySelectorAll('.navbar-nav a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            navbarCollapse.classList.remove('show');
            toggleMenuState();
        });
    });
});
