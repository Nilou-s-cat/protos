<?php


$namespace = "TeyvatPS\\network\\protocol\\genshin";

$schemas = __DIR__ . "/schemas";
$output = __DIR__ . "/protos";

foreach (glob($schemas . "/*.proto") as $proto){
    exec("protoc --proto_path={$schemas} --php_out={$output} $proto");
    echo "Compiled proto: $proto\n";
}

function deleteCmdId($file){
    $name = basename($file);
    if (count(explode('CmdId', $name)) > 1){
        unlink($file);
    }
}

echo "Cleaning up...\n";
foreach (glob($output . "/*.php") as $file){
    deleteCmdId($file);
}
foreach (glob($output . "/*", GLOB_ONLYDIR) as $dir) {
    foreach (glob($dir . "/*") as $file){
        deleteCmdId($file);
    }
    $files = glob($dir . "/*");
    if (count($files) === 0){
        rmdir($dir);
    }
}
echo "Done\n";

