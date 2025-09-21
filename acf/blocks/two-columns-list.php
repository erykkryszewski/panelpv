
<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$left_list = get_field('left_list');
$right_list = get_field('right_list');
$pointers_or_numbers = get_field('pointers_or_numbers');

?>


<div class="list <?php if($pointers_or_numbers == 'pointers') { echo 'list--unordered'; } else { echo 'list--ordered'; }?> <?php if($background == 'true') { echo 'list--background'; }?>">
  <?php if(!empty($section_id)):?>
    <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
  <?php endif;?>
  <div class="container">
    <div class="list__wrapper">
      <div class="row">
        <?php if(!empty($left_list)):?>
          <div class="col-md-6">
            <?php foreach($left_list as $key => $item):?>
              <div class="list__item <?php if($pointers_or_numbers == 'pointers') { echo 'list__item--unordered'; } else { echo 'list__item--ordered'; }?>">
                <?php if($pointers_or_numbers == 'numbers'):?>
                  <span class="list__number">
                    <?php echo $key+1;?>
                  </span>
                <?php endif;?>
                <div>
                  <?php if(!empty($item['title'])):?>
                    <h3 class="list__title"><?php echo apply_filters('the_title', $item['title']);?></h3>
                  <?php endif;?>
                  <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $item['text']));?>
                </div>
              </div>
            <?php endforeach;?>
          </div>
        <?php endif;?>
        <?php if(!empty($right_list)):?>
          <div class="col-md-6">
            <?php foreach($right_list as $key => $item):?>
              <div class="list__item <?php if($pointers_or_numbers == 'pointers') { echo 'list__item--unordered'; } else { echo 'list__item--ordered'; }?>">
                <?php if($pointers_or_numbers == 'numbers'):?>
                  <span class="list__number">
                    <?php echo $key+1;?>
                  </span>
                <?php endif;?>
                <div>
                  <?php if(!empty($item['title'])):?>
                    <h3 class="list__title"><?php echo apply_filters('the_title', $item['title']);?></h3>
                  <?php endif;?>
                  <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $item['text']));?>
                </div>
              </div>
            <?php endforeach;?>
          </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
