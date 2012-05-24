<?php
$image = '';
foreach ($data['images'] as $key => $value) {
  $image .= theme('image_style', array(
    'style_name' => $data['image_style'],
    'path' => $value['uri'],
  ));
}
print $image;
?>