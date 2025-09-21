<?php

$background = get_field('background');
$section_id = get_field('section_id');
$slider_content = get_field('slider_content');
$full_width = get_field('full_width');

?>

<?php if(!empty($slider_content)):?>
  <div class="hero-slider <?php if($background == 'true') { echo 'hero-slider--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="<?php if($full_width == 'true') { echo 'container-fluid'; } else { echo 'container'; }?>">
      <div class="hero-slider__wrapper">
        <?php foreach($slider_content as $key => $item):?>
          <div class="hero-slider__item">
            <?php if(!empty($item['image'])):?>
            <div class="hero-slider__image <?php if(!empty($item['button_link'])) { echo 'hero-slider__image--animated'; }?>">
              <?php echo wp_get_attachment_image($item['image'], 'full', '', ['class' => 'object-fit-cover']);?>
              <?php if('true' == $item['overlay']):?>
                <div class="hero-slider__overlay"></div>
              <?php endif;?>
            </div>
            <?php endif;?>
            <div class="<?php if($full_width == 'true') { echo 'container'; } else { echo ''; }?>">
              <div class="row">
                <div class="col-md-7">
                  <div class="hero-slider__content <?php if($full_width == 'true') { echo 'hero-slider__content--full'; } else { echo ''; }?>">
                    <?php if(!empty($item['title'])):?>
                      <?php if($key == 0):?>
                        <h1 class="hero-slider__title"><?php echo apply_filters('the_title', $item['title']);?></h1>
                      <?php else:?>
                        <h2 class="hero-slider__title"><?php echo apply_filters('the_title', $item['title']);?></h2>
                      <?php endif;?>
                    <?php endif;?>
                    <?php if(!empty($item['subtitle'])):?>
                      <h2 class="hero-slider__subtitle"><?php echo apply_filters('the_title', $item['subtitle']);?></h2>
                    <?php endif;?>
                    <?php if(!empty($item['text'])):?>
                      <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $item['text']));?>
                    <?php endif;?>
                    <?php if(!empty($item['button'])):?>
                      <a href="<?php echo esc_html($item['button']['url']);?>" class="button hero-slider__button"><?php echo esc_html($item['button']['title']);?></a>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            </div>
            <?php if(!empty($item['button_link'])):?>
              <a href="<?php echo esc_url_raw($item['button_link']);?>" class="hero-slider__link"></a>
            <?php endif;?>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
<?php endif;?>
<?php if(!is_front_page()):?>
  <div id="subpage-hero-scroll-to"></div>
<?php endif;?>
