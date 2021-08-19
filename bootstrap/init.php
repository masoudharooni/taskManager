<?php
include "vendor/autoload.php";
include "config.php";
include "libs/helper.php";
/** 
 * Connection to database with mysqli by $conn variable
 */
$conn = new mysqli($database_config->host, $database_config->user, $database_config->pass, $database_config->db);
if ($conn->connect_errno) {
    diePage("Connection is not true , ERROR is : " . $conn->connect_error);
}

include "libs/functionsTask.php";
include "constants.php";
