<?php
ini_set("phar.readonly", 0);

$srcRoot = __DIR__."/../src/";
$buildRoot = __DIR__."/../build/";
 
$pharFile = $buildRoot.'astatic.phar';
// clean up
if (file_exists($pharFile)) {
    unlink($pharFile);
}
if (file_exists($pharFile . '.gz')) {
    unlink($pharFile . '.gz');
}
// create phar
$p = new Phar(
    $pharFile,
    FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME,
    "astatic.phar"
);
// creating our library using whole directory  
$p->buildFromDirectory($srcRoot);
// pointing main file which requires all classes  
$p->setDefaultStub($srcRoot.'astatic', '/index.php');
// plus - compressing it into gzip  
$p->compress(Phar::GZ);
   
echo "$pharFile successfully created";
