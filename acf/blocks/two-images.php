<?php

$section_id = get_field('section_id');
$background = get_field('background');
$images = get_field('images');
?>

<?php if (!empty($images)): ?>
<div class="two-images <?php if ($background == 'true') {
  echo 'two-images--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <?php foreach ($images as $key => $item): ?>
      <div class="col-xl-6">
        <div class="two-images__item" style="height:<?php echo $item['height']; ?>px">
          <?php if (!empty($item['image_class'])): ?>
          <?php echo wp_get_attachment_image($item['image'], 'large', '', ['class' => $item['image_class']]); ?>
          <?php else: ?>
          <?php echo wp_get_attachment_image($item['image'], 'large', '', ['class' => 'object-fit-cover']); ?>
          <?php endif; ?>
          <?php if (!empty($item['link'])): ?>
          <a href="<?php echo esc_url_raw($item['link']); ?>" class="cover"></a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>
