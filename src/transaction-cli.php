#!/usr/local/bin/php
<?php
require_once 'config.php';
require_once 'transactions.class.php';

$reference_id = $argv[1] ?? null;
$status = strtolower($argv[2]) ?? null;

if (!$reference_id) { 
    print "Reference ID Required";
    die;
}
if (!$status) { 
    print "Status Required";
    die;
}
if (!in_array($status, $valid_status)) { 
    $return = ['success' => false, 'message' => 'Status Are Not Valid!'];
    print $return['message'].PHP_EOL;
    die();
}

$transaction = new Transaction();
$transaction->setReferenceId($reference_id);
$transaction->setStatus($status);
print $transaction->updateTransaction()['message']. PHP_EOL;

?>