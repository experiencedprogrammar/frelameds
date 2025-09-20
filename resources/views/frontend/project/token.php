<?php
//YOU MPESA API KEYS
$consumerKey = "1o0iAQPfsvil8JmvGXMvVXN6rKaK6JbdVxf1HvA11ucfeLYH"; //Fill with your app Consumer Key
$consumerSecret = "A0kDmidCeUIGsn9WDCxkHVh2SquLL6D1jQRPDWHGVZKAe2Fag1IO8GmhuPTEqLgP"; //Fill with your app Consumer Secret
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$headers = ['Content-Type:application/json; charset=utf8'];
$curl = curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
echo $access_token = $result->access_token;
curl_close($curl);


