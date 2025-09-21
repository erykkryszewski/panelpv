<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$direction = get_field('direction');
$text = get_field('text');
$image = get_field('image');
$circle = get_field('circle');
$author = get_field('author');

?>

<div class="text-image-decorated <?php if('true' == $background) { echo 'text-image-decorated--background'; }?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="container">
    <div class="row text-image-decorated__row <?php if('reverse' == $direction) { echo 'text-image-decorated__row--reverse'; }?>">
      <div class="col-12 col-lg-8 col-xl-9">
        <div class="text-image-decorated__content">
        <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $text));?>
        </div>
      </div>
      <?php if(!empty($image)):?>
        <div class="col-12 col-lg-4 col-xl-3">
          <div class="text-image-decorated__column">
            <div>
              <div class="text-image-decorated__picture <?php if('reverse' == $direction) { echo 'text-image-decorated__picture--reverse'; }?> <?php if('true' == $circle) { echo 'text-image-decorated__picture--circle'; }?>">
                <?php echo wp_get_attachment_image($image, 'large', '', ['class' => 'object-fit-cover']);?>
              </div>
              <span class="text-image-decorated__author"><?php echo esc_html($author);?></span>
            </div>
          </div>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>