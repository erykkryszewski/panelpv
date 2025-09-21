<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$stats = get_field('stats');

?>

<?php if(!empty($stats)):?>
  <div class="stats <?php if($background == 'true') { echo 'stats--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="stats__wrapper">
        <?php foreach($stats as $key => $item):?>
          <div class="stats__item">
            <svg class="animated-number" viewbox="0 0 33.83098862 33.83098862" width="90" height="90" xmlns="http://www.w3.org/2000/svg">
              <circle class="animated-number__background" stroke="#efefef" stroke-width="2" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
              <circle 
                class="animated-number__circle" 
                stroke="<?php echo ($item['value'] <= 49) ? '#db0000' : (($item['value'] > 49 && $item['value'] < 90) ? '#f5bf42' : '#089600'); ?>" 
                stroke-width="2" 
                stroke-dasharray="0,100" 
                stroke-linecap="round" 
                fill="none" 
                cx="16.91549431" 
                cy="16.91549431" 
                r="15.91549431"
                data-dasharray="<?php echo esc_attr($item['value']); ?>"
              />
              <g class="animated-number__info">
                <text class="animated-number__percent" x="16.91549431" y="16.5" alignment-baseline="central" text-anchor="middle" font-size="10"><?php echo esc_attr($item['value']); ?>%</text>
              </g>
            </svg>
            <h3 class="stats__title"><?php echo apply_filters('the_title', $item['title']);?></h3>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
<?php endif;?>
