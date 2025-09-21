<?php

$section_id = get_field('section_id');
$background = get_field('background');
$title = get_field('title');
$subtitle = get_field('subtitle');
$text = get_field('text');
$centered = get_field('centered');
?>

<div class="section-title <?php if ($background == 'true') {
  echo 'section-title--background';
} ?>" id="section-<?php echo esc_html($section_id); ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id <?php if ($background == 'true') {
    echo 'section-id--background';
  } ?>" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="section-title__wrapper <?php if ($centered == 'true') {
      echo 'section-title__wrapper--centered';
    } else {
      echo 'section-title__wrapper--decorated';
    } ?>">
      <?php if (!empty($title)): ?>
      <h2 class="section-title__title <?php if ($centered == 'true') {
        echo 'section-title__title--centered';
      } else {
        echo 'section-title__title--left';
      } ?>"><?php echo apply_filters('the_title', $title); ?></h2>
      <?php endif; ?>
      <?php if (!empty($subtitle)): ?>
      <h3 class="sectiont-title__subtitle"><?php echo apply_filters('the_title', $subtitle); ?></h3>
      <?php endif; ?>
      <?php if (!empty($text)): ?>
      <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $text)); ?>
      <?php endif; ?>
    </div>
  </div>
</div>