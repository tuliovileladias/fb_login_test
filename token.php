<?php

// Get PHP SDK

require_once __DIR__ . '/vendor/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '1552416164886649',
  'app_secret' => 'f906e89e2b1391fa9cdf72bc839f982c',
  'default_graph_version' => 'v5.0',
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.

require_once __DIR__ . '/index.php';

$helper = $fb->getJavaScriptHelper();

//

try {
  // Get the UserNode object for the current user name.
  $accessToken = $helper->getAccessToken();
  //$user_name_response = $fb->get('/me', $access_token);


} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  echo 'nope, no token.';
  exit;
}


  echo '<h3>Access Token</h3>';
  //var_dump($accessToken->getValue());

  $access_token = $accessToken->getValue();
  echo nl2br("My token is ". $access_token);


  $_SESSION['fb_access_token'] = (string) $accessToken;

//Returns all data for feed


try {
   
// Get your UserNode object, replace {access-token} with your token
  $response = $fb->get('/me', '{access-token}');

} catch(\Facebook\Exceptions\FacebookResponseException $e) {
        // Returns Graph API errors when they occur
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
        // Returns SDK errors when validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();

       //Print out my name
echo nl2br("My name is " . $me->getName());


?>

</body>
</html>