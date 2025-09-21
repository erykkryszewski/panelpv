<?php

get_header();
the_post();

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

?>

<main id="main" class="main <?php if(!is_front_page()) { echo 'main--subpage'; }?> <?php if(strpos($url, 'polityka-prywatnosci') !== false || strpos($url, 'regulamin') !== false) { echo 'main--rules-page'; }?>">
  <?php the_content(); ?>
</main>
<?php get_footer(); ?>


