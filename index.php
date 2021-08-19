<?php
include "bootstrap/init.php";

/**
 * delete folder
 */
if (isset($_GET['folder_delete_id']) and !empty(is_numeric($_GET['folder_delete_id']))) {
    deleteFolder($_GET['folder_delete_id']);
}

/**add a new folder */
if (isset($_POST['newFolder']) and !empty(is_string($_POST['newFolder']))) {
    addFolder($_POST['newFolder']);
}

$folders = getFolders();
include "views/tpl-index.php";
