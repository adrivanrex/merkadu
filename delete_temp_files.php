<?php
$ds = DIRECTORY_SEPARATOR;  // Store directory separator (DIRECTORY_SEPARATOR) to a simple variable. This is just a personal preference as we hate to type long variable name.
$storeFolder = 'uploads'; 

$fileList = $_POST['fileList'];
$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;


if(isset($fileList)){
    unlink($targetPath.$fileList);
}

?>
