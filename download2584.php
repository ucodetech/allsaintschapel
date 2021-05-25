<?php
	require_once 'core/init.php';
    $download = new Download();
 
 if (isset($_GET['dr'])) {
    $downid = (int)$_GET['dr'];
    // fetch file to download from database
    $tot = $download->totDownloads('sermonAudioFormat', $downid);
    $file = $tot->audio;
    $filepath = 'uploads/sermon/'.$file;

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='. basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' .filesize('uploads/sermon/'.$file));
        readfile('uploads/sermon/'.$file);
       
        exit;
    }

}
		
		
  ?>