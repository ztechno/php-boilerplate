<?php

$table = $_GET['table'];
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
$fields = config('fields')[$table];

if(file_exists('../actions/'.$table.'/override-index-fields.php'))
    $fields = require '../actions/'.$table.'/override-index-fields.php';

$data = $db->all($table);
if(file_exists('../actions/'.$table.'/override-index.php'))
    $data = require '../actions/'.$table.'/override-index.php';

return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg,
    'fields' => $fields
];