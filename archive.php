<?php

get_header();
global $post;

$post = get_post();
$page_id = $post->ID;

$blog_page = filter_input(INPUT_GET, 'blog-page', FILTER_SANITIZE_NUMBER_INT);
$current_blog_page = ($blog_page) ? $blog_page : 1;

$blog_posts_number = get_field('blog_posts_number', 'options');
$blog_hero_title = get_field('blog_hero_title', 'options');

$args = array( 
  'post_status' => 'publish',
  'posts_per_page' => $blog_posts_number, 
  'orderby' => 'title',
  'paged' => $current_blog_page
);

$global_logo = get_field('global_logo', 'options');

$panelpvMaterialPostTypes = [];

if (is_post_type_archive('czlonkostwo-wspier')) {
    $panelpvMaterialPostTypes = ['materialy-zwycz', 'materialy-wspier'];
} elseif (is_post_type_archive('czlonkostwo-zwycz')) {
    $panelpvMaterialPostTypes = ['materialy-zwycz'];
}

$panelpvMaterialsQuery = null;

if (!empty($panelpvMaterialPostTypes)) {
    $panelpvMaterialsQuery = new WP_Query([
        'post_type' => $panelpvMaterialPostTypes,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => [
            'menu_order' => 'ASC',
            'date' => 'DESC',
        ],
        'ignore_sticky_posts' => true,
        'no_found_rows' => true,
    ]);
}

?>

<main id="main" class="main <?php if(!is_front_page()) { echo 'main--subpage'; } ?>">
    <div class="subpage-hero">
        <div class="subpage-hero__background subpage-hero__background--plain"></div>
        <div class="container">
            <div class="subpage-hero__wrapper">
                <h1 class="subpage-hero__title"><?php echo apply_filters('the_title', 'Materiały dla członków'); ?></h1>
            </div>
        </div>
    </div>
    <div class="spacer" style="height: 90px"></div>
    <div class="section-title" id="section-">
        <div class="container">
            <div class="section-title__wrapper section-title__wrapper--centered">
                <h2 class="section-title__title section-title__title--centered">Dziękujemy, że jesteś z nami!</h2>
                <p>
                    Cieszymy się, że dołączyłeś do grona naszych członków — dzięki temu masz dostęp do wyjątkowych materiałów i treści przygotowanych specjalnie dla Ciebie. Poniżej znajdziesz wszystko, co pomoże Ci w
                    pełni korzystać z przywilejów i czerpać korzyści z członkostwa.
                </p>
            </div>
        </div>
    </div>
    <?php if($panelpvMaterialsQuery instanceof WP_Query && $panelpvMaterialsQuery->have_posts()): ?>
        <div class="member-materials">
            <div class="container">
                <div class="member-materials__wrapper">
                    <h3>Materiały do pobrania</h3>
                    <div class="row">
                        <?php while ($panelpvMaterialsQuery->have_posts()) : ?>
                            <?php
                                                    $panelpvMaterialsQuery->the_post();
                                                    $panelpvMaterialFile = get_field('material_file');

                                                    if (is_array($panelpvMaterialFile) && !empty($panelpvMaterialFile['url'])) {
                                                        $panelpvMaterialFile = $panelpvMaterialFile['url'];
                                                    }

                                                    if (is_numeric($panelpvMaterialFile)) {
                                                        $panelpvMaterialFile = wp_get_attachment_url($panelpvMaterialFile);
                                                    }

                                                    $panelpvMaterialUrl = !empty($panelpvMaterialFile) ? $panelpvMaterialFile : get_permalink();
                                                    $panelpvMaterialTarget = !empty($panelpvMaterialFile) ? '_blank' : '_self';
                                                    $panelpvMaterialRel = !empty($panelpvMaterialFile) ? 'noopener' : '';
                                                    $panelpvMaterialDescription = get_the_excerpt();

                                                    if (empty($panelpvMaterialDescription)) {
                                                        $panelpvMaterialDescription = wp_trim_words(wp_strip_all_tags(get_the_content()), 20, '...');
                                                    }
                                                    ?>
                            <div class="col-12 col-md-6 col-lg-4 member-materials__column">
                                <div class="member-materials__item">
                                    <a href="<?php echo esc_url($panelpvMaterialUrl); ?>" class="cover" target="<?php echo esc_attr($panelpvMaterialTarget); ?>"
                                    <?php if(!empty($panelpvMaterialRel)): ?>
             rel="<?php echo esc_attr($panelpvMaterialRel); ?>"
                                    <?php endif; ?>
                                    ></a>
                                <?php if(!empty(get_post_thumbnail_id())): ?>
                                    <div class="member-materials__image">
                                        <a href="<?php echo esc_url($panelpvMaterialUrl); ?>" class="cover" target="<?php echo esc_attr($panelpvMaterialTarget); ?>"
                                        <?php if(!empty($panelpvMaterialRel)): ?>
                 rel="<?php echo esc_attr($panelpvMaterialRel); ?>"
                                        <?php endif; ?>
                                            ></a>
                                    <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', '', ["class" => "object-fit-cover"]); ?>
                                </div>
                            <?php endif; ?>
                            <div class="member-materials__content">
                                <div>
                                    <a href="<?php echo esc_url($panelpvMaterialUrl); ?>" class="member-materials__name" target="<?php echo esc_attr($panelpvMaterialTarget); ?>"
                                    <?php if(!empty($panelpvMaterialRel)): ?>
             rel="<?php echo esc_attr($panelpvMaterialRel); ?>"
                                    <?php endif; ?>
                                            ><?php the_title(); ?></a>
                                <?php if(!empty($panelpvMaterialDescription)): ?>
                                    <p class="member-materials__description"><?php echo esc_html($panelpvMaterialDescription); ?></p>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo esc_url($panelpvMaterialUrl); ?>" class="member-materials__button button" target="<?php echo esc_attr($panelpvMaterialTarget); ?>"
                            <?php if(!empty($panelpvMaterialRel)): ?>
             rel="<?php echo esc_attr($panelpvMaterialRel); ?>"
                            <?php endif; ?>
                                        >Pobierz</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    </div>
    </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
