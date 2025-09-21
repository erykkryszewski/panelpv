<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$title = get_field('title');
$subtitle = get_field('subtitle');
$text = get_field('text');
$choice = get_field('choice');
$newsletter_shortcode = get_field('newsletter_shortcode');
$overlay = get_field('overlay');
$button = get_field('button');

?>


<div class="cta <?php if($background == 'true') { echo 'cta--background'; }?> <?php if(!is_front_page()) { echo 'cta--subpage'; } ?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="cta__background <?php if('true' == $overlay) { echo 'cta__background--overlay'; }?>">
    <?php 
      if(!empty($background)) { 
        echo wp_get_attachment_image($background, 'full', '', ['class' => 'object-fit-cover']);
      }
    ?>
  </div>
  <div class="container">
    <div class="cta__wrapper">
      <?php if(!empty($title)):?>
        <h2 class="cta__title"><?php echo apply_filters('the_title', $title);?></h2>
      <?php endif;?>
      <?php if(!empty($subtitle)):?>
        <h3 class="cta__subtitle"><?php echo apply_filters('the_title', $subtitle);?></h2>
      <?php endif;?>
      <?php if(!empty($text)):?>
        <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $text));?>
      <?php endif;?>
      <div>
        <?php if('newsletter' == $choice && !empty($newsletter_shortcode)):?>
          <?php echo do_shortcode($newsletter_shortcode);?>
        <?php elseif('link' == $choice && !empty($button)):?>
          <a href="<?php echo esc_html($button['url']);?>" class="cta__button button"><?php echo esc_html($button['title']);?></a>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>