<?php
require_once  '../../core/init.php';
$grapNote = new UserNote();
$feed = new Feedback();
$notify = new Notification();
$show = new Show();
$user = new User();



// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotifaction') {
  $user_id = $user->data()->id;
    $notifaction = $notify->fetchNotifaction($user_id );
    $output = '';
    if ($notifaction){
        foreach ($notifaction as $noti) {
            $user = $grapNote->selectUserNote($noti->user_id);
            $output .= '
            <div class="media">
                <img class="d-flex align-self-center img-radius" src="'.URLROOT.'chapel_Members/profile/admin.png" alt="admin">
                <div class="media-body">
                    <h5 class="notification-user">From Admin</h5>
                    <p class="notification-msg">'.$noti->message.'</p>
                    <span class="notification-time">'.timeAgo($noti->dateCreated).'</span> <hr>
                    <a href="member-feedback" clas="text-info">Go to feedback</a> <hr class="invisible">
                    <button type="button" id="'.$noti->id.'" name="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span arid-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
      ';
        }
        echo $output;
    }else{
        echo '<h4 class="text-center text-info mt-5">No New Notifications</h4>';
    }



}

if (isset($_POST['action']) && $_POST['action'] == 'getNotify') {
    if ($notify->fetchNotifactionAdmin()) {
        $count =  $notify->fetchNotifactionCountAdmin();
        echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }else{
        $count =  $notify->fetchNotifactionCountAdmin();
        echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }
}



//remove notifatications
if (isset($_POST['notifacation_id'])) {
  $id = $_POST['notifacation_id'];
  ;
  $notify->removeNotification($id);
}


if(isset($_POST['action']) && $_POST['action'] == "update_time"){
    $id =  $user->data()->id;
    $d = $user->activity($id);
}
