<?php

$section_id = get_field('section_id');
$background = get_field('background');
$team = get_field('team');
?>

<?php if (!empty($team)): ?>
<div class="team <?php if ($background == 'true') {
  echo 'team--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="team__wrapper">
      <div class="row">
        <?php foreach ($team as $key => $item): ?>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="team__item">
            <?php if (!empty($item['image'])): ?>
            <div class="team__image <?php if ($item['image_class'] == 'object-fit-contain') {
              echo 'team__image--padding';
            } ?>">
              <?php echo wp_get_attachment_image($item['image'], 'large', '', ['class' => $item['image_class']]); ?>
            </div>
            <?php endif; ?>
            <div class="team__content">
              <h3 class="team__title"><?php echo apply_filters('the_title', $item['title']); ?></h3>
              <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $item['text'])); ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
