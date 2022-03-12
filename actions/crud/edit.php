<?php

$table = $_GET['table'];
$conn = conn();
$db   = new Database($conn);

$data = $db->single($table,[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:index.php?r=crud/index&table='.$table);
}

return [
    'data' => $data,
    'table' => $table
];