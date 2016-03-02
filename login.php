<?php
require_once __DIR__ . '/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '1584972105072992', // Replace {app-id} with your app id
  'app_secret' => '5d8b2c333ab16775869806dfcc6591ff',
  'default_graph_version' => 'v2.2',
  ]);
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name', '{access-token}');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'Name: ' . $user['name'];
$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  echo 'No cookie set or no OAuth data could be obtained from cookie.';
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());



?>
