<?php
session_start();

if (isset($_POST['submit'])) {
    include 'token.php';
    date_default_timezone_set('Africa/Nairobi');
    $processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $callbackurl = 'https://ae89-105-160-99-162.ngrok-free.app/project/callback.php';
    $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
    $BusinessShortCode = '174379';
    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
    $PartyA = $_POST['phone'];
    $Amount = $_POST['amount'];

    try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json', 
            'Authorization:Bearer ' . $access_token
        ]);

        $curl_post_data = [
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $callbackurl,
            'AccountReference' => 'JERINS SOFTWARES',
            'TransactionDesc' => 'stkpush test'
        ];

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($curl_post_data)
        ]);

        $curl_response = curl_exec($curl);
        $error = curl_error($curl);
        
        if ($error) {
            throw new Exception("CURL Error: " . $error);
        }

        $data = json_decode($curl_response);
        
        if (isset($data->ResponseCode) && $data->ResponseCode == "0") {
            $_SESSION['message'] = "Payment initiated! Check your phone to complete transaction";
            $_SESSION['message_type'] = 'success';
        } else {
            $errorMessage = $data->errorMessage ?? 'Unknown error occurred.Check connection and retry';
            $_SESSION['message'] = "Payment failed: " . $errorMessage;
            $_SESSION['message_type'] = 'danger';
        }

    } catch (Exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    } finally {
        curl_close($curl);
        header('Location: checkout.blade.php');
        exit();
    }
}