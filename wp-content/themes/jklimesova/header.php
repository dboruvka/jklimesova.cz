<!DOCTYPE html>
<html <?php language_attributes(); ?> data-bs-theme="light" lang="<?php bloginfo('language'); ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <nav class="navbar navbar-expand-md sticky-top bg-body border-bottom">
        <div class="container">
            <div class="d-flex align-items-center w-100">
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                    <span class="visually-hidden">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse py-md-3" id="navcol-1">
                    <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'depth' => 2,
                        'container' => false,
                        'menu_class' => 'navbar-nav mb-2 mb-md-0 text-uppercase mx-auto',
                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                        'walker' => new WP_Bootstrap_Navwalker(),
                    ));
                    ?>

                    <!-- Vyhledávací formulář -->
                    <form role="search" method="get" class="search-form d-flex mx-3" action="<?php echo home_url('/'); ?>">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Hledat..." aria-label="Hledat" value="<?php echo get_search_query(); ?>" name="s">
                            <button type="submit" class="btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <?php 
                    if ( has_custom_logo() ) {
                        echo '<div class="ms-auto">';
                        the_custom_logo();
                        echo '</div>';
                    } 
                    ?>
                </div>

                <?php if ( is_active_sidebar('above-menu') ) : ?>
                    <div class="above-menu-area">
                        <?php dynamic_sidebar('above-menu'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/menu.js"></script>
</body>
</html>
