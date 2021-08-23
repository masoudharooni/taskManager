<?php
include "bootstrap/init.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $action = $_GET['action'];
    $params = $_POST;
    if ($action == "login") {
        $result = login($params['email'], $params['password']);
    } elseif ($action == "register") {
        $result = register($params);
        $alert = $result['alert'];
        echo "<script>alert('$alert');</script>";
    }
}

// diePage(isUnique("masoudharooni", "masoudharooni@gmail.com"));

include "views/tpl-auth.php";
