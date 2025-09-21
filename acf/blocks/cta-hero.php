<?php

$background = get_field('background');
$section_id = get_field('section_id');
$slider_content = get_field('slider_content');
$full_width = get_field('full_width');

$hero_cta_title = get_field('hero_cta_title');
$hero_cta_text = get_field('hero_cta_text');
$hero_cta_button = get_field('hero_cta_button');

?>

<?php if(!empty($slider_content)):?>
  <div class="cta-hero <?php if($background == 'true') { echo 'cta-hero--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="<?php if($full_width == 'true') { echo 'container-fluid container-fluid--max-width'; } else { echo 'container'; }?>">
      <div class="cta-hero__wrapper">
        <?php foreach($slider_content as $key => $item):?>
          <div class="cta-hero__item">
            <?php if(!empty($item['video'])):?>
              <div class="cta-hero__video">
                <video frameborder="0" loading="lazy" autoplay="" loop="" playsinline="" muted="" src="<?php echo esc_html($item['video']);?>" autoplay="autoplay" class="object-fit-cover"></video>
                <?php if('true' == $item['overlay']):?>
                  <div class="cta-hero__overlay"></div>
                <?php endif;?>
              </div>
            <?php elseif(!empty($item['image'])):?>
              <div class="cta-hero__image <?php if(!empty($item['button_link'])) { echo 'cta-hero__image--animated'; }?>">
                <?php echo wp_get_attachment_image($item['image'], 'full', '', ['class' => 'object-fit-cover']);?>
                <?php if('true' == $item['overlay']):?>
                  <div class="cta-hero__overlay"></div>
                <?php endif;?>
              </div>
            <?php endif;?>
            <div class="<?php if($full_width == 'true') { echo 'container'; } else { echo ''; }?>">
              <div class="row">
                <div class="col-12">
                  <div class="cta-hero__content <?php if($full_width == 'true') { echo 'cta-hero__content--full'; } else { echo ''; }?>">
                    <?php if(!empty($item['logo'])):?>
                      <div class="cta-hero__logo">
                        <?php echo wp_get_attachment_image($item['logo'], 'large',);?>
                      </div>
                    <?php endif;?>
                    <?php if(!empty($item['title'])):?>
                      <?php if($key == 0):?>
                        <h1 class="cta-hero__title"><?php echo apply_filters('the_title', $item['title']);?></h1>
                      <?php else:?>
                        <h2 class="cta-hero__title"><?php echo apply_filters('the_title', $item['title']);?></h2>
                      <?php endif;?>
                    <?php endif;?>
                    <?php if(!empty($item['text'])):?>
                      <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $item['text']));?>
                    <?php endif;?>
                    <?php if(!empty($item['button'])):?>
                      <a href="<?php echo esc_html($item['button']['url']);?>" class="button cta-hero__button"><?php echo esc_html($item['button']['title']);?></a>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach;?>
      </div>
    </div>
    <div class="container">
      <div class="button-banner cta-hero__button-banner">
        <div class="button-banner__wrapper">
          <div class="row button-banner__row">
            <div class="col-md-6 col-lg-8">
              <div class="button-banner__content">
                <h2 class="button-banner__title"><?php echo apply_filters('the_title', $hero_cta_title);?></h2>
                <?php if(!empty($hero_cta_text)):?>
                  <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $hero_cta_text));?>
                <?php endif;?>
              </div>
            </div>
            <?php if(!empty($hero_cta_button)):?>
              <div class="col-md-6 col-lg-4">
                <div class="button-banner__link-wrapper">
                  <a href="<?php echo esc_html($hero_cta_button['url']);?>" class="button-banner__button button"><?php echo esc_html($hero_cta_button['title']);?></a>
                </div>
              </div>
            <?php endif;?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif;?>
<?php if(!is_front_page()):?>
  <div id="subpage-hero-scroll-to"></div>
<?php endif;?>








