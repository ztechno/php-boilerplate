<?php

$table = $_GET['table'];
$conn = conn();
$db   = new Database($conn);

$db->delete($table,[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>$table.' berhasil dihapus']);
header('location:index.php?r=crud/index&table='.$table);
die();