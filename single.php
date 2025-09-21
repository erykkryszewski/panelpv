<?php

/**
 * This file contains single post content
 *
 * @package ercodingtheme
 * @license GPL-3.0-or-later
 */

get_header();
global $post;

$post = get_post();
$page_id = $post->ID;

$prev_post = get_previous_post();
$next_post = get_next_post();

// CPT
$hero_title = get_field('hero_title', $page_id);
$hero_text = get_field('hero_text', $page_id);

//blog
$author_name = get_field('author_name', $page_id);
$author_position = get_field('author_position', $page_id);

?>

<main id="main" class="main main--subpage">
  <?php if(have_posts()):?>
    <?php while(have_posts()): the_post();?>
      <div class="subpage-hero">
        <div class="subpage-hero__background subpage-hero__background--plain"></div>
        <div class="container">
          <div class="subpage-hero__wrapper">
            <h1 class="subpage-hero__title subpage-hero__title--white"><?php echo apply_filters('the_title', the_title());?></h1>
          </div>
        </div>
      </div>
      <div class="single-blog-post">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
              <div class="single-blog-post__content">
                <?php if(!empty(get_post_thumbnail_id($post->ID))):?>
                  <div class="single-blog-post__image">
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'full', '', ["class" => "object-fit-cover"]); ?>
                  </div>
                <?php endif;?>
                <p><?php the_content(); ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile;?>
  <?php endif;?>
</main>
<?php get_footer(); ?>
