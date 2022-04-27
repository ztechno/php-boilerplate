<?php
Page::set_title('Tambah Pengguna');
if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $_POST['users']['password'] = md5($_POST['users']['password']);

    $db->insert('users',$_POST['users']);

    set_flash_msg(['success'=>'Pengguna berhasil ditambahkan']);
    header('location:'.routeTo('users/index'));
}