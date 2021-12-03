<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('users',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Pengguna berhasil dihapus']);
header('location:index.php?r=users/index');
die();