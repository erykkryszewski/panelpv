<?php

$section_id = get_field('section_id');
$background = get_field('background');
$title = get_field('title');
$testimonials = get_field('testimonials');
$hide_testimonials = get_field('hide_testimonials', 'options');
?>

<?php if (!empty($testimonials)): ?>
<div class="testimonials <?php if ($background == 'true') {
  echo 'testimonials--background';
} ?> <?php if ($hide_testimonials == 'true') {
   echo 'testimonials--hidden';
 } ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="testimonials__wrapper">
      <div class="testimonials__slider">
        <?php foreach ($testimonials as $key => $item): ?>
        <div class="testimonials__item">
          <?php echo apply_filters('the_title', $item['text']); ?>
          <div class="testimonials__content">
            <?php if (!empty($item['image'])): ?>
            <div class="testimonials__image">
              <?php
              $file = get_attached_file($item['image'], 'medium');
              $image_class = image_object_fit($file);
              ?>
              <?php echo wp_get_attachment_image($item['image'], 'testimonials', '', ['class' => $image_class]); ?>
            </div>
            <?php endif; ?>
            <div>
              <h3 class="testimonials__name"><?php echo apply_filters('the_title', $item['name']); ?></h3>
              <?php if (!empty($item['role'])): ?>
              <h4 class="testimonials__role"><?php echo apply_filters('the_title', $item['role']); ?></h4>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
