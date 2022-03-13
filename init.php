<?php

// all config files
$files = [
    'icon_menu',
    'main',
    'menu',
    'tablefields'
];

foreach($files as $file)
{
    $content = file_get_contents('config/'.$file.'.example');
    file_put_contents('config/'.$file.'.php', $content);
}

echo "Init Config File Success\n";
echo "Please config the following file in config folder (".(implode('.php, ',$files)).")\n";