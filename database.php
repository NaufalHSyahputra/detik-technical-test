<?php
require_once 'config.php';
$mysqli = new mysqli($database_config['hostname'], $database_config['username'], $database_config['password'], $database_config['database']);