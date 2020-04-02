<?php
$ds = DIRECTORY_SEPARATOR;  // Store directory separator (DIRECTORY_SEPARATOR) to a simple variable. This is just a personal preference as we hate to type long variable name.
$storeFolder = 'uploads';   // Declare a variable for destination folder.
if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          // If file is sent to the page, store the file object to a temporary variable.
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  // Create the absolute path of the destination folder.
    // Adding timestamp with image's name so that files with same name can be uploaded easily.
    $date = new DateTime();
    $newFileName = $date->getTimestamp().$_FILES['file']['name'];
    $targetFile =  $targetPath.$newFileName;  // Create the absolute path of the uploaded file destination.

    $ext = pathinfo($targetFile, PATHINFO_EXTENSION);

	if ($ext=="jpg" OR $ext=="jpeg" OR $ext=="gif" OR $ext=="png") {
	    // your code here like...
	    move_uploaded_file($tempFile,$targetFile); // Move uploaded file to destination.

	    //echo "Upload successful";
	echo $newFileName;
	}else{
	    // your invalid code here like...
	    echo "Invalid image format. Only upload JPG or JPEG or GIF or PNG";
	}

    
    
}
?>