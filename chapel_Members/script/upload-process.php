<?php
    require_once '../../core/init.php';
    $user = new User();
    $fileupload = new FileUpload();
    $show = new Show();
    $error = array();
    $user_id = $user->data()->id;
    $db = Database::getInstance();

    $file = Input::get('profileFile');

    $filename = $file['name'];


    if (empty($file['name'])) {
        echo $show->showMessage('danger', 'File cant be empty!', 'warning');
        return false;
    }
    if (!$fileupload->isImage($filename)) {
        echo $show->showMessage('danger', 'File is not a valid image!', 'warning');
        return false;

    }
    if ($fileupload->fileSize($filename)) {
        echo $show->showMessage('danger', 'File size is too large!', 'warning');
        return false;
    }

    $ds = DIRECTORY_SEPARATOR;
    $temp_file = $file['tmp_name'];
    $file_path = $fileupload->moveFile($temp_file, "chapel_Members","profile", $filename)->path();
    $db_path = $file_path;

    $Update = "UPDATE members SET passport = '$db_path' WHERE id = '$user_id' ";
    if ($db->query($Update))
        echo 'success';
