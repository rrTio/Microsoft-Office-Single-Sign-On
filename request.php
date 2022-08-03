<?php

session_start();

$appid = "9ab20f24-a14e-4c5b-a9fe-f8e26698d31f";
$tenantid = "a677e538-a995-4f46-ab69-ebe82e454fb7";
$secret = "SF68Q~W4_oVolbz0mT23DMipAQ1wg_IKNFNt6b69";

//URL For token request
$tokenURL = "https://login.microsoftonline.com/" . $tenantid . "/oauth2/v2.0/token";

//Getting Code and State from URL for token request
$code = $_GET['code'];
$state = $_GET['session_state'];

//Request Token parameters
$token = array(
    'tenant' => $tenantid,
    'client_id' => $appid,
    'grant_type' => 'authorization_code',
    'scope' => 'User.Read Mail.Read offline_access',
    'code' => $code,
    'redirect_uri' => 'http://localhost/sso/request.php',
    'client_secret' => $secret
    );

//Request Token execution via cURL
$curl = curl_init($tokenURL);
curl_setopt($curl, CURLOPT_POSTFIELDS, $token);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Preparating results
$execute = curl_exec($curl);

//Setting result as array
$getArray = json_decode($execute, true);

//Getting access token from set array
$tokenKey = $getArray['access_token'];

curl_close($curl);

$_SESSION['token'] = $tokenKey;
header("Location: dashboard.php");

?>
