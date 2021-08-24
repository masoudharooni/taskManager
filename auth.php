<?php
include "bootstrap/init.php";


// echo "<pre>";
// var_dump(getUserByEmail("masoudhasasdfasdfrooni50@gmail.com"));
// echo "</pre>";
// die();

$homeUrl = siteUrl();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $action = $_GET['action'];
    $params = $_POST;

    if ($action == "login") {
        $result = login($params['email'], $params['password']);
        if (!$result) {
            echo "<script>alert('email or password not true');</script>";
        } else {
            header("location: " . siteUrl());
            die();
        }
    } #


    elseif ($action == "register") {
        $result = register($params);
        if (!$result['bool']) {
            $alert = $result['alert'];
            echo "<script>alert('$alert');</script>";
        } else {
            massage("Register Successful! , Please Login <i style='font-size: 45px; vertical-align: -5px; margin: 0 15px; color: #bfffc4;' class='fas fa-hand-point-right'></i> <a href='$homeUrl'/auth.php>Login!</a>");
        }
    }
}





// diePage(isUnique("masoudharooni", "masoudharooni@gmail.com"));

include "views/tpl-auth.php";
