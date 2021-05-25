<?php
require_once '../../core/init.php';
if (!isIsLoggedIn()){
    Session::flash('warning', 'You need to login to access that page!');
    Redirect::to('../../admin-login');
}
$admin = new Admin();
$adminEmail = $admin->getAdminEmail();


// if (isOTPset($adminEmail)) {
//   Redirect::to('otp-verify');
// }

require APPROOT . '/includes/headpanel.php';
require APPROOT . '/includes/navpanel.php';
$bulletin = new Bulletin();
$show = new Show();

if (isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit = $bulletin->getDetail('chapel_bullentin',$edit_id);
    if ($edit){
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
                    <h5>Edit Bulletin</h5>
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
            }
        }
        ?>

<?php
require APPROOT . '/includes/footerpanel.php';
?>
<script>
// var edit = function() {
//     $('.outline').summernote({focus: true});
      // $.ajax({
      //   url: '../../script/bulletin-process.php',
      //   method: 'post',
      //   data:{action = 'getBibleStudy'},
      //   success: function (response) {
      //     data = JSON.parse(response);
      //       $('.outline').html(data.biblStudyOutline);
      //       $('#outline').css('display','none');
      //   }
      // });
//   };


  // var save = function() {
  //   var markup = $('.outline').summernote('code');
  //   $('.outline').summernote('destroy');
  // };

    $(document).ready(function () {
      gifroot =  '../../../gif/trans2.gif';

$('#editBulletinBtn').click(function(e){
        e.preventDefault();
        $.ajax({
          url:'../../script/bulletin-process.php',
          method:'post',
          data:$('#editBulletinForm').serialize()+'&action=editBulletin',
          beforeSend:function(){
            $('#editBulletinBtn').html('<img src="'+gifroot+'">updating...');
          },
          success:function(response){
            if ($.trim(response) === 'success') {
              $('#editBulletinForm')[0].reset();
              swal.fire({
                  icon:'success',
                  title:'Updated',
                  text:'Bulletin Updated Successfully'
              });
              setTimeout(function(){
                window.location = '../bulletin-detail/'+'<?=$edit_id?>';
              },3000);

            }else{
              $('#showError').html(response);
            }
          },
          complete:function(){
            $('#editBulletinBtn').html('Add Bulletin');
          }
        })
      })
    });
</script>
<script type="text/javascript" src="../customTextarea.js"></script>
