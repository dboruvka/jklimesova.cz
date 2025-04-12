<?php
/**
 * Template Name: Blog Page
 */

get_header();

// Nastavení dotazu pro výpis příspěvků
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => $paged
);
$blog_posts = new WP_Query($args);
?>

<main class="site-main" id="main">
    <div class="container py-5">
        <div class="row">
            <!-- Hlavní obsah -->
            <div class="col-lg-8">
                <h1 class="mb-4"><?php the_title(); ?></h1>
                
                <?php if ($blog_posts->have_posts()) : ?>
                    <?php while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
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
                    <?php endwhile; ?>

                    <div class="nav-links mt-4">
                        <?php
                        echo paginate_links(array(
                            'total' => $blog_posts->max_num_pages,
                            'current' => $paged,
                            'prev_text' => 'Předchozí',
                            'next_text' => 'Další',
                        ));
                        ?>
                    </div>

                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>Žádné příspěvky k zobrazení.</p>
                <?php endif; ?>
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
                            <?php endforeach; ?>
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
