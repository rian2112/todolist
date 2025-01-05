<?php
// api.php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    
    $id = $data->id;
    $task_name = $data->task_name;
    $task_description = $data->task_description;
    
    editTask($id, $task_name, $task_description);  // Fungsi dari file PHP sebelumnya
}
?>
