<?php

$appid = "9ab20f24-a14e-4c5b-a9fe-f8e26698d31f";
$tenantid = "a677e538-a995-4f46-ab69-ebe82e454fb7";
$secret = "SF68Q~W4_oVolbz0mT23DMipAQ1wg_IKNFNt6b69";

//URL to be redirected to login page
$loginURL ="https://login.microsoftonline.com/" . $tenantid . "/oauth2/v2.0/authorize";

//Request for authentication parameters
$authentication = array(
    'tenant' => $tenantid,
    'client_id' => $appid,
    'response_type' => 'code',
    'redirect_uri' => 'http://localhost/sso/request.php',
    'scope' => 'User.Read Mail.Read offline_access'
);

//Redirection to login page
header ('Location: ' . $loginURL . '?' . http_build_query ($authentication));

?>
