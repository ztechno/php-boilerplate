<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('users',[
    'id' => $_GET['id']
]);

$user_roles = get_roles($_GET['id']);
$assign_roles = "";
foreach($user_roles as $role)
    $assign_roles .= $role->role_id .",";

if($assign_roles)
    $assign_roles = rtrim($assign_roles, ", ");
else
    $assign_roles = 0;
$assign_roles = "(".$assign_roles.")";

$roles = $db->all('roles',[
    'id' => ['NOT IN',$assign_roles]
]);


$success_msg = get_flash_msg('success');

if(request() == 'POST')
{
    $db->insert('user_roles',$_POST['roles']);

    set_flash_msg(['success'=>'Role pada pengguna berhasil diupdate']);
    header('location:index.php?r=users/view&id='.$_GET['id']);
}

return compact('data','roles','user_roles','success_msg');