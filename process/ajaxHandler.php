<?php
include_once "../bootstrap/init.php";

if (!isRequestAjax()) {
    diePage("This isn't an ajax request<br>");
}

if (!isset($_POST['action']) or empty($_POST['action'])) {
    diePage("Action isn't valid ! ! !<br>");
}

/**----------------------------------add a new folder with ajax----------------------------------*/

if (isset($_POST['nameFolder']) and $_POST['action'] == "addFolder" and !empty($_POST['nameFolder'])) {
    if (addFolder($_POST['nameFolder'])) {
        echo "$_POST[nameFolder] Folder Created :)";
    }
}

/**----------------------------------Update a Folder----------------------------------*/

if (isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'updateFolder') {
    if (updateFolder($_POST['newFolderName'], $_POST['folderId'])) {
        echo "$_POST[newFolderName] Folder Updated !";
    } else {
        echo "$_POST[newFolderName] Folder Not Updated !";
    }
}

/**----------------------------------Add A New Task----------------------------------*/

if (isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'addTask' and isset($_POST['folderId']) and !empty(is_numeric($_POST['folderId'])) and $_POST['folderId'] > 0) {
    if (addTask($_POST['taskName'], $_POST['folderId'])) {
        echo "$_POST[taskName] Task Added!";
    } else {
        echo "$_POST[taskName] Task Not Added!";
    }
}

/**----------------------------------Done and OnDone Tasks----------------------------------*/

if (isset($_POST['action']) and !empty($_POST['action']) and $_POST['action'] == "doneTask" and isset($_POST['taskId']) and !empty(is_numeric($_POST['taskId']))) {
    echo statusTask($_POST['taskId']);
}

/**----------------------------------Update Tasks Name----------------------------------*/
if (isset($_POST['action']) and !empty($_POST['action']) and $_POST['action'] == "updateTask" and isset($_POST['taskId']) and !empty(is_numeric($_POST['taskId'])) and isset($_POST['newTaskName'])) {
    echo updateTask($_POST['newTaskName'], $_POST['taskId']);
}

/**----------------------------------Search Tasks Name----------------------------------*/

if (isset($_POST['action']) and !empty($_POST['action']) and $_POST['action'] == "searchTask" and !empty($_POST['taskName'])) {
    $listOfName = searchTask($_POST['taskName']);
    if (!is_null($listOfName)) {
        foreach ($listOfName as $value) {
            echo "<a href='?folder_id={$value['folderId']}'>{$value['taskName']}</a>";
        }
    } else {
        echo "<a href='' class='notExistTask'>Not Exist!</a>";
    }
}

/**----------------------------------Number of un done Tasks----------------------------------*/

if (isset($_POST['action']) and !is_null($_POST['action']) and $_POST['action'] == "NoberOfUnDoneTasks") {
    echo countUnDoneTask();
}

/**----------------------------------AJAX FOR DELETE A MUSIC----------------------------------*/

if (isset($_POST['action']) and !is_null($_POST['action']) and $_POST['action'] == "deleteMusic" and is_numeric($_POST['musicId'])) {
    echo deleteMusic($_POST['musicId'], $_POST['musicPath']);
}

/**----------------------------------Check an Email For Pass Recovery----------------------------------*/

if (isset($_POST['action']) and !is_null($_POST['action']) and $_POST['action'] == "codeRev" and is_numeric($_POST['code'])) {
    if (isset($_SESSION['email']) and isset($_SESSION['codeEmail']) and isset($_SESSION['pass']) and !empty($_SESSION['pass']) and !empty($_SESSION['email']) and !empty($_SESSION['codeEmail'])) {
        if ($_POST['code'] == $_SESSION['codeEmail']) {
            if (updatePass($_SESSION['email'], $_SESSION['pass'])) {
                echo "Your Password Updated , Please Login.";
            } else {
                echo "Your Password Not Updated , Please Try Again.";
            }
        } else {
            echo "This Code Not True!";
        }
        unset($_SESSION['eamil']);
        unset($_SESSION['codeEamil']);
        unset($_SESSION['pass']);
    }
}


/**----------------------------------AJAX FOR DELETE AN IMAGE----------------------------------*/

if (isset($_POST['action']) and !is_null($_POST['action']) and $_POST['action'] == "deleteImage" and is_numeric($_POST['imageId'])) {
    echo deleteImage($_POST['imageId']);
}
