<?php
get_header();
?>

<main class="site-main" id="main">
    <div class="container py-5">
        <div class="row">
            <!-- Hlavní obsah -->
            <div class="col-lg-8">
                <h1 class="mb-4">Akce</h1>
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

                    // Pagination
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                        'screen_reader_text' => ' ',
                    ));

                endif;
                ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <div class="widget mb-4">
                        <h4 class="widget-title mb-3">Nejnovější akce</h4>
                        <ul class="list-unstyled">
                            <?php
                            $recent_posts = wp_get_recent_posts(array(
                                'post_type' => 'akce',
                                'numberposts' => 5,
                                'post_status' => 'publish'
                            ));
                            foreach ($recent_posts as $post) : ?>
                                <li class="mb-2">
                                    <a href="<?php echo get_permalink($post['ID']); ?>" class="text-decoration-none">
                                        <?php echo $post['post_title']; ?>
                                    </a>
                                </li>
                            <?php endforeach; 
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>

                    <div class="widget mb-4">
                        <h4 class="widget-title mb-3">Archiv akcí</h4>
                        <ul class="list-unstyled">
                            <?php
                            wp_get_archives(array(
                                'post_type' => 'akce',
                                'type' => 'monthly'
                            ));
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();