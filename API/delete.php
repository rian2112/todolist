<?php
// api.php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));
    
    $id = $data->id;
    
    deleteTask($id);  // Fungsi dari file PHP sebelumnya
}
?>
