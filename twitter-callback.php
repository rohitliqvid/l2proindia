<?php
    require_once './vendor/autoload.php';
	// using sessions to store token info
	session_start();
    require_once './social-config/twitter.php';

    use Abraham\TwitterOAuth\TwitterOAuth;
    include ("SocialLoginController.php");

    if (isset($_GET['oauth_verifier'] ) && isset( $_GET['oauth_token'] ) && isset( $_SESSION['oauth_token'] ) && $_GET['oauth_token'] ==    $_SESSION['oauth_token'] ) {
        $connection = new TwitterOAuth( CONSUMER_KEY, 0, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
		// get an access token
		$user_data = $connection->oauth( "oauth/access_token", array( "oauth_verifier" => $_GET['oauth_verifier'] ) );
		// save access token to the session
		$_SESSION['user_data'] = $user_data;
        $register_info['social_login_type'] = 'twitter';
        $register_info['id'] = $user_data['user_id'];
        $register_info['name'] = $user_data['screen_name'];
        $register_info['firstname'] = '';
        $register_info['lastname'] = '';
        $register_info['email'] = '';
        $register_info['gender'] = '';
        $register_info['picture'] = '';

        loginAndRegister($register_info);
        exit();
    }else{
        header("Location: index.php");
        exit();
    }