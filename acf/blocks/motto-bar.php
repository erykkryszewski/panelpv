<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$text = get_field('text');

?>

<?php if(!empty($text)):?>
  <div class="motto-bar <?php if($background == 'true') { echo 'motto-bar--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="motto-bar__content">
      <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $text));?>
      </div>
    </div>
  </div>
<?php endif;?>


