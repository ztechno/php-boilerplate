<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('roles',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update('roles',$_POST['roles'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Role berhasil diupdate']);
    header('location:index.php?r=roles/index');
}

return [
    'data' => $data
];