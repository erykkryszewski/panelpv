<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$images = get_field('images');

?>

<?php if(!empty($images)):?>
  <div class="three-images <?php if($background == 'true') { echo 'three-images--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="row">
        <?php foreach($images as $key => $item):?>
          <div class="col-md-6 col-lg-4">
            <div class="three-images__item" style="height:<?php echo $item['height'];?>px">
              <?php if(!empty($item['image_class']) && !empty($item['image'])):?>
                <?php echo wp_get_attachment_image($item['image'], 'full', '', ['class' => $item['image_class']]);?>
              <?php elseif(empty($item['image_class']) && !empty($item['image'])):?>
                <?php echo wp_get_attachment_image($item['image'], 'full', '', ['class' => 'object-fit-cover']);?>
              <?php endif;?>
            </div>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
<?php endif;?>