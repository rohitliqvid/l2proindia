<?php

require_once './vendor/autoload.php';
session_start();
require_once './social-config/google.php';
require_once './social-config/linkedin.php';
require_once './social-config/twitter.php';

use Abraham\TwitterOAuth\TwitterOAuth;
include ("SocialLoginController.php");

try {
    $register_info = [];
    if (isset($_GET['code']) && $_SESSION['type'] == "google") {
        try {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);
                $_SESSION['access_token']=$token;
          		
                $gauth = new Google_Service_Oauth2($client);
                $user = $gauth->userinfo->get();
                
          		$name_array = explode(" ",$user->name);
                $firstname  = $name_array[0];
                $lastname = '';
                if (count($name_array) == 2) {
                    $lastname = $name_array[1];
                }elseif(count($name_array) == 2) {
                    $last_names = array_slice($name_array ,1);
                    $lastname = implode(' ',$last_names);
                }
                $register_info['social_login_type'] = 'google';
                $register_info['id'] = $user->id;
                $register_info['name'] = $user->name;
                $register_info['firstname'] =$firstname;
                $register_info['lastname'] = $lastname;
                $register_info['email'] = $user->email;
                $register_info['gender'] = $user->gender;
                $register_info['picture'] = $user->picture;
          		
          		loginAndRegister($register_info);
        } catch (\Throwable $e) {
            echo "Error: ".$e->getMessage();
        }
    }
    elseif((isset($_GET['code']) || isset($_GET['error'])) && $_SESSION['type'] = "linkedin") {
        try {

            if($_SESSION['state'] == $_GET['state']) {
                // Get token so you can make API calls
                if(isset($_GET['error'])) {
                    // The error with description returned by linkedIn
                    echo $_GET['error'] . ': ' . $_GET['error_description'];
                    exit;
                } 
                getLinkedInAccessToken($LIclient_id,$LIclient_secret,$LIcall_back);
                $user = linkedInresponse('GET', '/v1/people/~:(firstName,lastName,emailAddress)');

                $register_info['social_login_type'] = 'linkedin';
                $register_info['id'] = $user->id;
                $register_info['name'] = $user->localizedFirstName .'' . $user->localizedLastName;
                $register_info['firstname'] = $user->localizedFirstName;
                $register_info['lastname'] = $user->localizedLastName;
                $register_info['email'] = '';
                $register_info['gender'] = '';
                $register_info['picture'] = '';

                loginAndRegister($register_info);
                if ($user !== false) {
                    $_SESSION['user_name']=$user->localizedFirstName.' '.$user->localizedLastName;
                    $_SESSION['user_email'] = "N/A";
                    header('Location:../../index.php#item2');
                    die();
                }
            } else {
                // CSRF attack? Or did you mix up your states?
                exit;
            }
        } catch (\Throwable $e) {
            echo "Error: ".$e->getMessage();
        }
    }
    else{
        if ($_GET['login_type'] == "google") {
            session_destroy();
            session_start();
            $_SESSION['type'] = "google";
            header("Location: ".$client->createAuthUrl());
            die();
        }elseif ($_GET['login_type'] == "linkedin") {
            
            session_destroy();
            session_start();
            $_SESSION['type'] = "linkedin";
            getLinkedinAuthorizationCode($LIclient_id,$LIscope,$LIcall_back);
            die();
        }elseif ($_GET['login_type'] == "twitter") {
            
            session_destroy();
            session_start();
            $_SESSION['type'] = "twitter";
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->oauth( 'oauth/request_token', array( 'oauth_callback' => OAUTH_CALLBACK ));
            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
            $url = $connection->url( 'oauth/authorize', array( 'oauth_token' => $request_token['oauth_token']));
            header("Location:" .$url);
            exit();
        }
    }
    

} catch (\Throwable $e) {
    echo "Error: ".$e->getMessage();
}
