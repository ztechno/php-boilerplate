<?php

$conn  = conn();
$db    = new Database($conn);

$files = preg_grep('~^migration-.*\.sql$~', scandir("../migrations"));


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

        $myfile = fopen("../migrations/".$file, "r") or die("Unable to open file!");
        $query  = fread($myfile,filesize("../migrations/".$file));
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
