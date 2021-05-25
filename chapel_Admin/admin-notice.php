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
                        <h5>Special Notice</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-trash close-card"></i></li>
                            </ul>
                        </div>


                        <div class="card-block">
                            <div class="table-responsive shadow-lg" id="showNotices"></div>

                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>

    <!-- Display Notice in a details modal -->
     <div class="modal fade" id="showNoticeDetailsModal">
       <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content" id="Notice">


         </div>
       </div>
     </div>

 <!-- //REply Notice -->
 <div class="modal fade" id="replyModal">
   <div class="modal-dialog modal-dialog-centered modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <h3 class="modal-title">
         Reply This Notice
         </h3>
         <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
       </div>
       <div class="modal-body">
         <form class="px-3" action="#" method="post" id="reply-Notice-form">
           <div class="form-group">
             <textarea name="message" id="message" class="form-control" rows="6" placeholder="Message here" required autofocus="true"></textarea>
           </div>
           <div class="form-group">
             <input type="submit" id="replyBtn" value="Send Reply" class="btn btn-success btn-block btn-lg">
           </div>
         </form>
       </div>

     </div>
   </div>
 </div>




    <?php
    require APPROOT . '/includes/footerpanel.php';
    ?>
    <script>
        $(document).ready(function (){


            fetchNotice();
            function fetchNotice(){
                $.ajax({
                    url: 'script/inits.php',
                    method: 'post',
                    data: {action: 'fetchAllFeed'},
                    success:function(response){
                        console.log(response);
                        $('#showAlFeed').html(response);
                        $('#showFeed').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                            "info": true,
                            "autoWidth": true,
                            "responsive": false,
                            "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
                        });

                    }

                });
            }

//Display user in details ajax request
            $("body").on("click", ".userDetailsIcon", function(e){
                e.preventDefault();

                details_id = $(this).attr('id');
                $.ajax({
                    url: 'script/inits.php',
                    method: 'post',
                    data: {details_id: details_id},
                    success:function(response){
                        $('#others').html(response);
                    }
                });
            });

//Delete users

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




//Display user in details ajax request
            $("body").on("click", ".NoticeinfoBtn", function(e){
                e.preventDefault();

                NoticeDetails_id = $(this).attr('id');
                $.ajax({
                    url: 'script/inits.php',
                    method: 'post',
                    data: {NoticeDetails_id: NoticeDetails_id},
                    success:function(response){
                        $('#Notice').html(response);
                    }
                });
            });

//GEt current selected user id and Notice id
            var userid;
            var feedid;
            $('body').on('click', '.replyNoticeIcon', function(e){
                $('#showNoticeDetailsModal').modal('hide');
                userid = $(this).attr('id');
                feedid = $(this).attr('fid');
            });
            //SEnd Notice reply to the user ajax request
            $('#replyBtn').click(function(e){
                if($('#reply-Notice-form')[0].checkValidity()){
                    let message = $("#message").val();
                    e.preventDefault();
                    $("#replyBtn").val('Please wait...');
                    $.ajax({
                        url: 'script/inits.php',
                        method: 'post',
                        data: {userid: userid, message : message, feedid : feedid},
                        success:function(response){
                            $("#replyBtn").val('Send Reply');
                            $('#replyModal').modal('hide');
                            $('#reply-Notice-form')[0].reset();
                            Swal.fire(
                                'Sent!',
                                'Reply Sent Successfully to the user!',
                                'success'
                            )
                            fetchNotice();
                        }
                    })
                }
            })



        })
    </script>
    <script type="text/javascript" src="scripts.js"></script>
    <script type="text/javascript" src="activity.js"></script>
    <script type="text/javascript" src="notify.js"></script>