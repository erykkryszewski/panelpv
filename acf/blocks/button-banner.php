<?php 

$background = get_field('background');
$section_id = get_field('section_id');
$title = get_field('title');
$text = get_field('text');
$button = get_field('button');

?>

<div class="button-banner <?php if($background == 'true') { echo 'button-banner--background'; }?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="container">
    <div class="button-banner__wrapper">
      <div class="row">
        <div class="col-md-6">
          <div class="button-banner__content">
            <?php if(!empty($title)):?>
              <h2 class="button-banner__title"><?php echo apply_filters('the_title', $title);?></h2>
            <?php endif;?>
            <?php if(!empty($text)):?>
              <?php echo apply_filters('acf_the_content', $text);?>
            <?php endif;?>
          </div>
        </div>
        <?php if(!empty($button)):?>
          <div class="col-md-6">
            <div class="button-banner__link-wrapper">
              <a href="<?php echo esc_html($button['url']);?>" class="button-banner__button button"><?php echo esc_html($button['title']);?></a>
            </div>
          </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>