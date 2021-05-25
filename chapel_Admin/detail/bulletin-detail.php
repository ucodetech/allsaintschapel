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

if (isset($_GET['detail']) && !empty($_GET['detail'])){
    $detail = $_GET['detail'];
    $getDetail = $bulletin->getDetail('chapel_bullentin',$detail);
    if ($getDetail){
        ?>
<style media="screen">
  .my-container{
    padding:5px;
  }
  .hr{
    border: 1px solid #000;
  }
  .date{
    font-size: 15px;
  }
  .orderShow{
    border:2px solid #000;
    width: 50%;
    margin:10px auto;
    padding:5px;
    font-size: 18px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;

  }
  .conduct{
    font-size: 15px;
  }
</style>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Chapel Bulletin</h5>
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
                        <div class="row">
                          <div class="col-md-4" style="border:2px solid #535; border-radius: 8px;">
                            <div class="my-container">
                              <h5 class="pl-6"><sup>From the</sup></h5>
                                <h4 class="pl-6">Chaplain's Desk <span>image</span> </h4>
                                <hr  class="hr">
                                <p>
                                  <?=
                                    nl2br($getDetail->chaplainDesk);
                                   ?>
                                </p>
                            </div>
                          </div>
                          <div class="col-md-4" style="border:2px solid #535; border-radius: 8px;">
                            <div class="my-container">
                              <h5 class="text-bold text-uppercase text-center"><?=$getDetail->topic?></h5>
                              <p class="text-center date"><?=pretty_nameDay($getDetail->dateOfService)?></p>
                              <p class="text-center orderShow">Order of Service</p>
                              <p class="text-center date">(<?=pretty_time1($getDetail->timeOfServiceStart) .' - '. pretty_time($getDetail->timeOfServiceEnd)?>)</p>
                              <p class="text-center conduct"><i>Conducting Today:&nbsp;<?=$getDetail->conductor?></i> </p>
                              <p class="text-left text-bold myList">
                                <?=$getDetail->orderOfService?>
                              </p>
                            <hr class="hr">
                              <h4 class="text-center text-bold text-underline">Special Notice</h4>
                              <p class="text-left text-bold">
                                <?=$getDetail->specialNotice;?>
                              </p>
                              <hr class="hr">
                                <h4 class="text-center text-bold text-underline">Share your Story with Us</h4>
                                <p class="text-justified text-bold">
                                  <?=$getDetail->shareStory;?>
                                </p>
                                <hr class="hr">
                                  <h4 class="text-center text-bold text-underline">Our Bank Account Details</h4>
                                  <p class="text-center text-bold">
                                    <?= nl2br('Bank: name Type: Savings
                                    A/c Name: All Saints Chapel; A/c No: 53668996'); ?>
                                  </p>
                            </div>
                          </div>
                          <div class="col-md-4" style="border:2px solid #535; border-radius: 8px;">
                            <div class="my-container">
                                <h4 class="text-center text-underline">Bible Study Outline</h4>
                                <p class="text-left">
                                  <?=$getDetail->biblStudyOutline;?>
                                </p>
                            </div>
                          </div>
                        </div>
                        <hr class="invisible">
                        <div class="row">
                          <div class="col-md-6">
                              <a href="#" class="btn btn-outline-info" target="_blank"><i class="fa fa-file fa-lg"></i>Generate PDF</a>
                          </div>
                          <div class="col-md-6">
                              <a href="../bulletin-edit/<?=$detail?>" class="btn btn-outline-secondary" target="_blank"><i class="fa fa-edit fa-lg"></i>Edit</a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="material" action="#" method="post" id="editOutline">
                  <div class="form-group">
                    <textarea name="BibleStudy" id="BibleStudy" rows="8" class="form-control"></textarea>
                  </div>
                </form>

            </div>
          <div class="modal-footer">
    <span id="showMessage"><br>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div> -->

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


      $('#updateCounselFormBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '../../script/counselling-process.php',
                method: 'post',
                data: $('#counsellingFormUpdate').serialize()+'&action=updateCounsel',
                success: function (response) {
                    if ($.trim(response) === 'success') {
                        Swal.fire(
                            'Updated',
                            'Counselling Records Updated Successfully!',
                            'success'
                        );
                        setTimeout(function (){
                            location.reload();
                        },4000);
                    } else {
                        $('#showError').html(response);
                    }
                }
            })
        })


    });
</script>
