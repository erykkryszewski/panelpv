<?php 

$background = get_field('background');
$section_id = get_field('section_id');
$icons = get_field('icons');
$icons_number = get_field('icons_number');

?>

<?php if(!empty($icons)):?>
  <div class="icons <?php if($background == 'true') { echo 'icons--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="icons__wrapper">
        <?php foreach($icons as $key => $item):?>
          <div class="icons__item">
            <?php if(!empty($item['icon'])):?>
              <div>
                <?php echo wp_get_attachment_image($item['icon'], 'full', '', ['class' => 'object-fit-contain']);?>
              </div>
            <?php endif;?>
            <?php if(!empty($item['text'])):?>
              <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $item['text']));?>
            <?php endif;?>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
<?php endif;?>