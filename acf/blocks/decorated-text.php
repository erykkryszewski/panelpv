<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$text = get_field('text');

?>

<?php if(!empty($text)):?>
  <div class="decorated-text <?php if($background == 'true') { echo 'decorated-text--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="decorated-text__wrapper">
        <h3 class="decorated-text__title"><?php echo esc_html(str_replace('&nbsp;', ' ', $text));?></h3>
      </div>
    </div>
  </div>
<?php endif;?>