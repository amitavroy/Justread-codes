<?php

foreach ($data as $key => $value) {
  $image = theme('image_style', array(
    'style_name' => 'medium',
    'path' => $value['uri'],
  ));

  print $image;
}

?>