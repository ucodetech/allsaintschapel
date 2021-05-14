<?php
require_once '../../core/init.php';

$student = new Admin();
$show = new Show();
$counsel = new Counsel();
$db = Database::getInstance();

if (isset($_POST['action']) && $_POST['action'] == 'fetchCounselling') {
    $counselled = 	$counsel->fetchCounselling();
    if ($counselled){
        echo $counselled;
    }

}

if (isset($_POST['action']) && $_POST['action'] == 'CheckTrigger'){
    $check = $counsel->triggerForm('formName', 'counsellingForm');
    $output = '';
    if ($check->switch == 0){
       $output .= '<div class="row">
            <div class="col-sm-6">
                <button type="button" class="btn btn-outline-info activateCounselFrom">Activate Counselling Form</button>
            </div>
            <div class="col-sm-6">
                <h4 class="text-danger">Counselling Form is not Active</h4>
            </div>
        </div>';

    }else{

      $output .= '<div class="row">
            <div class="col-sm-6">
                <button type="button" class="btn btn-outline-danger deactivateCounselFrom">Deactivate Counselling Form</button>
            </div>
            <div class="col-sm-6">
                <h4 class="text-success">Counselling Form is Active</h4>
            </div>
        </div>';



    }
    echo $output;
}