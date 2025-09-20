<?php
require_once __DIR__ . '/../token.php';
$ReversalsUrl = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
$request_data = array(
    'Initiator' => 'testapi',
    'SecurityCredential' => 'FHLQkoufDpdLh7ujNxU6u9SdEcjBc74uoVz1VUOf2V5mFeQ7SidCT7e+iq31wqgND43uF6ymDXYd/8R8JQ12b6cMmWO8/B6gMGjn7G5xO+4amBLU+NnJJU+hXBqerkRxoW2bND++ZzcvaG79zqwu+v192TKFBgeJHUvqYsfrGAz79UrEsM7dGsD7PcUIvzPJJTXU8G53OQGMZuI2NdElpeOyHua5Khky8Prtjywno3K5xgur8TdBVa7XM6WrvEA+RP702HNvda07M3a4pn1o/SJdNfKMAPXJWQQqEfHk4EMpBZVtEfrC541yVJO08KcCn9KMeSYY+B0M05nbKV6ngA==',
    'CommandID' => 'TransactionReversal',
    'TransactionID' => 'TD63NNDYPF',
    'Amount' => '1',
    'ReceiverParty' => '174379',
    'RecieverIdentifierType' => '11',
    'QueueTimeOutURL' => 'https://5542-41-90-231-187.ngrok-free.app/project/admin/QueueTimeOutURL.php',
    'ResultURL' => 'https://5542-41-90-231-187.ngrok-free.app/project/admin/ResultURL.php',
    'Remarks' => 'Test',
    'Occasion' => 'work',
);
$data_string = json_encode($request_data);
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $ReversalsUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
echo $response;
?>
