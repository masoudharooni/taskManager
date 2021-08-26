<?php
include "bootstrap/init.php";
/**
 * ------------------------------------------UPLOAD MUZIC------------------------------------------
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadMsg = null;
    if (isset($_POST['muzicName']) and !empty($_POST['muzicName']) and is_string($_POST['muzicName']) and isset($_FILES['muzic']) and !empty($_FILES['muzic'])) {
        $resultUpload = uploadMuzic($_POST['muzicName'], $_FILES);
        $_SESSION['uploadMusic'] = "Your Music Uploaded!";
        header("location:" . siteUrl());
    } else {
        $_SESSION['uploadMusic'] = "Fill in the blanks!";
        header("location" . siteUrl());
    }
}



$musicData = getMusic() ?? null;



include 'views/tpl-music.php';
