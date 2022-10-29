<?php

$conn = conn();
$db   = new Database($conn);

$route = $db->single('role_routes',[
    'id' => $_GET['id']
]);

$db->delete('role_routes',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Rute pada Role berhasil dihapus']);
header('location:'.routeTo('roles/view',['id'=>$route->role_id]));
die();