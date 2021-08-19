<?php
function getCurruntUserId()
{
    return 1;
}


function getFolders()
{
    global $conn;
    $currentUserId = getCurruntUserId();
    $sql = "SELECT id, user_id, name, created_at FROM folders WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $currentUserId);
    $stmt->bind_result($id, $user_id, $name, $created_at);
    $stmt->execute();
    $counter = 0;

    while ($rows = $stmt->fetch()) {
        $folderData[$counter] = ["id" => $id, "user_id" => $user_id, "name" => $name, "created_at" => $created_at];
        $counter++;
    }
    return $folderData;
}

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
