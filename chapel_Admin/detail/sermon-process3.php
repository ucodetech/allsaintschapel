
<?php
require_once '../../core/init.php';

$fileupload = new FileUpload();
$admin = new Admin();
$sermon = new Sermon();
$validate = new Validate();
$show = new Show();
$db = Database::getInstance();
$detail_id= $_POST['audioId'];

if (isset($_POST['action']) && $_POST['action'] == 'deleteFile') {
  $detail_iddelete = $_POST['audioId'];
  $audio = $_POST['dsermon_audio'];
  $image_url = '../../uploads/sermon/'.$audio;

   $check = $sermon->publishStatus('sermonAudioFormat',$detail_iddelete);
   if ($check->published == 1) {
     echo $show->showMessage('danger', 'Please Unplublish this sermon from public before editing, to avoid errors', 'warning');
     return false;
   }
    if(unlink($image_url))
        $db->query("UPDATE sermonAudioFormat SET audio = ' ' WHERE id = '$detail_iddelete' ");

        echo 'success';
}
