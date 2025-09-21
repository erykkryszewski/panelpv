<?php 

$section_id = get_field('section_id');
$background = get_field('background');
$list = get_field('list');
$pointers_or_numbers = get_field('pointers_or_numbers');

?>

<?php if(!empty($list)):?>
  <div class="list <?php if($pointers_or_numbers == 'pointers') { echo 'list--unordered'; } else { echo 'list--ordered'; }?> <?php if($background == 'true') { echo 'list--background'; }?>">
    <?php if(!empty($section_id)):?>
      <div class="section-id" id="<?php echo esc_html($section_id);?>"></div>
    <?php endif;?>
    <div class="container">
      <div class="list__wrapper">
        <?php foreach($list as $key => $item):?>
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
              <?php if(!empty($item['text'])):?>
                <?php echo apply_filters('acf_the_content', str_replace('&nbsp;', ' ', $item['text']));?>
              <?php endif;?>
            </div>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
<?php endif;?>