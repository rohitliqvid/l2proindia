<?php
//initialize facebook sdk
require 'vendor/autoload.php';
session_start();
include ("SocialLoginController.php");
    
    $fb = new Facebook\Facebook(['app_id' => '772336137253181', 
        'app_secret' => 'd449353653234696faa912891d245b03', 
        'default_graph_version' => 'v2.5'
    ]);

    $redirectUrl = 'https://l2proindia.com/facebook-login.php';

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email']; // optional
    
    try {
        if (isset($_SESSION['facebook_access_token'])) {
            $accessToken = $_SESSION['facebook_access_token'];
        } else {
            $accessToken = $helper->getAccessToken();
        }
    }
    catch(Facebook\Exceptions\facebookResponseException $e) {

    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
      
      
      	
    } else {
        $_SESSION['facebook_access_token'] = (string)$accessToken;
        $oAuth2Client = $fb->getOAuth2Client();
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string)$longLivedAccessToken;
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
      
     
    }
    if (isset($_GET['code'])) {
        try {
            $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
            $requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
            $picture = $requestPicture->getGraphUser();
            $profile = $profile_request->getGraphUser();
            $fbid = $profile->getProperty('id'); // To Get Facebook ID
            $fbfullname = $profile->getProperty('name'); // To Get Facebook full name
            $fbemail = $profile->getProperty('email'); //  To Get Facebook email
            $fbpic = "<img src='" . $picture['url'] . "' class='img-rounded'/>";
            
            $name_array = explode(" ",$fbfullname);
            $firstname  = $name_array[0];
            $lastname = '';
            if (count($name_array) == 2) {
                $lastname = $name_array[1];
            }elseif(count($name_array) == 2) {
                $last_names = array_slice($name_array ,1);
                $lastname = implode(' ',$last_names);
            }
            $register_info['social_login_type'] = 'facebook';
            $register_info['id'] =$fbid;
            $register_info['name'] =  $fbfullname;
            $register_info['firstname'] = $firstname;
            $register_info['lastname'] = $lastname;
            $register_info['email'] = $fbemail;
            $register_info['gender'] = '';
            //$register_info['picture'] = $picture['url'];
           
            loginAndRegister($register_info);

        }
        catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            session_destroy();
            // redirecting user back to app login page
            header("Location: ./");
            exit;
        }
        catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }
  
   	$loginUrl = $helper->getLoginUrl($redirectUrl, $permissions);
    header("Location: ".$loginUrl);
    
} else {
    // replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used
    $loginUrl = $helper->getLoginUrl($redirectUrl, $permissions);
    header("Location: ".$loginUrl);
}
?>