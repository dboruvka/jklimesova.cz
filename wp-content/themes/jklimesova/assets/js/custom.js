document.addEventListener('DOMContentLoaded', function() {
    var dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.preventDefault(); // Zabraňuje kliknutí pro otevření dropdownu
        });
    });

    // Vyhledávací formulář
    const searchForm = document.querySelector('.search-form');
    const searchInput = searchForm.querySelector('input[type="search"]');
    const searchSubmit = searchForm.querySelector('.search-submit');

    // Skrýt tlačítko na začátku
    searchSubmit.style.display = 'none';

    // Zobrazit tlačítko při focusu na input
    searchInput.addEventListener('focus', function() {
        searchSubmit.style.display = 'block';
    });

    // Skrýt tlačítko při ztrátě focusu, pokud je input prázdný
    searchInput.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            setTimeout(() => {
                searchSubmit.style.display = 'none';
            }, 200); // Malé zpoždění pro případ kliknutí na tlačítko
        }
    });

    // Nechat tlačítko zobrazené, pokud je v inputu text
    searchInput.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            searchSubmit.style.display = 'block';
        }
    });
});
