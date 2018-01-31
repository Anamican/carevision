<?php

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if($data['result']['action'] == 'caretaker'){
    
    $dataArray['To'] = "+61422989574";
    $dataArray['From'] = "+12024172482";
    $dataArray['Body'] = "Your caree is in emergency";    

    $url = "https://api.twilio.com/2010-04-01/Accounts/ACf0a2d1ba27045e2118eacf9c811ff003/Messages.json";
    $response = callPost($url, $dataArray);   

    echo file_get_contents("response.json");
    
}else{
    echo file_get_contents("error.json");
}


function callPost($url, $data){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    // in real life you should use something like:
    // curl_setopt($ch, CURLOPT_POSTFIELDS, 
    //          http_build_query(array('postvar1' => 'value1')));

    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "ACf0a2d1ba27045e2118eacf9c811ff003:6d5f19ba4783b05666118ba8eaac1506");        

    $response = curl_exec ($ch);

    curl_close ($ch);
    return $response;
}   
