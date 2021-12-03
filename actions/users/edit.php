<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('users',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    if(empty($_POST['users']['password']))
        $_POST['users']['password'] = $data->password;
    else
        $_POST['users']['password'] = md5($_POST['users']['password']);
    $db->update('users',$_POST['users'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Pengguna berhasil diupdate']);
    header('location:index.php?r=users/index');
}

return [
    'data' => $data
];