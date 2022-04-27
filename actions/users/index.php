<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
Page::set_title('Data Pengguna');

$datas = $db->all('users');

return compact('datas','success_msg');