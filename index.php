<?php
include "bootstrap/init.php";
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
// dump($tasks);
// if (!is_null(sizeof($tasks))) {
//     $tasksCount = sizeof($tasks);
// } else {
//     $tasksCount = null;
// }


include ROOT_PATH . "views/tpl-index.php";
