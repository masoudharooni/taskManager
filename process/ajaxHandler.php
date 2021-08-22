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
