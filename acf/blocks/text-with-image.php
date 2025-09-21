<?php

$section_id = get_field('section_id');
$background = get_field('background');
$title = get_field('title');
$subtitle = get_field('subtitle');
$text = get_field('text');
$image = get_field('image');
$image_class = get_field('image_class');
$image_size = get_field('image_size');
$direction = get_field('direction');
$button = get_field('button');
$button_full_width = get_field('button_full_width');
?>

<div class="text-with-image <?php if ('true' == $background) {
  echo 'text-with-image--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="row text-with-image__row <?php if ('reverse' == $direction) {
      echo 'text-with-image__row--reverse';
    } ?>">
      <div class="col-12 col-md-6 col-lg-7">
        <?php if (!empty($title)): ?>
        <h2 class="text-with-image__title"><?php echo apply_filters('the_title', $title); ?></h2>
        <?php endif; ?>
        <?php if (!empty($subtitle)): ?>
        <h3 class="text-with-image__subtitle"><?php echo apply_filters('the_title', $subtitle); ?></h3>
        <?php endif; ?>
        <div>
          <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $text)); ?>
        </div>
        <?php if (!empty($button)): ?>
        <a href="<?php echo esc_html($button['url']); ?>" class="button text-with-image__button <?php if (
  'true' == $button_full_width
) {
  echo 'button--full-width';
} ?>"><?php echo esc_html($button['title']); ?></a>
        <?php endif; ?>
      </div>
      <?php if (!empty($image)): ?>
      <div class="col-12 col-md-6 col-lg-5">
        <div class="text-with-image__picture <?php if ('reverse' == $direction) {
          echo 'text-with-image__picture--reverse';
        } ?> <?php if ('big' == $image_size) {
   echo 'text-with-image__picture--big';
 } ?> <?php if ('small' == $image_size) {
   echo 'text-with-image__picture--small';
 } ?>">
          <?php echo wp_get_attachment_image($image, 'large', '', ['class' => $image_class]); ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>