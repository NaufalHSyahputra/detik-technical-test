<?php
// error_reporting(0);
header("Content-Type: application/json; charset=UTF-8");
require_once 'config.php';
require_once 'transactions.class.php';

$reference_id = $_GET['reference_id'];
$merchant_id = $_GET['merchant_id'];

if (!$reference_id || $reference_id === '') { 
    $return = ['success' => false, 'message' => 'Reference ID Required!'];
    echo json_encode($return);
    die();
}
if (!$merchant_id || $merchant_id === '') { 
    $return = ['success' => false, 'message' => 'Merchant Id Required!'];
    echo json_encode($return);
    die();
}

$transaction = new Transaction();
$transaction->setReferenceId($reference_id);
$transaction->setMerchantId($merchant_id);
echo json_encode($transaction->getTransaction());