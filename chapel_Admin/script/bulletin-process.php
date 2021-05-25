<?php
require_once '../../core/init.php';
$bulletin = new Bulletin();
$validate = new Validate();
$show = new Show();


if (isset($_POST['action']) && $_POST['action'] == 'fetchBulletin') {

    $getBulletin = $bulletin->fetchBulletin();
    if ($getBulletin) {
      echo $getBulletin;
    }

}

if (isset($_POST['action']) && $_POST['action'] == 'addBulletin') {
    if (Input::exists()) {
        $validation = $validate->check($_POST, array(
          'conductor' => array(
            	'required' => true,
            ),
            'dateOfService' => array(
            	'required' => true,
              'unique' => 'chapel_bullentin',
            ),
            'timeOfSercviceStart' => array(
            	'required' => true,
            ),
            'timeOfSercviceEnd' => array(
            	'required' => true,
            ),
            'chaplain_desk' => array(
            	'required' => true,
            ),
            'orderOfService' => array(
            	'required' => true,
            ),
            'specialNotice' => array(
            	'required' => true,
            ),
            'shareYourStory' => array(
            	'required' => true,
            ),
            'biblStudyOutline' => array(
            	'required' => true,
            ),
            'title' => array(
              'required' => true
            ),

        ));
        if ($validation->passed()) {
            $bulletin->create(array(
              'conductor' => Input::get('conductor'),
              'dateOfService' => Input::get('dateOfService'),
              'timeOfServiceStart' => Input::get('timeOfSercviceStart'),
              'timeOfServiceEnd' => Input::get('timeOfSercviceEnd'),
              'chaplainDesk' => Input::get('chaplain_desk'),
              'orderOfService' => Input::get('orderOfService'),
              'specialNotice' => Input::get('specialNotice'),
              'shareStory' => Input::get('shareYourStory'),
              'biblStudyOutline' => Input::get('biblStudyOutline'),
              'topic' => Input::get('title')
            ));
            echo 'success';
        }else{
          foreach ($validation->errors() as $error) {
            echo $show->showMessage('danger', $error, 'warning');
            return false;
          }
        }
    }
}

if (isset($_POST['detailId']) && !empty($_POST['detailId'])) {
  $detailid = $_POST['detailId'];
    $getBulletin = $bulletin->fetchBulletinDetail($detailid);
    if ($getBulletin) {
      echo $getBulletin->biblStudyOutline;
    }

}

if (isset($_POST['action']) && $_POST['action'] == 'editBulletin') {
    if (Input::exists()) {
        $validation = $validate->check($_POST, array(
          'conductor' => array(
            	'required' => true,
            ),
            'dateOfService' => array(
            	'required' => true,
            ),
            'timeOfServiceStart' => array(
            	'required' => true,
            ),
            'timeOfServiceEnd' => array(
            	'required' => true,
            ),
            'chaplain_desk' => array(
            	'required' => true,
            ),
            'orderOfService' => array(
            	'required' => true,
            ),
            'specialNotice' => array(
            	'required' => true,
            ),
            'shareYourStory' => array(
            	'required' => true,
            ),
            'biblStudyOutline' => array(
            	'required' => true,
            ),
            'title' => array(
              'required' => true
            ),

        ));
        if ($validation->passed()) {
            $edit_id = Input::get('edit_id');
            $bulletin->updatebulletin($edit_id, array(
              'conductor' => Input::get('conductor'),
              'dateOfService' => Input::get('dateOfService'),
              'timeOfServiceStart' => Input::get('timeOfServiceStart'),
              'timeOfServiceEnd' => Input::get('timeOfServiceEnd'),
              'chaplainDesk' => Input::get('chaplain_desk'),
              'orderOfService' => Input::get('orderOfService'),
              'specialNotice' => Input::get('specialNotice'),
              'shareStory' => Input::get('shareYourStory'),
              'biblStudyOutline' => Input::get('biblStudyOutline'),
              'topic' => Input::get('title')
            ));
            echo 'success';
        }else{
          foreach ($validation->errors() as $error) {
            echo $show->showMessage('danger', $error, 'warning');
            return false;
          }
        }
    }
}
