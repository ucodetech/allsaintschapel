<?php
require_once '../../core/init.php';

$fileupload = new FileUpload();
$admin = new Admin();
$sermon = new Sermon();
$validate = new Validate();
$show = new Show();
$db = Database::getInstance();
  $db_path = '';

$detail_id= Input::get('audioId');



   $check = $sermon->publishStatus('sermonAudioFormat',$detail_id);
   if ($check->published == 1) {
     echo $show->showMessage('danger', 'Please Unplublish this sermon from public before editing, to avoid errors', 'warning');
     return false;
   }

$file = Input::get('sermon_audio');
if ($file) {

  $filename = $file['name'];
  $filesize = $file['size'];


  if (empty($file['name'])) {
      echo $show->showMessage('danger', 'File cant be empty!', 'warning');
      return false;
  }
  if (!$fileupload->isAudio($filename)) {
      echo $show->showMessage('danger', 'File is not a valid audio file!', 'warning');
      return false;

  }
  if ($fileupload->fileSize($filename)) {
      echo $show->showMessage('danger', 'File size is too large!', 'warning');
      return false;
  }

  $ds = DIRECTORY_SEPARATOR;
  $temp_file = $file['tmp_name'];
  $file_path = $fileupload->moveFile($temp_file, "uploads","sermon", $filename)->path();
  $db_path = $file_path;

}else {
    $db_path = Input::get('sermon_audio_file');
    $filesize = Input::get('sermon_audio_size');
}

if (Input::exists()) {
  $validation = $validate->check($_POST, array(
    'sermon_title' => array(
      'required' => true,
    ),
    'sermon_author' => array(
      'required' => true,
    ),
    'date_preached' => array(
      'required' => true,
    ),
    'description' => array(
      'required' => true,
    )
  ));

  if ($validation->passed()) {
      $sermon->updateSermon('sermonAudioFormat',$detail_id,array(
        	'author' => Input::get('sermon_author'),
        	'title' => Input::get('sermon_title'),
          'description' => Input::get('description'),
          'audio' => $db_path,
          'audioSize' => $filesize,
          'dateOfSermon' => Input::get('date_preached'),
      ));

      echo 'success';

  }else{
    foreach ($validation->errors() as $error) {
     echo $show->showMessage('danger', $error, 'warning');
     return false;
    }
  }
}
