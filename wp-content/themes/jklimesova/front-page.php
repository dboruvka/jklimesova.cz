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
                        if (has_post_thumbnail()) {
                            echo '<div class="mb-4">';
                            the_post_thumbnail('large', ['class' => 'img-fluid rounded']);
                            echo '</div>';
                        }
                        ?>
                        <div class="content">
                            <?php the_content(); ?>
                        </div>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
