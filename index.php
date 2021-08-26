<?php
include "bootstrap/init.php";

if (isset($_GET['logout'])) {
    logout();
}

if (!isLoggedIn()) {
    // redirect to auth page
    header("location:" . siteUrl("auth.php"));
}

/**
 * ------------------------------------------delete folder------------------------------------------
 */
if (isset($_GET['folder_delete_id']) and !empty(is_numeric($_GET['folder_delete_id']))) {
    deleteFolder($_GET['folder_delete_id']);
}
/**
 * ------------------------------------------delete Task------------------------------------------
 */
if (isset($_GET['task_delete_id']) && !empty(is_numeric($_GET['task_delete_id']))) {
    deleteTask($_GET['task_delete_id']);
}

/**
 * ------------------------------------------Get folders------------------------------------------
 */
$folders = getFolders();
$foldersCount = sizeof($folders);



/**
 * ------------------------------------------Get task------------------------------------------
 */
$tasks = getTasks();

include ROOT_PATH . "views/tpl-index.php";
