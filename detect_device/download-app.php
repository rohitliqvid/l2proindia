<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125032741-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125032741-1');
</script>
</head>
<?php 

require_once dirname(__FILE__).'/detect.php';
require_once dirname(__FILE__).'/config.php';


$isMobile = 0;
$deviceType = '';
$isPhone = 0;
$isTablet = 0;
$isComputer = 0;
$ip = '';
$ipHostName = '';
$ipOrg = '';
$ipCountry = '';
$os = '';
$browser = '';
$brand = '';
$isiOS = 0;
$isAndroidOS = 0;
$userAgentInfo = $_SERVER['HTTP_USER_AGENT'];


// Any mobile device (phones or tablets).
if (Detect::isMobile()) {
    $isMobile = 1;
}

// Gets the device type ('Computer', 'Phone' or 'Tablet').
$deviceType = Detect::deviceType();

// Any phone device
if (Detect::isPhone()) {
    
    $isPhone = 1;
}

// Any tablet device.
if (Detect::isTablet()) {
    $isTablet = 1;
}

// Any computer device (desktops or laptops).
if (Detect::isComputer()) {
    $isComputer = 1;
}

// Get the IP address of the device.
$ip = Detect::ip();

// Get the ID address host name of the device.
$ipHostName = Detect::ipHostname();

// Get the IP address organisation of the device.
$ipOrg =  Detect::ipOrg();

// Get the country the IP address is in (IP address location inaccurate).
// (JS function available which uses GPS)
$ipCountry = Detect::ipCountry();

// Get the name & version of operating system.
$os = Detect::os();

// Get the name & version of browser.
$browser = Detect::browser();

// Get the brand of device (only works with mobile devices otherwise return null).
$brand =  Detect::brand();

// Check for a specific platform with the help of the magic methods:
if (Detect::isiOS()) {
    $isiOS = 1;
}

if (Detect::isAndroidOS()) {
    $isAndroidOS = 1;
}
if( $isiOS ){

	header('Location:'. IOS_DOWNLOAD_URL);
	die;

}else if( $isAndroidOS ){

	header('Location:'. ANDROID_DOWNLOAD_URL);
	die;

}else{
	//echo 'Invalid platform.';
}