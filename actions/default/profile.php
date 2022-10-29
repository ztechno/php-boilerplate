<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('users',[
    'id' => auth()->user->id
]);

$success_msg = get_flash_msg('success');

if(request() == 'POST')
{
    if(empty($_POST['users']['password']))
        $_POST['users']['password'] = $data->password;
    else
        $_POST['users']['password'] = md5($_POST['users']['password']);
    $db->update('users',$_POST['users'],[
        'id' => auth()->user->id
    ]);

    set_flash_msg(['success'=>'Profil berhasil diupdate']);
    header('location:index.php?r=default/profile');
}

return compact('data','success_msg');