<?php
// including the main facebook sdk file
require 'src/facebook.php';

// building the Facebook object with the app and secret id
require 'constants.php';

$facebook->destroySession();

header("Location: http://demos.amitavroy.com/fbconnect");