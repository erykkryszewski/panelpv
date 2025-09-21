<?php


$background = get_field('background');
$section_id = get_field('section_id');
$text = get_field('text');
$button = get_field('button');
 
/* cuntdown function */
$counter_date = get_field('counter_date');
$counter_hour = get_field('counter_hour');

$final_time_string = $counter_date . ' ' . $counter_hour;
$user_timezone = new DateTimeZone('Europe/Berlin');
$final_time = new DateTime($final_time_string, $user_timezone);
$now = new DateTime('now', $user_timezone);

?>
 
<?php if($now < $final_time):?>
  <div class="counter <?php if($background == 'true') { echo 'counter--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="row counter__row">
        <div class="col-12 col-xl-5">
          <div class="counter__content">
            <?php if(!empty($text)):?>
              <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $text));?>
            <?php endif;?>
            <!-- <?php if(!empty($button)):?>
              <a href="<?php echo esc_html($button['url']);?>" target="_blank" class="button counter__button"><?php echo esc_html($button['title']);?></a>
            <?php endif;?> -->
          </div>
        </div>
        <div class="col-12 col-xl-7">
          <div class="counter__time-wrapper" id="<?php echo esc_html($final_time->format('Y-m-d H:i:s'));?>">
            <div class="counter__item counter__day">99</div>
            <div class="counter__item counter__hour">99</div>
            <div class="counter__item counter__minute">99</div>
            <div class="counter__item counter__second">99</div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif;?>



