<?php
// error_reporting(0);
header("Content-Type: application/json; charset=UTF-8");
require_once 'config.php';
require_once 'transactions.class.php';
$data = null;
if ($_SERVER['HTTP_CONTENT_TYPE'] == "application/json" || $_SERVER['CONTENT_TYPE'] == "application/json") { 
    $data = json_decode(file_get_contents('php://input'), true);
} else { 
    $data = $_POST;
}

$invoice_id = $data['invoice_id'];
$item_name = $data['item_name'];
$amount = $data['amount'];
$payment_type = $data['payment_type'];
$customer_name = $data['customer_name'];
$merchant_id = $data['merchant_id'];

if (!$invoice_id || $invoice_id === '') { 
    $return = ['success' => false, 'message' => 'Invoice ID Required!'];
    echo json_encode($return);
    die();
}
if (!$item_name || $item_name === '') { 
    $return = ['success' => false, 'message' => 'Item Name Required!'];
    echo json_encode($return);
    die();
}
if (!$amount || $amount === '') { 
    $return = ['success' => false, 'message' => 'Amount Required!'];
    echo json_encode($return);
    die();
}
if (!$payment_type || $payment_type === '') { 
    $return = ['success' => false, 'message' => 'Payment Type Required!'];
    echo json_encode($return);
    die();
}
if (!in_array($payment_type, $valid_payment_type)) { 
    $return = ['success' => false, 'message' => 'Payment Type Are Not Valid!'];
    echo json_encode($return);
    die();
}
if (!$customer_name || $customer_name === '') { 
    $return = ['success' => false, 'message' => 'Customer Name Required!'];
    echo json_encode($return);
    die();
}
if (!$merchant_id || $merchant_id === '') { 
    $return = ['success' => false, 'message' => 'Merchant Id Required!'];
    echo json_encode($return);
    die();
}

$transaction = new Transaction();
$transaction->setInvoiceId($invoice_id);
$transaction->setItemName($item_name);
$transaction->setAmount($amount);
$transaction->setPaymentType($payment_type);
if ($payment_type === 'virtual_account') { 
    $transaction->setNomorVA();
}
$transaction->setCustomerName($customer_name);
$transaction->setMerchantId($merchant_id);
$transaction->setStatus($valid_status[0]);
$result = $transaction->createTransaction();
echo json_encode($result);
die;
