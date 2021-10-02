<?php
include 'config.php';
$mysqli = new mysqli($database_config['host'], $database_config['username'], $database_config['password'], $database_config['database']);
// $mysqli = new mysqli('db', 'root', 'test', 'detik_test');