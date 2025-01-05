<?php
function addTask($task_name, $task_description) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO todo_list (task_name, task_description) VALUES (?, ?)");
    $stmt->bind_param("ss", $task_name, $task_description);
    $stmt->execute();
    echo "Tugas berhasil ditambahkan!";
}
?>
