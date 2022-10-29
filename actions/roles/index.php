<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
Page::set_title('Peran');
$data = $db->all('roles');

return [
    'datas' => $data,
    'success_msg' => $success_msg
];