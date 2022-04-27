<?php

$conn = conn();
$db   = new Database($conn);
Page::set_title('Lihat Peran');
$data = $db->single('roles',[
    'id' => $_GET['id']
]);

$routes = $db->all('role_routes',[
    'role_id' => $_GET['id']
]);

$success_msg = get_flash_msg('success');

if(request() == 'POST')
{
    $db->insert('role_routes',$_POST['routes']);

    set_flash_msg(['success'=>'Rute pada Role berhasil diupdate']);
    header('location:'.routeTo('roles/view',['id'=>$_GET['id']]));
}

return compact('data','routes','success_msg');