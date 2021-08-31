<?php
include "bootstrap/init.php";
/**
 * ------------------------------------------UPLOAD MUSIC------------------------------------------
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['uploadImageBtn']) and $_POST['uploadImageBtn'] == 'Upload Image') :
        if (isset($_POST['imageName']) and !empty($_POST['imageName']) and is_string($_POST['imageName']) and isset($_FILES['image']) and !empty($_FILES['image'])) {
            $resultUpload = uploadImage($_FILES);
            // var_dump($resultUpload);
            // die;
            if (!is_null($resultUpload) and is_array($resultUpload)) {
                if (imageToDb($_POST['imageName'], $resultUpload)) {
                    $_SESSION['uploadImage'] = "Your Image Uploaded, Go To Gallery!";
                }
            } else {
                $_SESSION['uploadImage'] = "Your Image Not Uploaded!";
            }
            header("location:" . siteUrl());
        } else {
            $_SESSION['uploadImage'] = "Fill in the blanks!";
            header("location" . siteUrl());
        }
    // var_dump($_POST);
    // die;
    endif;
}

// get image
$images = getImage();

include "views/tpl-gallery.php";
