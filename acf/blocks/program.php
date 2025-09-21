<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$program = get_field('program');

?>

<?php if(!empty($program)):?>
  <div class="program <?php if($background == 'true') { echo 'program--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="program__nav">
        <?php foreach($program as $key => $item):?>
          <button class="button program__button <?php if($key == 0) { echo 'active'; }?>" data-id="<?php echo esc_html($item['day_id']);?>"><?php echo esc_html($item['day']);?></button>
        <?php endforeach;?>
      </div>
      <div class="program__wrapper">
        <?php foreach($program as $key => $item):?>
          <div class="program__item" id="<?php echo esc_html($item['day_id']);?>">
            <h3 class="program__title"><?php echo apply_filters('the_title', $item['day']);?></h3>
            <span class="program__date"><?php echo apply_filters('the_title', $item['date']);?></span>
            <?php if(!empty($item['timeline'])):?>
              <div class="program__timeline">
                <?php foreach($item['timeline'] as $key => $timeline):?>
                  <div class="program__info">
                    <span class="program__time"><?php echo esc_html($timeline['time']);?></span>
                    <span class="program__subtitle"><?php echo esc_html($timeline['title']);?></span>
                    <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $timeline['text']));?>
                  </div>
                <?php endforeach;?>
              </div>
            <?php endif;?>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
<?php endif;?>