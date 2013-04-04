<?php
// including the main facebook sdk file
require 'src/facebook.php';

// building the Facebook object with the app and secret id
require 'constants.php';

// adding the album info
$album_name = 'YOUR ALBUM NAME';
$album_description = 'DESC OF THE ALBUM';

// Get the user id
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');

    // getting the user album
    $user_albums = $facebook->api("/me/albums");
    
    if ($user_albums) {
      foreach ($user_albums['data'] as $key => $album) {
        if ($album['name'] == $album_name) {
          $album_id = $album['id'];
          break;
        }
        else {
          $album_id = 'blank';
        }
      }
    }

    // if the album is not present, create the album
    if ($album_id == 'blank') {
      $graph_url = "https://graph.facebook.com/me/albums?" . "access_token=". $user;
      
      $album_data = array(
        'name' => $album_name,
        'message' => $album_description,
      );

      $new_album = $facebook->api("me/albums", 'post', $album_data);
      $album_id = $new_album['id'];
    }
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  // building the logout url
  $params = array(
    'next' => 'http://demos.amitavroy.com/fbconnect/logout.php'
  );
  $logoutUrl = $facebook->getLogoutUrl($params);
} 
else {
  // building the login url
  $params = array(
    'scope' => 'user_photos' // taking the photo upload permission
  );
  $loginUrl = $facebook->getLoginUrl($params);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Facebook Login</title>
</head>
<body>
  
  <div class="container">
    
    <div class="row">
      
      <div class="span12">
        <br>
        <div class="hero-unit">
          <h1>Facebook Connect Demo</h1>
          <br>
          <!--  Generating the login / logout link -->
          <?php if($user): ?>
          <div class="row">
            <div class="span1 pull-left">
              <img src="https://graph.facebook.com/<?php echo $user; ?>/picture" class="img-rounded">
            </div>
            <div class="span6 pull-left">
              <h3>Welcome <?php echo $user_profile['name']; ?></h3>
              <br>
              <label></label>
              <a href="<?php echo $logoutUrl; ?>" class="btn btn-danger">FB Logout</a>
            </div>
          </div>
        </div>
        <?php else: ?>
          <label>Click on the button below to Login using Facebook</label>
          <a href="<?php echo $loginUrl; ?>" class="btn btn-primary">FB Login</a>
        <?php endif; ?>

        <!--  Dump data when available -->
        <?php if (isset($user_profile)): ?>
        <!--  <h3>Your User Object (/me)</h3>-->
        <?php //print_r($user_profile); ?>
        <?php endif; ?>
      </div>

    </div>

    <div class="row">
      <div class="span8 offset1">
        <?php if ($user) : ?>
          <form enctype="multipart/form-data" method="POST" action="upload.php">
            <label>Adding photo to album: <?php print $album_name ?></label>
            <label>Please choose a photo:</label> <input name="photo" type="file">

            <label>Say something about this photo:</label>
            <input name="message" type="text" value="" style="height: 28px;">
            
            <label></label>
            <input type="submit" value="Upload" class="btn btn-primary" />
            
            <input type="hidden" name="album_id" value="<?php print $album_id; ?>">
          </form>
        <?php endif; ?>
      </div>
    </div>

    <hr>
    <div class="row">
      
      <div class="span12">
        <div class="span1 pull-left"><img src="https://graph.facebook.com/amitavr/picture" class="img-circle"></div>
        <h4>Demo by Amitav Roy</h4>
      </div>

    </div>

  </div>
  
</body>
</html>
