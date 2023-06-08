<?php

$webhookurl = "Discord_Webhook_Url";
$timestamp = date("c", strtotime("now"));
$ip = (isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR']);

if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    // $ip is an IPv4 address
    echo $ip;
} else {
    // $ip is not a valid IPv4 address
    echo "Unable to retrieve valid IPv4 address";
}


$json_data = json_encode([    
    "username" => "Zeus IP",


    "embeds" => [
        [
            "title" => "IP Logged",

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "IP Logged: **$ip**",


            "timestamp" => $timestamp,

            "color" => hexdec( "3366ff" ),


        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );
