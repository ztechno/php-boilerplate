<?php

$table = $_GET['table'];
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

if(file_exists('../actions/'.$table.'/override-index.php'))
    $data = require '../actions/'.$table.'/override-index.php';
else
    $data = $db->all($table);

return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg
];