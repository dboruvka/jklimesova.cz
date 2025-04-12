<?php
get_header();
?>

<main class="site-main" id="main">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        ?>
                        <article class="mb-5">
                            <h2 class="mb-3">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-muted mb-3">
                                <?php echo get_the_date(); ?>
                            </div>
                            <?php
                            if (has_post_thumbnail()) {
                                echo '<div class="mb-3">';
                                the_post_thumbnail('large', ['class' => 'img-fluid rounded']);
                                echo '</div>';
                            }
                            ?>
                            <div class="content">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                Číst více
                            </a>
                        </article>
                    <?php
                    endwhile;
                    
                    // Navigace mezi stránkami
                    echo '<div class="nav-links mt-4">';
                    posts_nav_link(' ', 'Předchozí', 'Další');
                    echo '</div>';
                    
                else :
                    ?>
                    <p>Žádné příspěvky k zobrazení.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();