<?php

$background = get_field('background');
$section_id = get_field('section_id');

$form_id = get_field('form_id');

$left_image = get_field('left_image');
$left_content = get_field('left_content');

$right_image = get_field('right_image');
$right_content = get_field('right_content');

$bottom_content = get_field('bottom_content');
?>

<?php if (!empty($form_id)): ?>
<div class="contact <?php if ($background == 'true') {
  echo 'contact--background';
} ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-xl-5">
        <div class="contact__details">
          <div class="contact__info contact__info--left">
            <?php if (!empty($left_image)): ?>
            <div class="contact__image">
              <?php echo wp_get_attachment_image($left_image, 'large', '', ['class' => 'object-fit-cover']); ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($left_content)): ?>
            <?php echo apply_filters('the_title', $left_content); ?>
            <?php endif; ?>
          </div>
          <div class="contact__info contact__info--right">
            <?php if (!empty($right_image)): ?>
            <div class="contact__image">
              <?php echo wp_get_attachment_image($right_image, 'large', '', ['class' => 'object-fit-cover']); ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($right_content)): ?>
            <?php echo apply_filters('the_title', $right_content); ?>
            <?php endif; ?>
          </div>
        </div>
        <?php if (!empty($bottom_content)): ?>
        <div class="contact__bottom-content">
          <?php echo apply_filters('the_title', $bottom_content); ?>
        </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-6 col-xl-7">
        <div class="contact__form ercoding-form">
          <?php echo gravity_form($form_id, false, false, false, '', false, 11); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
