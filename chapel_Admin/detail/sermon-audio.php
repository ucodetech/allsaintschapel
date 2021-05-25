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
    $getDetail = $sermon->getDetail('sermonAudioFormat',$detail);
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
                            <form class="material" action="#" method="post" id="sermonAudioFormEdit">
                              <input type="hidden" name="audioId" id="audioId" value="<?=$detail?>">

                              <div class="row mb-3">
                                <div class="form-group col-md-6">
                                  <label for="sermon_title">Sermon Title:<sup class="text-danger">*</sup>  </label>
                                  <input type="text" name="sermon_title" id="sermon_title" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->title?>">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="sermon_author">Sermon Author:<sup class="text-danger">*</sup>  </label>
                                  <input type="text" name="sermon_author" id="sermon_author" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->author?>">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="form-group col-md-6">
                                  <label for="date_preached">Sermon Date:<sup class="text-danger">*</sup>  </label>
                                  <input type="date" name="date_preached" id="date_preached" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->dateOfSermon?>">
                                </div>

                              </div>
                              <div class="row mb-3">
                                <div class="form-group col-md-12">
                                  <label for="description">Description:<sup class="text-danger">*</sup>  </label>
                                  <textarea name="description" id="description" rows="8" class="form-control"><?=$getDetail->description;?></textarea>
                                </div>
                              </div>
                              <div class="row mb-3">

                                <div class="form-group col-md-6">
                                  <?php if ($getDetail->audio != ' '): ?>
                                    <label for="sermon_audio">Existing Audio: </label><br>
                                      <input type="hidden" name="sermon_audio_file" id="sermon_audio_file" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->audio?>">
                                      <input type="hidden" name="sermon_audio_size" id="sermon_audio_size" value="<?=$getDetail->audioSize?>">
                                       <hr class="invisible">
                                    <audio controls><source src="../../../uploads/sermon/<?=$getDetail->audio?>" type="audio/mp3"> </audio>
                                    <?php else: ?>
                                      <label for="sermon_audio">Sermon Audio:<sup class="text-danger">*</sup>  </label>
                                      <input type="file" name="sermon_audio" id="sermon_audio" class="form-control form-control-success form-control-round form-control-bold">
                                  <?php endif; ?>


                                </div>

                                <div class="form-group col-md-6" >
                                  <label for="">Preview Audio file before upload</label>
                                  <div class="container"  id="previewAudio">

                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <button type="submit" name="editSermonBtnAudio" id="editSermonBtnAudio" class="btn btn-outline-info"><i class="fa fa-plus-circle fa-lg"></i>&nbsp;Edit Sermon </button>
                                </div>
                                <div class="col-6 form-group">
                                  <a href="../../admin-sermon"  class="btn btn-outline-danger"> <i class="ti-angle-double-left"></i>Cancel Editing </a>
                                </div>
                              </div>
                              <hr class="inivisible">
                              <div class="row">
                                <div class="form-group" id="showError2">

                                </div>
                              </div>
                            </form>


                              <!-- delete existing audio file -->
                              <?php if ($getDetail->audio != ' '): ?>
                                <form class="material" action="#" id="deleteAudioForm" method="post">
                                  <input type="hidden" name="dsermon_audio" id="dsermon_audio" class="form-control form-control-success form-control-round form-control-bold" value="<?=$getDetail->audio?>">
                                  <input type="hidden" name="audioId" id="audioId" value="<?=$detail?>">
                                  <label class="text-info">Delete Exsiting Audio File if you want to upload a new one</label><br>
                                  <button type="button" name="button" id="deleteAudioBtn" class="btn btn-danger">Delete Audio</button>
                                </form>
                              <?php endif; ?>

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
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                  $('#previewAudio').html('<audio controls><source src="'+e.target.result+'" type="audio/mp3"> </audio>');
              }
              reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
      }


          $(document).ready(function (){
            gifroot =  '../../../gif/trans2.gif';

            $("#sermon_audio").change(function() {
                readURL(this);
            });


            $('#description').summernote({
               focus: true,
               tabsize: 2,
               toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['fontname', ['fontname']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  // ['table', ['table']],
                  ['insert', ['link']],
                  ['view', ['fullscreen', 'help']],
                ],
              // height: 300,
              });


            $('#deleteAudioBtn').click(function(e){
                e.preventDefault();
                detail_iddelete = $('#audioId').val();
                audio_file = $('#dsermon_audio').val();
                  $.ajax({
                    url:'../sermon-process3.php',
                    method:'post',
                    data:$('#deleteAudioForm').serialize()+'&action=deleteFile',
                    success:function(response){
                      if ($.trim(reponse)==='success') {
                        location.reload();
                      }else{
                        $('#showError2').html(response);

                      }

                    }
                  })
              });

            $('#sermonAudioFormEdit').submit(function (e){
      e.preventDefault();
      $.ajax({
          url:'../sermon-process2.php',
          method:'post',
          processData: false,
          contentType:false,
          cache:false,
          data: new FormData(this),
          beforeSend:function(){
            $('#editSermonBtnAudio').html('<img src="'+gifroot+'">Updating...');
          },
          success:function (response){
              if ($.trim(response)==='success'){
                swal.fire({
                    icon:'success',
                    title:'Updated',
                    text:'Sermon Updated Successfully'
                });
                setTimeout(function() {
                  location.reload();
                }, 5000);
              }else{
                  $('#showError2').html(response);
              }
          },
          complete:function(){
            $('#editSermonBtnAudio').html('Edit Sermon');
          }
      });
  });
});

</script>
