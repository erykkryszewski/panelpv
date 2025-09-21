<?php
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$section_id = get_field('section_id');
$background = get_field('background');
$boxes = get_field('boxes');
?>

<?php if (!empty($boxes)): ?>
<div class="three-boxes <?php if ($background == 'true') {
  echo 'three-boxes--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="three-boxes__wrapper">
      <div class="row">
        <?php foreach ($boxes as $key => $item): ?>
        <div class="col-sm-6">
          <div class="three-boxes__item">
            <div>
              <?php if (!empty($item['icon'])): ?>
              <div class="three-boxes__icon">
                <?php echo wp_get_attachment_image($item['icon'], 'full', '', ['class' => '']); ?>
              </div>
              <?php endif; ?>
              <?php if (!empty($item['content'])): ?>
              <div class="three-boxes__content"><?php echo apply_filters('the_title', $item['content']); ?></div>
              <?php endif; ?>
            </div>
            <?php if (!empty($item['link'])): ?>
            <a href="<?php echo esc_html($item['link']['url']); ?>" class="button button--small three-boxes__button"><?php echo esc_html($item['link']['title']);?></a>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>