<?php
get_header();
?>

<main class="site-main" id="main">
    <div class="container py-5">
        <div class="row">
            <!-- Hlavní obsah -->
            <div class="col-lg-8">
                <h1 class="mb-4"><?php the_title(); ?></h1>
                <div class="text-muted mb-4">
                    <?php echo get_the_date(); ?>
                </div>
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

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <div class="widget mb-4">
                        <h4 class="widget-title mb-3">Nejnovější příspěvky</h4>
                        <ul class="list-unstyled">
                            <?php
                            $recent_posts = wp_get_recent_posts(array(
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
                            wp_reset_postdata(); // Důležité pro obnovení původního post objektu
                            ?>
                        </ul>
                    </div>

                    <div class="widget mb-4">
                        <h4 class="widget-title mb-3">Rubriky</h4>
                        <ul class="list-unstyled">
                            <?php
                            wp_list_categories(array(
                                'title_li' => '',
                                'show_count' => true
                            ));
                            ?>
                        </ul>
                    </div>

                    <div class="widget mb-4">
                        <h4 class="widget-title mb-3">Štítky</h4>
                        <div class="tag-cloud">
                            <?php
                            $tags = get_tags();
                            if ($tags) :
                                foreach ($tags as $tag) : ?>
                                    <a href="<?php echo get_tag_link($tag->term_id); ?>" 
                                       class="btn btn-outline-primary btn-sm me-2 mb-2">
                                        <?php echo $tag->name; ?>
                                    </a>
                                <?php endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
