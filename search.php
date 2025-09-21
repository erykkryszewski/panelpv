<?php 

get_header();
global $post;

$post = get_post();
$page_id = $post->ID;

$s = get_search_query();
$args = array(
  's' => $s
);

$blog_hero_title = get_field('blog_hero_title', 'options');
$blog_hero_image = get_field('blog_hero_image', 'options');

?>

<main id="main" class="main <?php if(!is_front_page()) { echo 'main--subpage'; }?>">
  <!-- max 12 items -->
  <?php if(have_posts()):?>
    <div class="news">
      <div class="container">
        <div class="news__wrapper">
          <div class="row">
            <div class="col-lg-9">
              <div class="row">
                <?php while (have_posts()) : ?>
                  <?php the_post(); ?>
                  <div class="col-12 col-md-6 mt-5">
                    <div class="news__item">
                      <div class="news__image">
                        <a href="<?php the_permalink();?>" class="cover"></a>
                        <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', '', ["class" => "object-fit-cover"]); ?>
                      </div>
                      <div class="news__content">
                        <div>
                          <a href="<?php the_permalink(); ?>" class="news__title"><?php the_title(); ?></a>
                          <span class="news__time"><time><?php the_time('F j, Y'); ?></time></span>
                          <p><?php echo substr(get_the_excerpt(), 0, 300); ?>...</p>
                        </div>
                          <a href="<?php the_permalink(); ?>" class="button button--light news__button"><?php _e('Read more', 'ercodingtheme'); ?></a>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>
            <div class="col-lg-3 mt-5">
              <div class="blog-sidebar">
                <h3><?php esc_html_e('Search', 'ercodingtheme');?></h3>
                <?php get_sidebar('ercodingtheme-sidebar'); ?>
              </div>
            </div>
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

  <!-- if there is no results  -->

  <?php if(!have_posts()):?>
    <div class="news">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 mt-5">
            <h2><?php esc_html_e('No posts found', 'ercodingtheme');?></h2>
          </div>
          <div class="col-lg-3 mt-5">
            <div class="blog-sidebar">
              <h3><?php esc_html_e('Search', 'ercodingtheme');?></h3>
              <?php get_sidebar('ercodingtheme-sidebar'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif;?>
</main>
<?php get_footer(); ?>