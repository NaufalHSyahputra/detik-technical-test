<?php
error_reporting(0);
header("Content-Type: application/json; charset=UTF-8");
require_once 'config.php';
require_once 'database.php';

$data = null;
if ($_SERVER['HTTP_CONTENT_TYPE'] == "application/json") { 
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
$nomor_va = "";
if ($payment_type === $valid_payment_type[0]) { 
    $nomor_va = random_int(1000000000, 2147483640);
}

try {
    $stmt = $mysqli->prepare("INSERT INTO transactions (invoice_id, item_name, amount, payment_type, customer_name, merchant_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "isissi",
        $invoice_id,
        $item_name,
        $amount,
        $payment_type,
        $customer_name,
        $merchant_id
    );
    $stmt->execute();
    $reference_id = $stmt->insert_id;
    $return = ['reference_id' => $reference_id, 'number_va' => $nomor_va, 'status' => ucfirst($valid_status[0])];
    echo json_encode($return);
} catch (Exception $e) {
    $return = ['success' => false, 'message' => $e->getMessage()];
    echo json_encode($return);
}
