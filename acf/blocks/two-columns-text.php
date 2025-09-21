<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$section_title = get_field('section_title');
$left_column_text = get_field('left_column_text');
$right_column_text = get_field('right_column_text');
$right_column_text = get_field('right_column_text');

?>

<div class="two-columns-text <?php if('true' == $background) { echo 'text-with-image--background'; }?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="container">
    <?php if(!empty($section_title)):?>
      <div class="two-columns-text__section-title section-title">
        <h2><?php echo apply_filters('the_title', $section_title);?></h2>
      </div>
    <?php endif;?>
    <div class="row">
      <div class="col-md-6">
        <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $left_column_text));?>
      </div>
      <div class="col-md-6">
        <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $right_column_text));?>
      </div>
    </div>
  </div>
</div>