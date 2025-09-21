<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$title = get_field('title');
$text = get_field('text');
$button = get_field('button');

?>

<div class="thank-you <?php if($background == 'true') { echo 'thank-you--background'; }?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="container">
    <div class="thank-you__content">
      <h1 class="thank-you__title"><?php echo apply_filters('the_title', $title);?></h1>
      <?php echo apply_filters('the_title', $text);?>
      <?php if(!empty($button)):?>
        <a href="<?php echo esc_html($button['url']);?>" class="button thank-you__button"><?php echo esc_html($button['title']);?></a>
      <?php endif;?>
    </div>
  </div>
</div>