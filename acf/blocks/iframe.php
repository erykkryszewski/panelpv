<?php 

$background = get_field('background');
$section_id = get_field('section_id');
$iframe_src = get_field('iframe_src');
$iframe_height = get_field('iframe_height');
$iframe_file = get_field('iframe_file');
$image = get_field('image');

?>

<?php if(!empty($iframe_file) || !empty($iframe_src)):?>
  <div class="iframe <?php if($background == 'true') { echo 'iframe--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <?php if(!empty($iframe_file)):?>
        <div class="iframe__element iframe__element--file" style="height:<?php echo esc_html($iframe_height);?>px">
          <div class="iframe__overlay">
            <?php if(!empty($image)):?>
              <div class="iframe__image"><?php echo wp_get_attachment_image($image, 'full', '', ['class' => 'object-fit-cover']);?></div>
            <?php endif;?>
            <a href="<?php echo esc_html($iframe_file);?>" data-fancybox class="cover iframe__link iframe__link--file"></a>
          </div>
        </div>
      <?php elseif(!empty($iframe_src)):?>
        <div class="iframe__element" style="height:<?php echo esc_html($iframe_height);?>px">
          <div class="iframe__overlay">
            <?php if(!empty($image)):?>
              <div class="iframe__image"><?php echo wp_get_attachment_image($image, 'full', '', ['class' => 'object-fit-cover']);?></div>
            <?php endif;?>
            <a href="<?php echo esc_html($iframe_src);?>" data-fancybox class="cover iframe__link"></a>
          </div>
        </div>
      <?php endif;?>
    </div>
  </div>
<?php endif;?>