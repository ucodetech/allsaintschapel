<?php
require_once '../core/init.php';
if (!isLoggedInMember()){
    Session::flash('warning', 'You need to login to access that page!');
    Redirect::to('member-login');
}
$user = new User();

require APPROOT . '/includes/headpanel1.php';
require APPROOT . '/includes/navpanel1.php';

?>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <?php
                if($user->data()->updated == 0){
                      ?>
                    <span class="text-danger text-center text-lg lead">
                        Please go to your profile page and complete your membership details!
                        <a href="member-profile" class="btn btn-outline-info btn-sm" style="font-size:1.2rem">My profile</a></span>
                    <hr>
                <?
                } ?>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>
</div>




<?php
require APPROOT . '/includes/footerpanel1.php';
?>
