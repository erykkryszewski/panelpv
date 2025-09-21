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

?>

<main id="main" class="main <?php if(!is_front_page()) { echo 'main--subpage'; }?>">
  <div class="subpage-hero">
    <div class="subpage-hero__background subpage-hero__background--plain"></div>
    <div class="container">
      <div class="subpage-hero__wrapper">
        <h1 class="subpage-hero__title"><?php echo apply_filters('the_title', 'Blog');?></h1>
      </div>
    </div>
  </div>
  <div class="spacer" style="height: 90px"></div>
  <div class="section-title">
    <div class="container">
      <div class="section-title__wrapper section-title__wrapper--decorated">
        <h2>Lorem ipsum</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem repellendus nemo vero inventore ipsam est distinctio ullam perspiciatis veniam facilis?</p>
      </div>
    </div>
  </div>
  <!-- max 12 items -->
  <?php if(have_posts()):?>
    <div class="theme-blog theme-blog--subpage">
      <div class="container">
        <div class="theme-blog__wrapper">
          <div class="row">
            <?php while (have_posts()) : ?>
              <?php the_post(); ?>
              <div class="col-12 col-md-6 col-lg-4 theme-blog__column">
                <div class="theme-blog__item">
                  <div class="theme-blog__image">
                    <a href="<?php the_permalink();?>" class="cover"></a>
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', '', ["class" => "object-fit-cover"]); ?>
                  </div>
                  <div class="theme-blog__content">
                    <div>
                      <a href="<?php the_permalink(); ?>" class="theme-blog__title"><?php the_title(); ?></a>
                      <p>
                        <?php 
                          $excerpt = get_the_excerpt();
                          if (empty($excerpt)) {
                            echo substr(get_content_excerpt(), 0, 150) . '...';
                          } else {
                            echo substr($excerpt, 0, 150) . '...';
                          }
                        ?>
                      </p>
                    </div>
                      <a href="<?php the_permalink(); ?>" class="theme-blog__button button"><?php _e('Czytaj więcej', 'ercodingtheme'); ?></a>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
        <div class="pagination mt-5">
          <?php
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
          ?>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php wp_reset_query(); ?>
      </div>
    </div>
  <?php endif;?>
  <div class="spacer spacer--small" style="height: 40px"></div>
  <div class="cta">
    <div class="container">
      <div class="cta__wrapper">
        <h2 class="cta__title">Zapoznaj się z naszą ofertą!</h2>
        <p></p>
        <div>
          <a href="/kontakt/" class="cta__button button">Skontaktuj się</a>
        </div>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>