<?php

$posts_category = get_field('posts_category');
$posts_number = get_field('posts_number');
$posts_title = get_field('posts_title');

$column_classes = 'col-12 col-md-6 col-lg-4';

if ($posts_number == 2) {
  $column_classes = 'col-12 col-md-6';
} elseif ($posts_number == 4) {
  $column_classes = 'col-12 col-md-6 col-xl-3';
}

$args = [
  'category_name' => $posts_category,
  'posts_per_page' => (int) $posts_number,
];
$posts = new WP_Query($args);

$background = get_field('background');
$section_id = get_field('section_id');
?>

<?php if ($posts->have_posts()): ?>
<div class="theme-blog <?php if ($background == 'true') {
  echo 'theme-blog--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="theme-blog__wrapper">
      <?php if (!empty($posts_title)): ?>
      <h2 class="theme-blog__decorator"><?php echo esc_html($posts_title); ?></h2>
      <?php endif; ?>
      <div class="row">
        <?php while ($posts->have_posts()):
          $posts->the_post(); ?>





        <div class="<?php echo esc_html($column_classes); ?> theme-blog__column">
          <?php
          $terms = get_the_terms(get_the_ID(), 'category') ?: [];
          $mods = array_map(fn($t) => 'theme-blog__item--' . sanitize_html_class($t->slug), $terms);
          $theme_blog_item = 'theme-blog__item' . (!empty($mods) ? ' ' . implode(' ', $mods) : '');

          $is_video = false;
          if (!empty($terms)) {
            foreach ($terms as $term) {
              if ($term->slug === 'video') {
                $is_video = true;
                break;
              }
            }
          }
          ?>


          <div class="<?php echo esc_attr($theme_blog_item); ?>">
            <div class="theme-blog__image <?php if ($posts_number == 2) {
              echo 'theme-blog__image--bigger';
            } ?> <?php if ($posts_number == 4) {
   echo 'theme-blog__image--smaller';
 } ?>                 <?php if ($is_video) {
                   echo 'theme-blog__image--video';
                 } ?>">
              <a href="<?php the_permalink(); ?>" class="cover"></a>
              <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'medium', '', [
                'class' => 'object-fit-cover',
              ]); ?>
            </div>
            <div class="theme-blog__content">
              <div>
                <a href="<?php the_permalink(); ?>" class="theme-blog__title"><?php the_title(); ?></a>
                <!-- <span class="theme-blog__time"><time><?php the_time('F j, Y'); ?></time></span> -->
                <p class="small">
                  <?php
                  $excerpt = get_the_excerpt();
                  if (empty($excerpt)) {
                    $content = get_the_content();
                    echo wp_trim_words($content, 15, '...');
                  } else {
                    echo wp_trim_words($excerpt, 15, '...');
                  }
                  ?>
                </p>
              </div>
              <a href="<?php the_permalink(); ?>" class="theme-blog__button">
                <?php if ($is_video): ?>
                <?php _e('Zobacz video', 'ercodingtheme'); ?>
                <?php else: ?>
                <?php _e('Czytaj więcej', 'ercodingtheme'); ?>
                <?php endif; ?>
              </a>
            </div>
          </div>
        </div>






        <?php
        endwhile; ?>
      </div>
    </div>
    <?php wp_reset_postdata(); ?>
    <?php wp_reset_query(); ?>
  </div>
</div>
<?php endif; ?>
