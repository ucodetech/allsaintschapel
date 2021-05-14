<?php
require_once  '../../core/init.php';
  $feed = new Feedback();
  $notify = new Notification();
  $getNoti = new Student();
  $general = new General();
  $show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'getNotify') {
    if ($getNoti->fetchNotifactionCount()) {
      $count =  $getNoti->fetchNotifactionCount();
      echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }else{
    echo '<span class="badge badge-pill badge-danger">0</span>';
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'fetch_offenders') {

	$fetchStudent = $getNoti->fetchOffenders();
	if ($fetchStudent) {
		echo $fetchStudent;
	}

}

// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotifaction') {

    $notifaction = $notify->fetchNotifactionAdmin();
    $output = '';
    if ($notifaction){
        foreach ($notifaction as $noti) {
            $user = $grapNote->selectUserNote($noti->user_id);
            $output .= '
      <div class="col-lg-5 align-self-center">
      <div class="alert alert-info" role="alert">
        <button type="button" id="'.$noti->id.'" name="button" class="close" data-dismiss="alert" aria-label="Close">
        <span arid-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">New Notification</h4>
      <p class="mb-0 lead">
        '.$user->full_name.'->  '.$noti->message.'
      </p>
      <hr class="my-2">
      <p class="mb-0 float-left">User -> '.$user->full_name.'</p>
      <p class="mb-0 float-right"><i class="lead">'.timeAgo($noti->dateCreated).'</i></p>
      <div class="clearfix"> </div>
    </div>
    </div>
      ';
        }
        echo $output;
    }else{
        echo '<h4 class="text-center text-dark mt-5">No New Notifications</h4>';
    }



}

if (isset($_POST['action']) && $_POST['action'] == 'checkNotifaction') {
    $count = $notify->fetchNotifactionCountAdmin();
    echo $count;

}
