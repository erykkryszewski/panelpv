<?php

$section_id = get_field('section_id');
$background = get_field('background');

$regular_members = get_field('regular_members', 'options');
$supporting_members = get_field('supporting_members', 'options');

$members_type = get_field('members_type');
$items = '';

if ($members_type == 'regular') {
  $items = $regular_members;
} else {
  $items = $supporting_members;
}
?>

<?php if (!empty($items)): ?>
<section class="members">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <?php foreach ($items as $key => $item): ?>
    <div class="row members__row">
      <?php if (!empty($item['logo'])): ?>
      <div class="col-12 col-md-5 col-lg-3">
        <div class="members__logo">
          <?php echo wp_get_attachment_image($item['logo'], 'large', '', ['class' => '']); ?>
        </div>
      </div>
      <?php endif; ?>

      <div class="col-12 col-md-7 col-lg-9">
        <?php if (!empty($item['text'])): ?>
        <div class="members__content">
          <?php echo apply_filters('the_title', $item['text']); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>
