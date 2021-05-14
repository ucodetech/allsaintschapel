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
                    <!--   monitor users-->
                    <div class="row">
                        <!--  project and team member start -->
                        <div class="col-xl-8 col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Current Logged In Members</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive" id="showCurrentLoggedInM">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h5>Current Logged In Admin</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" id="showCurrentLoggedInAdmin"></div>
                            </div>
                        </div>
                        <!--  project and team member end -->
                    </div>
                    <hr>
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-purple" id="totMembers"></h4>
                                            <h6 class="text-muted m-b-0">All Members</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-users f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-purple">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">total number of members</p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="fa fa-users text-white f-16"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green" id="totSermon"></h4>
                                            <h6 class="text-muted m-b-0">Total Sermon</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-microphone f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">total number of sermons</p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="fa fa-microphone text-white f-16"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-red" id="totFeedback"></h4>
                                            <h6 class="text-muted m-b-0">Total Feedback</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-bell f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-red">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">total feedback from members</p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="fa fa-bell text-white f-16"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-blue" id="totNewMembers"></h4>
                                            <h6 class="text-muted m-b-0">New Registration</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-user-plus f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-blue">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">total new member registration</p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="fa fa-user-plus text-white f-16"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- task, page, download counter  end -->

                        <!--  sale analytics start -->
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>NEW REGISTRATION WAITING FOR APPROVAL</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive" id="newMembers"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <hr>


                <!--  second row-->
                    <div class="row">
                        <!--  project and team member start -->
                        <div class="col-xl-8 col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Student Executives</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive" id="showstudentExecos">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h5>Council Members</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="align-middle m-b-30">
                                        <img src="../assets/images/avatar-2.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                        <div class="d-inline-block">
                                            <h6>David Jones</h6>
                                            <p class="text-muted m-b-0">Developer</p>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <a href="#!" class="b-b-primary text-primary">View all</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  project and team member end -->
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>

<?php
require APPROOT . '/includes/footerpanel.php';
?>
<script>
    $(document).ready(function(){

        //fetch admins
        fetch_newMembers();
        function fetch_newMembers(){
            action = 'fetchNewMembers';
            $.ajax({
                url:'script/request-process.php',
                method:'post',
                data:{action:action},
                success:function (response){
                    console.log(response);
                    $('#newMembers').html(response);
                    $('#ShownewMembers').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "order": [0,'desc'],
                        "info": true,
                        "autoWidth": true,
                        "responsive": false,
                        "lengthMenu": [[10,10, 25, 50, -1], [10, 25, 50, "All"]]
                    });
                }
            });
        }

    $('body').on('click','.approveMemberBtn', function(e){
        e.preventDefault();
        approvedid = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to approve this user",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'script/request-process.php',
                    method: 'POST',
                    data: {approvedid: approvedid},
                    success:function(response){
                        Swal.fire(
                            'Member Approved',
                            'Member have been Approved Successfully',
                            'success'
                        )
                        fetch_newMembers();

                    }
                });

            }
        });
    })





        fetchLoggedInAdmins();
        setTimeout(function () {
            fetchLoggedInAdmins();
        },1000);

        function fetchLoggedInAdmins(){
            action = 'fetch_super';
            $.ajax({
                url:'script/initate.php',
                method:'post',
                data:{action:action},
                success:function(response){
                    $('#showCurrentLoggedInAdmin').html(response);
                }
            });
        }
    });
</script>
<script type="text/javascript" src="scripts.js"></script>
<script type="text/javascript" src="activity.js"></script>
<script type="text/javascript" src="notify.js"></script>
