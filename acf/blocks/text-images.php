<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$title = get_field('title');
$text = get_field('text');
$button = get_field('button');

$left_image = get_field('left_image');
$right_image = get_field('right_image');
$top_image = get_field('top_image');

?>

<div class="text-images <?php if($background == 'true') { echo 'text-images--background'; }?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="text-images__pattern">
    <svg xmlns="http://www.w3.org/2000/svg"><defs><pattern id="a" width="87" height="50.232" patternTransform="scale(2)" patternUnits="userSpaceOnUse"><rect width="100%" height="100%" fill="#fff"/><path fill="none" stroke="#eceef4" stroke-linecap="square" d="m0 54.424 14.5-8.373c4.813 2.767 9.705 5.573 14.5 8.37l14.5-8.373V29.303M0 4.193v16.744l-14.5 8.373L0 37.68l14.5-8.374V12.562l29-16.746m43.5 58.6-14.5-8.37v-33.49c-4.795-2.797-9.687-5.603-14.5-8.37m43.5 25.111L87 37.67c-4.795-2.797-24.187-13.973-29-16.74l-14.5 8.373-14.5-8.37v-33.489m72.5 8.365L87 4.183l-14.5-8.37M87 4.183v16.745L58 37.673v16.744m0-66.976V4.185L43.5 12.56c-4.795-2.797-24.187-13.973-29-16.74L0 4.192l-14.5-8.37m29 33.484c4.813 2.767 9.705 5.573 14.5 8.37V54.42"/></pattern></defs><rect width="800%" height="800%" fill="url(#a)" transform="translate(0 -.928)"/></svg>
  </div>
  <div class="container">
    <div class="row text-images__row">
      <div class="col-md-6">
        <div class="text-images__content">
          <h2 class="text-images__title"><?php echo apply_filters('the_title', $title);?></h2>
          <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $text));?>
          <?php if(!empty($button)):?>
            <a href="<?php echo esc_html($button['url']);?>" class="button text-images__button"><?php echo esc_html($button['title']);?></a>
          <?php endif;?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="text-images__pictures-wrapper">
          <?php if(!empty($left_image)):?>
            <div class="text-images__left-picture">
              <?php echo wp_get_attachment_image($left_image, 'text-images-left', '', ['class' => 'object-fit-cover']);?>
            </div>
          <?php endif;?>
          <?php if(!empty($right_image)):?>
            <div class="text-images__right-picture">
              <?php echo wp_get_attachment_image($right_image, 'text-images-right', '', ['class' => 'object-fit-cover']);?>
            </div>
          <?php endif;?>
          <?php if(!empty($top_image)):?>
            <div class="text-images__top-picture">
              <?php echo wp_get_attachment_image($top_image, 'text-images-top', '', ['class' => 'object-fit-cover']);?>
            </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</div>