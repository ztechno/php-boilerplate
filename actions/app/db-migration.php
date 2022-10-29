<?php

$parent_path = '../';
if (in_array(php_sapi_name(),["cli","cgi-fcgi"])) {
    $parent_path = '';
}

$conn  = conn();
$db    = new Database($conn);

$files = preg_grep('~^migration-.*\.sql$~', scandir($parent_path . "migrations"));


if(!empty($files))
{
    $all_migrations = $db->all('migrations',[
        'filename' => ['in','("'.implode('","',$files).'")']
    ]);

    $all_migrations = array_map(function($migration){
        return $migration->filename;
    }, $all_migrations);

    foreach($files as $file)
    {
        if(in_array($file, $all_migrations)) continue;

        $myfile = fopen($parent_path . "migrations/".$file, "r") or die("Unable to open file!");
        $query  = fread($myfile,filesize($parent_path . "migrations/".$file));
        fclose($myfile);
        
        $db->query = $query;
        $db->exec('multi_query');

        $db->insert('migrations',[
            'filename' => $file
        ]);
    }

    echo "Migration Success";
    die();
}
