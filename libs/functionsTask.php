<?php

/**----------------------------------------------------------------------------Folders Function---------------------------------------------------------------------------- */

/**----------------------------------------------------------------------------Get Folders Function---------------------------------------------------------------------------- */

function getFolders()
{
    global $conn;
    $currentUserId = getCurruntUserId();
    $sql = "SELECT id, user_id, name, created_at  FROM folders WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $currentUserId);
    $stmt->bind_result($id, $user_id, $name, $created_at);
    $stmt->execute();
    $counter = 0;

    while ($stmt->fetch()) {
        $folderData[$counter] = ["id" => $id, "user_id" => $user_id, "name" => $name, "created_at" => $created_at];
        $counter++;
    }
    return $folderData ?? $replace = [null];
}

/**----------------------------------------------------------------------------Add Folder Function---------------------------------------------------------------------------- */

function addFolder(string $folderName): bool
{
    global $conn;
    $currentUserId = getCurruntUserId();
    $sql = "INSERT INTO folders (user_id, name) VALUES (? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $currentUserId, $folderName);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

/**----------------------------------------------------------------------------Delete Folder Function---------------------------------------------------------------------------- */

function deleteFolder(int $folderId): bool
{
    global $conn;
    $sql = "DELETE FROM folders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $folderId);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

/**----------------------------------------------------------------------------Update Folder Function---------------------------------------------------------------------------- */

function updateFolder(string $folderName, int $folderId): bool
{
    global $conn;
    $sql = "UPDATE folders SET name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $folderName, $folderId);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

/**----------------------------------------------------------------------------Task Function---------------------------------------------------------------------------- */


/**----------------------------------------------------------------------------Get Task Function----------------------------------------------------------------------------*/

function getTasks($taskId = null)
{
    global $conn;
    $currentUserId = getCurruntUserId();

    $folder = $_GET['folder_id'] ?? null;
    $folderCondition = null;
    if (isset($folder) and is_numeric($folder)) {
        $folderCondition = " AND folder_id = ?";
    }

    $sortBy = $_GET['sortBy'] ?? null;
    $ascOrDesc = "DESC";
    $sort = "ORDER BY created_at {$ascOrDesc}";
    if (isset($sortBy) and is_string($sortBy) and !is_null($sortBy)) {
        $sort = "ORDER BY created_at {$sortBy}";
    }

    $pagination = $_GET['page'] ?? 1;
    if (isset($pagination) and is_numeric($pagination) and !is_null($pagination)) {
        $page = ($pagination - 1) * 7;
        $limit = "LIMIT {$page},7";
    }

    $taskCondition = null;
    if (isset($taskId) and !is_null($taskId)) {
        $taskCondition = "AND id = ?";
    }


    $sql = "SELECT id, user_id,folder_id, title , status, created_at FROM tasks WHERE user_id = ?$folderCondition $taskCondition $sort $limit";
    $stmt = $conn->prepare($sql);


    if (!is_null($taskCondition) and !is_null($folderCondition)) {
        $stmt->bind_param("iii", $currentUserId, $folder, $taskId);
    } elseif (!is_null($taskCondition) and is_null($folderCondition)) {
        $stmt->bind_param("ii", $currentUserId, $taskId);
    } elseif (is_null($taskCondition) and !is_null($folderCondition)) {
        $stmt->bind_param("ii", $currentUserId, $folder);
    } elseif (is_null($taskCondition) and is_null($folderCondition)) {
        $stmt->bind_param("i", $currentUserId);
    }

    $stmt->bind_result($id, $user_id, $folderId, $title, $status, $created_at);
    $stmt->execute();
    $counter = 0;
    $taskData = null;
    while ($stmt->fetch()) {
        $taskData[$counter] = ["id" => $id, "user_id" => $user_id, "title" => $title, "status" => $status, "created_at" => $created_at];
        $counter++;
    }
    return $taskData;
}

/**----------------------------------------------------------------------------Delete Task Function----------------------------------------------------------------------------*/

function deleteTask(int $taskId): bool
{
    global $conn;
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

/**----------------------------------------------------------------------------Add Task Function----------------------------------------------------------------------------*/

function addTask(string $taskName, int $folderId): bool
{
    global $conn;
    $currentUserId = getCurruntUserId();
    $status = 0;
    $sql = "INSERT INTO tasks (user_id, folder_id , title , status) VALUES (? , ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $currentUserId, $folderId, $taskName, $status);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}


/**----------------------------------------------------------------------------Done and UnDone Task Function----------------------------------------------------------------------------*/

function statusTask($taskId): bool
{

    $currentUserId = getCurruntUserId();

    $statusTask = getTasks($taskId)[0]['status'];

    $statusTaskUpdade = 1 - $statusTask;

    global $conn;
    $sql = "UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?";

    /**
     * another way For Toggle Between Done and UnDone Task <--> $sql = "UPDATE tasks SET status = 1 - status WHERE id = ?"; 
     */

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $statusTaskUpdade, $taskId, $currentUserId);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}



/**----------------------------------------------------------------------------Done and UnDone Task Function----------------------------------------------------------------------------*/

function updateTask(string $taskName, int $taskId): bool
{
    global $conn;
    $currentUserId = getCurruntUserId();
    $sql = "UPDATE tasks SET title = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $taskName, $taskId, $currentUserId);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

/**----------------------------------------------------------------------------Done and UnDone Task Function----------------------------------------------------------------------------*/

function searchTask(string $char)
{
    global $conn;
    $currentUserId = getCurruntUserId();
    $replace = "%{$char}%";
    $sql = "SELECT title , folder_id FROM tasks WHERE title LIKE ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $replace, $currentUserId);
    $stmt->bind_result($title, $folder_id);
    $stmt->execute();
    $counter = 0;
    while ($stmt->fetch()) {
        $listOfName[$counter] = [
            'taskName' => $title,
            'folderId' => $folder_id
        ];
        $counter++;
    }
    return $listOfName ?? null;
}
