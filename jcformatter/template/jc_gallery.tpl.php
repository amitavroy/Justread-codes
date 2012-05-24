<?php

?>
<div id="gallery-content-container" class="gallery-container-div clearfix">
  <div id="jcarousel-list">
    
    <ul id="gallery-carousel">
      <?php foreach ($data['images'] as $key => $value): ?>
        <li>
          <div id="main-image-<?php print $key; ?>" class="main-images">
            <?php 
            // Assign emtpy just in case.
            $image_alt = '';
            $image_title = '';

            if (!empty($value['alt'])) {
              $image_alt = $value['alt'];
            }
            if (!empty($value['title'])) {
              $image_title = $value['title'];
            }

            $gallery_main_image = theme('image_style', array(
              'style_name' => $data['image_style'],
              'path' => $value['uri'],
              'alt' => $image_alt,
              'title' => $image_alt,
            ));
            print $gallery_main_image;
            ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <div id="gallery-navigation" class="gallery-navigation">
      <div class="float-left previous">Prev</div>
      <div class="float-right next">Next</div>
    </div>

  </div>
</div>

<?php
// $image = '';
// foreach ($data['images'] as $key => $value) {
//   $image .= theme('image_style', array(
//     'style_name' => $data['image_style'],
//     'path' => $value['uri'],
//   ));
// }
// print $image;
?>