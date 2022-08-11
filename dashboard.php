<?php

$tokenKey = $_SESSION['token'];

//Use token to show user details via curl
function showResults($token){

    //Get user details using the token from 'request.php' via session
    $url = 'https://graph.microsoft.com/beta/me/?$select=displayName,givenName,surname,userPrincipalName,jobTitle,officeLocation,id,mail,mailNickname,';
    $headers = array("Authorization: Bearer " . $token);

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => false
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response=curl_exec($ch);

    //////////////////Print result in string//////////////////

    //Setting result as array
    $getUserArray = json_decode($response, true);

    //Getting user details from array
    $givenName = $getUserArray['givenName'];
    $surname = $getUserArray['surname'];
    $displayName = $getUserArray['displayName'];
    $userPrincipalName = $getUserArray['userPrincipalName'];
    $jobTitle = $getUserArray['jobTitle'];
    $officeLocation = $getUserArray['officeLocation'];
    $userID = $getUserArray['id'];
    $mail = $getUserArray['mail'];
    $mailNickname = $getUserArray['mailNickname'];

    //Print Result From Array
    echo strip_tags("

    <html>
        <head>
            <title>Welcome ".$displayName."</title>
        </head>
        <body>
            <center>
                <h1 class='mt-1'>
                    USER DETAILS
                </h1>
            </center>
            <h2>
                ID: ".$userID."<br>
                Given Name: ".$givenName."<br>
                Surname: ".$surname."<br>
                Display Name: ".$displayName."<br>
                User Principal Name: ".$userPrincipalName."<br>
                Mail: ".$mail."<br>
                Mail Nickname: ".$mailNickname."<br>
                Job Title: ".$jobTitle."<br>
                Office Location: ".$officeLocation."<br>             
            </h2>
            <h4>
                Token: ".$token."
            </h4>
        </body>
    </html>

    ", "<html><head><body><center><h1><h2><h4>");

    curl_close($ch);
}

if(isset($tokenKey)){
    showResults($tokenKey);
}

else{
    header("Location: index.php");
}

?>