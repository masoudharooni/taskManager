<?php
include "bootstrap/init.php";


// echo "<pre>";
// var_dump(getUserByEmail("masoudhasasdfasdfrooni50@gmail.com"));
// echo "</pre>";
// die();

$homeUrl = siteUrl();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['authBtn'])) {
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
        } elseif ($action == "register") {
            $result = register($params);
            if (!$result['bool']) {
                $alert = $result['alert'];
                echo "<script>alert('$alert');</script>";
            } else {
                massage("Register Successful! , Please Login | <a href='$homeUrl'/auth.php>Login!</a>");
            }
        }
    }
}

$alertMsg = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['recoveryBtn']) and $_POST['recoveryBtn'] == 'Send Email') {
        if (isThereEmail($_POST['email'])) {
            if (allowPass($_POST['pass'])) {
                $emailResult = sendEmail($_POST['email']);
                if (is_numeric($emailResult['code'])) {
                    $code = $emailResult['code'];
                    $alertMsg = "<p class='recoveryPass'>a code send to your email , please click on 'forgot password' button , and enter the code.</p>";
                    echo (!is_null($alertMsg)) ? $alertMsg : null;
                    unset($alertMsg);
                    $_SESSION['codeEmail'] = $code;
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['pass'] = $_POST['pass'];
                } else {
                    $alertMsg = "<p class='recoveryPass'>Error!</p>";
                    echo (!is_null($alertMsg)) ? $alertMsg : null;
                    unset($alertMsg);
                }
            } else {
                $alertMsg = "<p class='recoveryPass'>Your Password not Safe!</p>";
                echo (!is_null($alertMsg)) ? $alertMsg : null;
                unset($alertMsg);
            }
        } else {
            $alertMsg = "<p class='recoveryPass'>This Email Not Exist!</p>";
            echo (!is_null($alertMsg)) ? $alertMsg : null;
            unset($alertMsg);
        }
    }
}

// echo sendEmail("masoudharooni50@gmail.com");
// die();

// diePage(isUnique("masoudharooni", "masoudharooni@gmail.com"));

// echo allowPass("mmMasoud1234");die;

include "views/tpl-auth.php";
