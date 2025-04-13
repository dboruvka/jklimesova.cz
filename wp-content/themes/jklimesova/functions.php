<?php
/**
 * Custom Bootstrap Theme functions and definitions
 *
 * @package CustomBootstrapTheme
 */


// Include the Bootstrap NavWalker class



require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// Register the navigation menu
function theme_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'custom-bootstrap-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'theme_register_menus' );



/**
 * Registrace menu pro patičku
 */
function register_footer_menus() {
    register_nav_menus(array(
        'footer-1' => __('Footer Menu 1', 'jklimesova'),
        'footer-2' => __('Footer Menu 2', 'jklimesova')
    ));
}
add_action('after_setup_theme', 'register_footer_menus');





function theme_widgets_init() {
    // Widget nad menu
    register_sidebar(array(
        'name'          => 'Nad menu',
        'id'            => 'above-menu',
        'description'   => 'Widget oblast nad hlavním menu',
        'before_widget' => '<div class="above-menu-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // První widget v patičce
    register_sidebar(array(
        'name'          => 'Footer Sloupec 1',
        'id'            => 'footer-1',
        'description'   => 'První sloupec v patičce',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Druhý widget v patičce
    register_sidebar(array(
        'name'          => 'Footer Sloupec 2',
        'id'            => 'footer-2',
        'description'   => 'Druhý sloupec v patičce',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Třetí widget v patičce
    register_sidebar(array(
        'name'          => 'Footer Sloupec 3',
        'id'            => 'footer-3',
        'description'   => 'Třetí sloupec v patičce',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Čtvrtý widget v patičce
    register_sidebar(array(
        'name'          => 'Footer Sloupec 4',
        'id'            => 'footer-4',
        'description'   => 'Čtvrtý sloupec v patičce',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Copyright widget
    register_sidebar(array(
        'name'          => 'Copyright text',
        'id'            => 'footer-copyright',
        'description'   => 'Text autorských práv v patičce',
        'before_widget' => '<div class="footer-copyright">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');





function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');


function theme_custom_logo_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action( 'after_setup_theme', 'theme_custom_logo_setup' );


function theme_enqueue_styles() {
    // Lokální cesta k Bootstrap CSS
    $local_bootstrap_css = get_stylesheet_directory() . '/assets/css/bootstrap.min.css';
    // Cesta k Bootstrap na CDN
    $cdn_bootstrap_css = 'https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css';
    
    // Zkontrolujeme, jestli existuje lokální Bootstrap CSS
    if (file_exists($local_bootstrap_css)) {
        wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), filemtime($local_bootstrap_css), 'all' );
    } else {
        wp_enqueue_style( 'bootstrap-css', $cdn_bootstrap_css );
    }
    

     // Bootstrap Icons - pouze z CDN
     $bootstrap_icons_cdn = 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css';
     wp_enqueue_style( 'bootstrap-icons', $bootstrap_icons_cdn );
 
    // Lokální cesta k Bootstrap JS
    $local_bootstrap_js = get_stylesheet_directory() . '/assets/js/bootstrap.bundle.min.js';
    // Cesta k Bootstrap JS na CDN
    $cdn_bootstrap_js = 'https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js';

    // Zkontrolujeme, jestli existuje lokální Bootstrap JS
    if (file_exists($local_bootstrap_js)) {
        wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), filemtime($local_bootstrap_js), true );
    } else {
        wp_enqueue_script( 'bootstrap-js', $cdn_bootstrap_js, array(), null, true );
    }

    // Vlastní styly s verzováním podle času úpravy
    wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/assets/css/styles.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/styles.css'), 'all' );

    // Vlastní skripty s verzováním podle času úpravy
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/custom.js'), true );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Shortcode pro aktuální rok
function current_year_shortcode() {
    return date('Y');
}
add_shortcode('rok', 'current_year_shortcode');

// Povolení shortcodů ve widgetech
add_filter('widget_text', 'do_shortcode');

?>
