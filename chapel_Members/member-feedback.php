<?php
require_once '../core/init.php';
if (!isLoggedInMember()){
    Session::flash('denied', 'You need to login to access that page!');
    Redirect::to('member-login');
}
$user = new User();

require APPROOT . '/includes/headpanel1.php';
require APPROOT . '/includes/navpanel1.php';
$counsel = new Counsel();
$checkCounselling = $counsel->triggerForm('formName', 'counsellingForm');
$checkScreening = $counsel->triggerForm('formName', 'electionScreeningFrom');

?>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="card">
                    <div class="card-block">
                        <marquee behavior="scroll" direction="2">
                            <span class="text-center text-info"><i class="fa fa-bell fa-lg"></i>Notification comes up here</span>
                        </marquee>
                        <hr class="invisible">
                        <hr class="invisible">
                        <div class="container">
                            <?php
                            if (Session::exists('warning')){
                                echo '
                            <div class="alert alert-danger alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert">&times;</button>
                            <strong class="text-center">'.Session::flash('warning').'</strong>
                            </div>
                                   ';
                            }
                            ?>
                        </div>
                        <?php
                        if($user->data()->updated == 0){
                            ?>
                            <span class="text-danger text-center text-lg lead">
                        Please go to your profile page and complete your membership details!
                        <a href="member-profile" class="btn btn-outline-info btn-sm" style="font-size:1.2rem">My profile</a></span>
                            <hr>
                            <?
                        } ?>
                        <!-- //counselling form-->
                        <?php if($checkCounselling->switch == 1): ?>
                            <?php if($counsel->checkUser('counsellingForm',$user->data()->id)): ?>
                                <span class="text-center text-success text-capitalize">You have already submitted your counselling form</span>
                            <?php else: ?>
                                <span class="text-info text-center text-lg lead">
                       Form is open for Counselling request! follow the link  to fill.
                        <a href="chapel2counselling-counselling" class="btn btn-outline-info btn-sm" style="font-size:1.2rem">Counselling Form A1</a></span>
                                <hr>
                            <?php endif; ?>

                        <?php endif; ?>


                        <!--                        end of counselling form-->
                        <!-- //screening form-->
                        <?php if($checkScreening->switch == 1): ?>
                            <?php if($counsel->checkUser('screeningForm',$user->data()->id)): ?>
                                <span class="text-center text-success text-capitalize">You have already submitted your screening form</span>
                            <?php else: ?>
                                <span class="text-primary text-bold text-center text-lg lead">
                       Screening form for election is open! follow the link  to fill.
                        <a href="chapel3screening-screening" class="btn btn-outline-secondary btn-sm" style="font-size:1.2rem">Screening Form</a></span>
                                <hr>
                            <?php endif; ?>

                        <?php endif; ?>
                        <!--                        end of screening-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-info text-light">
                        <h5 class=" text-light">Send Feed back</h5>
                        <div class="card-header-right  text-light">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa fa-wrench open-card-option  text-light"></i></li>
                                <li><i class="fa fa-window-maximize full-card  text-light"></i></li>
                                <li><i class="fa fa-minus minimize-card  text-light"></i></li>
                                <li><i class="fa fa-refresh reload-card  text-light"></i></li>
                                <li><i class="fa fa-trash close-card  text-light"></i></li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <form action="#"  method="post" id="feedbackForm">
                                <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?=$user->data()->id?>">

                                <div class="form-group">
                                    <label for="Fullname">Full Name: <sup class="text-danger">*</sup></label>
                                    <input type="disabled" name="Fullname" id="Fullname" class="form-control" value="<?=$user->data()->full_name?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject: <sup class="text-danger">*</sup></label>
                                    <input type="text" name="subject" id="subject" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="msg">Feedback: <sup class="text-danger">*</sup></label>
                                    <textarea name="feedback" id="feedback"  class="form-control" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-block btn-warning text-dark" id="feedbackBtn"> <i class="fa fa-comment fa-lg"></i> Send Feedback</button>
                                </div>
                                <div class="form-group" id="showError"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>
</div>




<?php
require APPROOT . '/includes/footerpanel1.php';
?>
<script>
    $(document).ready(function (){

      $('#feedbackBtn').click(function (e){
          e.preventDefault();
          $.ajax({
              url:'script/feedback-process.php',
              method:'post',
              data:$('#feedbackForm').serialize()+'&action=sendFeedback',
              success:function(response){

                  if($.trim(response) === 'success'){
                      swal.fire({
                          icon:'success',
                          title:'Done',
                          text:'Feedback sent successful'
                      });
                      $('#feedbackForm')[0].reset();
                  }else{
                      $('#showError').html(response);
                  }
              }
          })
      })






        update_user_login();

        function update_user_login()
        {
            var action = 'update_time';
            $.ajax({
                url:"script/login-process.php",
                method:"POST",
                data:{action:action},
                success:function(data)
                {},
                error:function(){alert("something went wrong updating activity")}

            });
        }
        setInterval(function(){
            update_user_login();
        }, 1000);


    })
</script>
<script type="text/javascript" src="notify.js"></script>