<!-- max 12 items -->
<?php if(have_posts()): ?>
    <div class="theme-blog theme-blog--subpage">
        <div class="container">
            <h3>Materiały do wglądu</h3>
            <div class="theme-blog__wrapper">
                <div class="row">
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <div class="col-12 col-md-6 col-lg-4 theme-blog__column">
                            <div class="theme-blog__item">
                                <a href="<?php the_permalink(); ?>" class="cover"></a>
                                <?php if(!empty(get_post_thumbnail_id())): ?>
                                    <div class="theme-blog__image">
                                        <a href="<?php the_permalink(); ?>" class="cover"></a>
                                        <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', '', ["class" => "object-fit-cover"]); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="theme-blog__content">
                                    <div>
                                        <a href="<?php the_permalink(); ?>" class="theme-blog__title"><?php the_title(); ?></a>
                                        <p><?php $excerpt = get_the_excerpt(); if (empty($excerpt)) { echo substr(get_content_excerpt(), 0, 150) . '...'; } else { echo substr($excerpt, 0, 150) . '...'; } ?></p>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="theme-blog__button button"><?php _e('Czytaj więcej', 'ercodingtheme'); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="pagination mt-5"><?php
                            echo paginate_links(array(
                              'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                              'current'      => max(1, get_query_var('paged')),
                              'format'       => '?paged=%#%',
                              'show_all'     => false,
                              'type'         => 'list',
                              'end_size'     => 2,
                              'mid_size'     => 1,
                              'prev_next'    => true,
                              'prev_text'    => '',
                              'next_text'    => '',
                              'add_args'     => false,
                              'add_fragment' => '',
                          ));
                          ?></div>
            <?php wp_reset_postdata(); ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
<?php endif; ?>
</main>
<?php get_footer(); ?>
