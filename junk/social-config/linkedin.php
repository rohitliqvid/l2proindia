<?php 
    $LIclient_id="86fohw8xltt4y1";
    $LIclient_secret="DSXcIEWD45Ws0KTD";
    $LIcall_back="https://l2pro.testingdemo.net/social-login.php";
    $LIscope='r_liteprofile r_emailaddress';

    function getLinkedinAuthorizationCode($client_id,$scope,$call_back) {
        $params = array('response_type' => 'code',
            'client_id' => $client_id,
            'scope' => $scope,
            'state' => uniqid('', true), // unique long string
            'redirect_uri' => $call_back,
        );

        // Authentication request
        $url = 'https://www.linkedin.com/uas/oauth2/authorization?'.http_build_query($params);
        // Needed to identify request when it returns to us
        $_SESSION['state'] = $params['state'];
        // Redirect user to authenticate
        header("Location: $url");
        exit;
    }


    function getLinkedInAccessToken($client_id,$client_secret,$call_back) {

        $params = array('grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $_GET['code'],
            'redirect_uri' => $call_back,
        );
        // Access Token request
        $url = 'https://www.linkedin.com/uas/oauth2/accessToken?'.http_build_query($params);

        // Make a POST request
        // $context = stream_context_create(
        //     array('http' =>
        //         array('method' => 'POST',
        //         )
        //     )
        // );
        $context= stream_context_create(array(
            "ssl"=>array(
                  "verify_peer"=>false,
                  "verify_peer_name"=>false,
              ),
          )); 
        // Retrieve token information in JSON
        $response = file_get_contents($url, false, $context);
        $token = json_decode($response);
        // Store access token and expiration time in session

        $_SESSION['access_token'] = $token->access_token; 
        $_SESSION['expires_in'] = $token->expires_in; 
        $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; 
        return true;
    }


    function linkedInresponse($method, $resource, $body = '') {
        $params = array('oauth2_access_token' => $_SESSION['access_token']);
        $url = "https://api.linkedin.com/v2/me?".http_build_query($params);

        $context = stream_context_create(
            array('http' =>
            array('method' => $method))
        );
        $response = file_get_contents($url, false, $context);
        $user = json_decode($response);
        if (!empty($user)) {
            return $user;
        }
        $url = "https://api.linkedin.com/v2/me?".http_build_query($params);

        return false;
    }