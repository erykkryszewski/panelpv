<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$title = get_field('title');
$image = get_field('image');

?>

<div class="subpage-hero <?php if($background == 'true') { echo 'subpage-hero--background'; }?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="subpage-hero__background <?php if(empty($image)) { echo 'subpage-hero__background--plain'; }?>">
    <?php if(!empty($image)):?>
      <?php echo wp_get_attachment_image($image, 'full', '', ['class' => 'object-fit-cover']);?>
    <?php endif;?>
    <div class="subpage-hero__overlay"></div>
  </div>
  <div class="container">
    <div class="subpage-hero__wrapper">
      <h1 class="subpage-hero__title <?php if(!empty($image)) { echo 'subpage-hero__title--white'; }?>"><?php echo apply_filters('the_title', $title);?></h1>
    </div>
  </div>
</div>