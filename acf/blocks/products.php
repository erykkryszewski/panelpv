<?php

$section_id = get_field('section_id');
$background = get_field('background');
$hide_section = get_field('hide_section');

$args = array(
  'post_type' => 'product',
  'posts_per_page' => 4,
);

$loop = new WP_Query($args);


?>

<?php if ($loop -> have_posts()):?>
  <div class="popular-products <?php if($hide_section == true) { echo 'display-none'; }?> <?php if($background == 'true') { echo 'popular-products--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="popular-products__wrapper">
        <div class="row popular-products__row">
          <?php while ($loop -> have_posts()):?>
            <?php $loop->the_post();
            $product_id = get_the_ID(); 
            set_query_var('product_id', $product_id);?>
              <li class="popular-products__item product">
                <a href="<?php echo get_the_permalink($product_id);?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                  <div class="product__image">
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id($product_id), 'full', '', ["class" => 'object-fit-contain']);?>
                  </div>
                  <h2 class="woocommerce-loop-product__title"><?php echo get_the_title($product_id);?></h2>
                  <?php woocommerce_template_single_price(); ?>
              </a>
              <div class="product__button-wrapper">
                <a href="<?php echo get_the_permalink($product_id);?>" class="button product__button button--orange">Zobacz produkt</a>
              </div>
            </li>
          <?php endwhile;?>
        </div>
      </div>
    </div>
  </div>
<?php endif;?>
<?php 
  wp_reset_postdata();
  wp_reset_query();
?>