<?php

// including the main facebook sdk file
require 'src/facebook.php';

// building the Facebook object with the app and secret id
require 'constants.php';

$uploadfile = './uploads/'.basename($_FILES['photo']['name']);
move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);

$full_image_path = realpath($uploadfile);

// checking if the message is present
if ($_POST['message']) {
  $args = array('message' => $_POST['message']);
}
$args['image'] = '@' . $full_image_path;

// Get the user id
$user = $facebook->getUser();

if ($user) {
  try {
    $data = $facebook->api("/" . $_POST['album_id'] . "/photos", 'post', $args);
    $pictue = $facebook->api('/'.$data['id']);
    $fb_image_link = $pictue['link']."&makeprofile=1";

    //redirect to uploaded photo url and change profile picture
    echo "<script type='text/javascript'>top.location.href = '$fb_image_link';</script>";
  }
  catch (FacebookApiException $e) {
    error_log($e);
  }
}