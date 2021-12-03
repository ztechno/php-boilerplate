<?php

$conn = conn();
$db   = new Database($conn);

$route = $db->single('user_roles',[
    'id' => $_GET['id']
]);

$db->delete('user_roles',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Role pada pengguna berhasil dihapus']);
header('location:index.php?r=users/view&id='.$route->user_id);
die();