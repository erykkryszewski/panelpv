<?php

$section_id = get_field('section_id');
$background = get_field('background');
$content = get_field('content');
$button = get_field('button');
$form = get_field('form');
?>


<section class="report <?php if ($background == 'true') {
  echo 'report--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-6">
        <?php if (!empty($content)): ?>
        <div class="report__content">
          <?php echo apply_filters('the_title', $content); ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($button)): ?>
        <a href="<?php echo esc_html($button['url']); ?>"
          class="button report__button"><?php echo esc_html($button['title']); ?></a>
        <?php endif; ?>
      </div>
      <?php if (!empty($form)): ?>
      <div class="col-12 col-lg-6">

      </div>
      <?php endif; ?>
    </div>
  </div>
</section>