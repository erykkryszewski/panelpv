<?php

$section_id = get_field('section_id');
$background = get_field('background');
$boxes = get_field('boxes');
?>

<?php if (!empty($boxes)): ?>
<div class="five-boxes <?php if ($background == 'true') {
  echo 'five-boxes--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="five-boxes__wrapper">
      <?php foreach ($boxes as $key => $item): ?>
      <div class="five-boxes__column">
        <div class="five-boxes__item">
          <?php if (!empty($item['image'])): ?>
          <div class="five-boxes__image cover">
            <?php echo wp_get_attachment_image($item['image'], 'full', '', ['class' => 'object-fit-cover']); ?>
          </div>
          <?php endif; ?>
          <div class="five-boxes__overlay cover"></div>
          <?php if (!empty($item['content'])): ?>
          <div class="five-boxes__content"><?php echo apply_filters('the_title', $item['content']); ?></div>
          <?php endif; ?>
          <?php if (!empty($item['link'])): ?>
          <a href="<?php echo esc_html($item['link']['url']); ?>" class="cover fixe-boxes__link">&nbsp;</a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>
