<?php

    $page = "http://localhost:5005/logout";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $page);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $cookie = "Cookie: session = ".$_SESSION['session'];
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($cookie));
    $response = curl_exec($ch);
    //echo $response;
    $responseObj = json_decode($response);
    
    if ($responseObj->{'status'} == "ok")
        session_destroy();
        echo "<b>".$responseObj->{'msg'}."</b><br><br>";
        echo '<meta http-equiv="refresh" content="2;index.php" />';
    curl_close($ch);

?>