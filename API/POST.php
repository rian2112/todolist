<?php
// api.php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    $task_name = $data->task_name;
    $task_description = $data->task_description;
    
    addTask($task_name, $task_description);  // Fungsi dari file PHP sebelumnya
}
?>
