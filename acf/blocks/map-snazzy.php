<?php 

$map_marker = get_field('map_marker');
$marker_url = wp_get_attachment_image_src($map_marker);

?>

<div class="map-snazzy" data-zoom="15" data-marker-url="<?php echo esc_url_raw($marker_url[0]);?>"> 
  <div class="map-snazzy__marker" data-lat="51.103920" data-lng="17.086220"></div> 
</div>
