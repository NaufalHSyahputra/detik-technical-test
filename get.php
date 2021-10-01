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

$reference_id = $data['reference_id'];
$merchant_id = $data['merchant_id'];

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

//WIP
