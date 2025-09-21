<?php 

$background = get_field('background');
$section_id = get_field('section_id');
$button = get_field('button');
$centered = get_field('centered');

?>

<?php if(!empty($button)):?>
  <div class="blank-button <?php if($centered == 'true') { echo 'blank-button--centered'; }?> <?php if($background == 'true') { echo 'blank-button--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <a href="<?php echo esc_html($button['url']);?>" class="blank-button__button button"><?php echo esc_html($button['title']);?></a>
    </div>
  </div>
<?php endif;?>