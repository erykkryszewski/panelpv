<?php
$logos = get_field('logos');
$section_id = get_field('section_id');
$background = get_field('background');
?>

<?php if (is_array($logos) && count($logos) > 0): ?>
<div class="logos <?php if ($background === 'true') {
  echo 'logos--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container-fluid">
    <div class="logos__wrapper">
      <div class="logos__viewport">
        <div class="logos__items" data-speed="140">
          <?php
          $shuffled_1 = $logos;
          shuffle($shuffled_1);
          ?>
          <?php foreach ($shuffled_1 as $item): ?>
          <?php if (!empty($item['image'])): ?>
          <div class="logos__image">
            <?php echo wp_get_attachment_image($item['image'], 'full', '', [
              'loading' => 'eager',
              'decoding' => 'async',
            ]); ?>
          </div>
          <?php endif; ?>
          <?php endforeach; ?>

          <?php
          $shuffled_2 = $logos;
          shuffle($shuffled_2);
          ?>
          <?php foreach ($shuffled_2 as $item): ?>
          <?php if (!empty($item['image'])): ?>
          <div class="logos__image">
            <?php echo wp_get_attachment_image($item['image'], 'full', '', [
              'loading' => 'eager',
              'decoding' => 'async',
            ]); ?>
          </div>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
