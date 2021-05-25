<?php
require_once '../core/init.php';
if (!isIsLoggedIn()){
    Session::flash('warning', 'You need to login to access that page!');
    Redirect::to('admin-login');
}
$admin = new Admin();
$adminEmail = $admin->getAdminEmail();


// if (isOTPset($adminEmail)) {
//   Redirect::to('otp-verify');
// }

require APPROOT . '/includes/headpanel.php';
require APPROOT . '/includes/navpanel.php';

?>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!--open or close form-->
                <hr class="invisible">
                <div class="card">
                    <div class="card-header">
                        <h5>Sunday Bulletin</h5>
                        <div class="card-block">
                            <div id="showBulletin">

                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Add Bulletin</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-trash close-card"></i></li>
                            </ul>
                        </div>
                        <div class="card-block p-0 pt-2">
                          <?php include 'chapel-bulletin.php' ?>

                        </div>
                    </div>
                </div>

                    <!-- Page-body end -->
                  </div>


            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>




    <?php
    require APPROOT . '/includes/footerpanel.php';
    ?>
    <script>
        $(document).ready(function (){
          gifroot =  '../gif/trans2.gif';


            fetchBulletin();
            function fetchBulletin(){
                $.ajax({
                    url: 'script/bulletin-process.php',
                    method: 'post',
                    data: {action: 'fetchBulletin'},
                    success:function(response){
                        $('#showBulletin').html(response);
                    }

                });
            }

          $('#addBulletinBtn').click(function(e){
            e.preventDefault();
            $.ajax({
              url:'script/bulletin-process.php',
              method:'post',
              data:$('#addBulletinForm').serialize()+'&action=addBulletin',
              beforeSend:function(){
                $('#addBulletinBtn').html('<img src="'+gifroot+'">adding...');
              },
              success:function(response){
                if ($.trim(response) === 'success') {
                  $('#addBulletinForm')[0].reset();
                  swal.fire({
                      icon:'success',
                      title:'Added',
                      text:'Bulletin Added Successfully'
                  });
                  fetchBulletin();

                }else{
                  $('#showError').html(response);
                }
              },
              complete:function(){
                $('#addBulletinBtn').html('Add Bulletin');
              }
            })
          })

            $("body").on("click", ".NoticedeleteBtn", function(e){
                e.preventDefault();
                delfed_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You can revert this action",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'script/inits.php',
                            method: 'POST',
                            data: {delfed_id: delfed_id},
                            success:function(response){
                                Swal.fire(
                                    'Notice  Deleted!',
                                    'Notice Deleted Successfully!',
                                    'success'
                                )
                                fetchNotice();
                            }
                        });

                    }
                });

            });




        })
    </script>
    <script type="text/javascript" src="customTextarea.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
    <script type="text/javascript" src="activity.js"></script>
    <script type="text/javascript" src="notify.js"></script>
