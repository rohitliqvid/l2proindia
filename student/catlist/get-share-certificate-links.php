<?php
session_start();
include "../../connect.php";
/* if (!isset($_SESSION['sess_uid'])) {
    header("Location: ../../");
    exit();
}
include "../../connect.php";
if (isset($_POST)) {
    $user_rowid = 0;
    $docid = 0;
    $level_name = 0;

    getShareCertificateLinks($user_rowid, $docid, $level_name);
}

function getShareCertificateLinks($user_rowid, $docid, $level_name, $type)
{
    $certificate_query = "SELECT * FROM tbl_certificates where user_id=$user_rowid and sco_id=$docid and level_name='$level_name'";
    $certificate_query_result = mysql_db_query($database, $certificate_query) or die("Failed Query of" . $certificate_query);
    $certificate_query_response = mysql_fetch_assoc($certificate_query_result);
    $share_url = !empty($certificate_query_response) ? $certificate_query_response['cert_path'] : '';

    $create_path = 'webapi/certs/library/generate-and-share-certificate.php?docId=' . $docid . '&userRowId=' . $user_rowid . '&levelname=' . $level_name . '&social_share_type=';

    $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
    $link = $link . $_SERVER['SERVER_NAME'];

    $share_link = '';

    $share_link = '';
    if (!empty($share_url)) {
        if ($type == 'facebook') {
            $share_link = 'http://www.facebook.com/sharer.php?u=' . $share_url;
        }
        if ($type == 'linkedin') {
            $share_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url;
        }
        if ($type == 'twitter') {
            $share_link = 'https://twitter.com/intent/tweet?url=' . $share_url;
        }
    } else {
        $share_link = $link . '/' . $create_path . $type;
    }

    return $share_link;
} */




function getShareCertificateLinks($user_rowid, $docid, $level_name, $type)
{
    $certificate_query = "SELECT * FROM tbl_certificates where user_id=$user_rowid and sco_id=$docid and level_name='$level_name'";
    $certificate_query_result = mysql_db_query('l2pro_stg', $certificate_query) or die("Failed Query of" . $certificate_query);
    $certificate_query_response = mysql_fetch_assoc($certificate_query_result);
    $share_url = !empty($certificate_query_response) ? $certificate_query_response['cert_path'] : '';

    $create_path = 'webapi/certs/library/generate-and-share-certificate.php?docId=' . $docid . '&userRowId=' . $user_rowid . '&levelname=' . $level_name . '&social_share_type=';

    $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
    $link = $link . $_SERVER['SERVER_NAME'];

    $share_link = '';

    $share_link = '';
    if (!empty($share_url)) {
        if ($type == 'facebook') {
            $share_link = 'http://www.facebook.com/sharer.php?u=' . $share_url;
        }
        if ($type == 'linkedin') {
            $share_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url;
        }
        if ($type == 'twitter') {
            $share_link = 'https://twitter.com/intent/tweet?url=' . $share_url;
        }
    } else {
        $share_link = $link . '/' . $create_path . $type;
    }

    return $share_link;
}



$user_rowid  = $_REQUEST['user_rowid'];
$docid  = $_REQUEST['docid'];
$cGroup  = $_REQUEST['cGroup'];
$type  = $_REQUEST['type'];



$facebook_link = getShareCertificateLinks($user_rowid, $docid, $cGroup, 'facebook');

echo $facebook_link;

exit();
