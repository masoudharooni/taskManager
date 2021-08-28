<?php
include "bootstrap/init.php";
/**
 * ------------------------------------------UPLOAD MUSIC------------------------------------------
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadMsg = null;
    if (isset($_POST['musicName']) and !empty($_POST['musicName']) and is_string($_POST['musicName']) and isset($_FILES['music']) and !empty($_FILES['music'])) {
        $resultUpload = uploadMusic($_POST['musicName'], $_FILES);
        $_SESSION['uploadMusic'] = "Your Music Uploaded!";
        header("location:" . siteUrl());
    } else {
        $_SESSION['uploadMusic'] = "Fill in the blanks!";
        header("location" . siteUrl());
    }
}



$musicData = getMusic() ?? null;



include 'views/tpl-music.php';
