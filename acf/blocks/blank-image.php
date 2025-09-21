<?php

$background = get_field('background');
$section_id = get_field('section_id');
$image = get_field('image');
$full_width = get_field('full_width');
$height = get_field('height');
$image_class = get_field('image_class');

?>

<?php if(!empty($image)):?>
  <div class="<?php if($full_width == 'true') { echo 'container-fluid'; } else { echo 'container'; }?>">
    <div class="blank-image" style="height:<?php echo esc_html($height);?>px">
      <?php if(!empty($section_id)):?>
        <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
      <?php endif;?>
      <?php echo wp_get_attachment_image($image, 'full', '', ["class" => $image_class]); ?>
    </div>
  </div>
<?php endif;?>