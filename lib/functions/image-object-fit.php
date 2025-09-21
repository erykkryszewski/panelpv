<?php 

function image_object_fit($file) {
  if(!$file) {
    return false;
  }
  
  $image_class = 'object-fit-cover';
  
  $image_extensions = [
    'jpg'  => 'imagecreatefromjpeg',
    'jpeg' => 'imagecreatefromjpeg',
    'png'  => 'imagecreatefrompng',
    'gif'  => 'imagecreatefromgif',
    'webp'  => 'imagecreatefromwebp',
  ];
  
  $extension = strtolower( substr( $file, strrpos( $file, '.' ) + 1 ) );
  
  if ( $image_extension = $image_extensions[ $extension ] ) {
    $image = $image_extension( $file );
    $rgb = imagecolorat($image, 10, 15);
  
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
  
    if (isset($rgb) & (255 === $r && 255 === $g && 255 === $b)) {
      $image_class = 'object-fit-contain';
    }
  }

  return $image_class;
}
