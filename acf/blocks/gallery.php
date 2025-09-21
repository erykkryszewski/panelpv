<?php 

$background = get_field('background');
$section_id = get_field('section_id');
$gallery = get_field('gallery');
$full_width = get_field('full_width');

?>

<?php if(!empty($gallery)):?>
  <div class="gallery <?php if($background == 'true') { echo 'gallery--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="<?php if($full_width == 'true') { echo 'container-fluid container-fluid--padding'; } else { echo 'container'; }?>">
      <div class="gallery__slider">
        <?php foreach($gallery as $key => $item):?>
          <div class="gallery__item">
            <?php
              $full_image_src = wp_get_attachment_image_src($item['image'], 'full');
              $image_size = $full_width == 'true' ? 'large' : 'medium';
            ?>
            <?php if(!empty($item['image'])):?>
              <a class="gallery__image <?php if($full_width == 'true') { echo 'gallery__image--full-width'; }?>" data-fancybox="gallery" href="<?php echo esc_url($full_image_src[0]);?>">
                <?php echo wp_get_attachment_image($item['image'], $image_size, false, array('class' => 'object-fit-cover', 'alt' => 'tacy-sami-galeria-'.($key+1), 'title' => 'tacy-sami-galeria-'.($key+1))); ?>
              </a>
            <?php endif;?>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
<?php endif;?>
