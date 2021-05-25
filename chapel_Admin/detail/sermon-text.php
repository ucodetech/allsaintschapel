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
$sermon = new Sermon();
$show = new Show();

if (isset($_GET['detail']) && !empty($_GET['detail'])){
    $detail = $_GET['detail'];
    $getDetail = $sermon->getDetail('sermonTextFormat',$detail);
    if ($getDetail){
      ?>

      <div class="pcoded-inner-content">
          <!-- Main-body start -->
          <div class="main-body">
              <div class="page-wrapper">
                  <!-- Page-body start -->
                  <div class="page-body">
                      <!--open or close form-->
                      <hr class="invisible">
                      <!-- Tab variant tab card start -->
                      <div class="card">
                          <div class="card-header">
                              <h5>Sermon</h5>
                          </div>
                          <div class="card-block">
                            <h4 class="text-center text-primary"><i class="fa fa-edit fa-lg"></i>Edit <?=$getDetail->title;?></h4><hr>
                            <form class="material" action="#" method="post" id="sermonTextFormEdit">
                              <div class="row mb-3">
                                <div class="form-group col-md-6">
                                  <label for="sermonTitle">Sermon Title:<sup class="text-danger">*</sup>  </label>
                                  <input type="text" name="sermonTitle" id="s ermonTitle" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->title?>">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="sermonAuthor">Sermon Author:<sup class="text-danger">*</sup>  </label>
                                  <input type="text" name="sermonAuthor" id="sermonAuthor" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->author?>">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="form-group col-md-6">
                                  <label for="datePreached">Sermon Date:<sup class="text-danger">*</sup>  </label>
                                  <input type="date" name="datePreached" id="datePreached" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->dateOfSermon;?>">
                                </div>

                              </div>
                              <div class="row mb-3">
                                <div class="form-group col-md-12">
                                  <label for="message">Message:<sup class="text-danger">*</sup>  </label>
                                  <textarea name="sermon" id="sermon" rows="8" class="form-control"><?=$getDetail->message?></textarea>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-6 form-group">
                                  <input type="hidden" name="sermonId" id="sermonId"   value="<?=$detail?>">
                                  <button type="button" name="SermonBtnEdit" id="SermonBtnEdit" class="btn btn-outline-info"><i class="fa fa-edit fa-lg"></i>&nbsp;Edit Sermon </button>
                                </div>
                                <div class="col-6 form-group">
                                  <a href="../../admin-sermon" name="reset" id="reset" class="btn btn-outline-danger"><i class="ti-angle-double-left"></i>&nbsp;Cancel</a>
                                </div>
                              </div>
                              <hr class="inivisible">
                              <div class="row">
                                <div class="form-group" id="showError">

                                </div>
                              </div>
                            </form>


                      </div>
               </div>
        <!-- Tab variant tab card start -->
        <!-- Page-body end -->
        </div>
     <div id="styleSelector"> </div>
  </div>
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
          $(document).ready(function () {

            $('#sermon').summernote({
               focus: true,
               tabsize: 2,
               toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['fontname', ['fontname']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['fontsize', ['fontsize']],
                  // ['table', ['table']],
                  ['insert', ['link']],
                  ['view', ['fullscreen', 'help']],
                ],
              // height: 300,

            });

              $('#SermonBtnEdit').click(function (e) {
                  e.preventDefault();
                  $.ajax({
                      url: '../sermon-process.php',
                      method: 'post',
                      data: $('#sermonTextFormEdit').serialize()+'&action=editSermon',
                      success: function (response) {
                          if ($.trim(response) === 'success') {
                              swal.fire(
                                'Updated',
                                'Sermon Updated Successfully!',
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
