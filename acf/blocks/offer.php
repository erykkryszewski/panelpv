<?php

$section_id = get_field('section_id');
$background = get_field('background');
$offer = get_field('offer');

?>

<?php if (!empty($offer)): ?>
  <section class="offer <?php if ($background == 'true') { echo 'offer--background'; } ?>">
    <?php if (!empty($section_id)): ?>
      <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
    <?php endif; ?>
    <div class="container">
      <div class="row">
        <?php foreach ($offer as $key => $item): ?>
          <div class="col-md-6 col-lg-3">
            <div class="offer__item">
              <?php if (!empty($item['button'])): ?>
                <a href="<?php echo esc_url($item['button']['url']); ?>" class="cover"></a>
              <?php endif; ?>
              <?php if (!empty($item['image'])): ?>
                <div class="offer__image">
                  <?php echo wp_get_attachment_image($item['image'], 'large', false, ['class' => 'object-fit-cover']); ?>
                </div>
              <?php endif; ?>
              <h3 class="offer__title"><?php echo apply_filters('the_title', $item['title']); ?></h3>
              <p>              
                <?php echo apply_filters('the_title', $item['text']); ?>
              </p>
              <?php if (!empty($item['button'])): ?>
                <a href="<?php echo esc_url($item['button']['url']); ?>" class="offer__button"><?php echo esc_html($item['button']['title']); ?></a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
