jQuery(document).ready(function($) {
  // Univerzální funkce pro animaci v Divi stylu
  function animateOnView(selector, duration = '1.2s', direction = 'up', opacityFrom = 0, opacityTo = 1, innerSelector = null) {
    // Pokud je zadán innerSelector, animovat se budou jen vnitřní prvky
    const target = innerSelector ? $(selector).find(innerSelector) : $(selector);

    // Výchozí transformace podle směru animace
    let transform;
    switch (direction) {
      case 'up':
        transform = 'translateY(100px)';
        break;
      case 'down':
        transform = 'translateY(-100px)';
        break;
      case 'left':
        transform = 'translateX(100px)';
        break;
      case 'right':
        transform = 'translateX(-100px)';
        break;
      default:
        transform = 'translateY(100px)'; // Výchozí směr je nahoru
    }

    // Nastavení počáteční pozice a průhlednosti pro vnitřní prvky
    target.css({
      opacity: opacityFrom,
      transform: transform,
      transition: `transform ${duration} ease-out, opacity ${duration} ease-out`
    });

    // Funkce pro kontrolu, zda je element ve viewportu
    function isInViewport(element) {
      var elementTop = $(element).offset().top;
      var elementBottom = elementTop + $(element).outerHeight();
      
      var viewportTop = $(window).scrollTop();
      var viewportBottom = viewportTop + $(window).height();
      
      return elementBottom > viewportTop && elementTop < viewportBottom;
    }

    // Kontrola viditelnosti při scrollování
    $(window).on('scroll', function() {
      $(selector).each(function() {
        if (isInViewport(this)) {
          $(this).find(innerSelector).each(function(index) {
            // Zpoždění animace pro vnitřní prvky
            const delay = index * 200; // 200ms zpoždění mezi jednotlivými prvky
            $(this).css({
              transitionDelay: `${delay}ms`, // Nastavení zpoždění pro každý vnitřní prvek
              opacity: opacityTo,
              transform: 'translateY(0)' // Návrat do původní pozice
            });
          });
        }
      });
    });

    // Kontrola viditelnosti při načtení stránky
    $(window).on('load', function() {
      $(selector).each(function() {
        if (isInViewport(this)) {
          $(this).find(innerSelector).each(function(index) {
            // Zpoždění animace pro vnitřní prvky
            const delay = index * 200; // 200ms zpoždění mezi jednotlivými prvky
            $(this).css({
              transitionDelay: `${delay}ms`, // Nastavení zpoždění pro každý vnitřní prvek
              opacity: opacityTo,
              transform: 'translateY(0)' // Návrat do původní pozice
            });
          });
        }
      });
    });
  }

  
  
  animateOnView('.v-sidlo', '0.7s', 'down', 0, 1, 'div');
  animateOnView('.area-1', '0.7s', 'right', 0, 1, '.area-left');
  animateOnView('.area-1', '0.9s', 'left', 0, 1, '.area-right');
  animateOnView('.mapa', '0.7s', 'up', 0, 1, 'iframe');
 
  

  
  
});
