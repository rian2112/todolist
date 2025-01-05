<?php
function editTask($id, $task_name, $task_description) {
    global $conn;
    $stmt = $conn->prepare("UPDATE todo_list SET task_name=?, task_description=? WHERE id=?");
    $stmt->bind_param("ssi", $task_name, $task_description, $id);
    $stmt->execute();
    echo "Tugas berhasil diperbarui!";
}
?>
