<?php
session_start();
include "constants.php";

// include ROOT_PATH . "vendor/phpmailer/phpmailer/src/PHPMailer.php";
// include ROOT_PATH . "vendor/phpmailer/phpmailer/src/SMTP.php";

include ROOT_PATH . "vendor/autoload.php";
include ROOT_PATH . "bootstrap/config.php";
include ROOT_PATH . "libs/helper.php";
/** 
 * Connection to database with mysqli by $conn variable
 */
$conn = new mysqli($database_config->host, $database_config->user, $database_config->pass, $database_config->db);
if ($conn->connect_errno) {
    diePage("Connection is not true , ERROR is : " . $conn->connect_error);
}

include ROOT_PATH . "libs/lib-auth.php";

include ROOT_PATH . "libs/functionsTask.php";
