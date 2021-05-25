<?php
require_once '../../core/init.php';

$fileUpload = new FileUpload();
$admin = new Admin();
$sermon = new Sermon();
$validate = new Validate();
$show = new Show();


if (isset($_POST['action']) && $_POST['action'] == 'editSermon') {

  if (Input::exists()) {
      $validation = $validate->check($_POST, array(
        'sermonTitle' => array(
            'required' => true
        ),
        'sermonAuthor' => array(
            'required' => true
        ),
        'datePreached' => array(
            'required' => true
        ),
        'sermon' => array(
            'required' => true
        ),
      ));
      if ($validation->passed()){
      $sermonTitle = Input::get('sermonTitle');
        $slug_url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($sermonTitle)));
        //check and generate slug url for each sermon
             $checkSlug = $sermon->slugCheck('sermonTextFormat',$slug_url);
             if ($checkSlug) {
                 foreach ($checkSlug as $slug) {
                   $data[] = $slug->slug_url;
                 }
                 if (in_array($slug_url, $data)) {
                   $count = 0;
                   while(in_array(($slug_url . '-' . ++$count), $data));
                   $slug_url = $slug_url . '-' . $count;
                 }
             }
             $sermonId = Input::get('sermonId');
             $check = $sermon->publishStatus('sermonTextFormat',$sermonId);
             if ($check->published == 1) {
               echo $show->showMessage('danger', 'Please Unplublish this sermon from public before editing, to avoid errors', 'warning');
               return false;
             }



             //insert data
             try {
               $sermon->updateSermon('sermonTextFormat', $sermonId, array(
                 'author' => Input::get('sermonAuthor'),
                 'title' => Input::get('sermonTitle'),
                 'slug_url' => $slug_url,
                 'message' => Input::get('sermon'),
                 'dateOfSermon' => Input::get('datePreached')
               ));
               echo 'success';
             } catch (\Exception $e) {
               echo $show->showMessage('danger', $e->getMessage(), 'warning');
               return false;
             }

      }else{
        foreach ($validation->errors() as $error) {
        echo $show->showMessage('danger', $error, 'warning');
        return false;
        }
      }
  }
}
