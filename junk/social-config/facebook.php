<?php

    $facebook = new \Facebook\Facebook([
        'app_id' => '772336137253181',
        'app_secret' => 'd449353653234696faa912891d245b03',
        'default_graph_version' => 'v2.10'
    ]);
    $facebook_helper = $facebook->getRedirectLoginHelper();
?>

