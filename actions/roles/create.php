<?php

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert('roles',$_POST['roles']);

    set_flash_msg(['success'=>'Role berhasil ditambahkan']);
    header('location:index.php?r=roles/index');
}