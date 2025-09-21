<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$left_button = get_field('left_button');
$right_button = get_field('right_button');

?>

<?php if(!empty($left_button) || !empty($right_button)):?>
  <div class="two-buttons <?php if($background == 'true') { echo 'two-buttons--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="two-buttons__wrapper">
        <?php if(!empty($left_button)):?>
          <a href="<?php echo esc_html($left_button['url']);?>" class="button two-buttons__button two-buttons__button--left"><?php echo esc_html($left_button['title']);?></a>
        <?php endif;?>
        <?php if(!empty($right_button)):?>
          <a href="<?php echo esc_html($right_button['url']);?>" class="button two-buttons__button two-buttons__button--right"><?php echo esc_html($right_button['title']);?></a>
        <?php endif;?>
      </div>
    </div>
  </div>
<?php endif;?>