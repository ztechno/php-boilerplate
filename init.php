<?php

// all config files
$files = [
    'app'
];

foreach($files as $file)
{
    if(!file_exists('config/'.$file.'.php'))
    {
        copy('config/'.$file.'.example','config/'.$file.'.php');
    }
}

echo "Init Config File Success\n";
echo "Please config the following file in config folder (".(implode('.php, ',$files)).")\n";
