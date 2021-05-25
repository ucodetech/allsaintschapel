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
                <!-- Tab variant tab card start -->
                <div class="card">
                    <div class="card-header">
                        <h5>Sermon</h5>
                    </div>
                    <div class="card-block tab-icon">
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <h6 class="sub-title" id="showMessage"></h6>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs md-tabs " role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#textFormat" role="tab">
                                          <i class="ti-book"></i>Sermon Text</a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#audioFormat" role="tab">
                                          <i class="ti-music-alt"></i>Sermon Audio</a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#textForm" role="tab">
                                          <i class="ti-plus"></i>Add Text Form</a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#audioForm" role="tab">
                                          <i class="ti-plus"></i>Add Audio Form</a>
                                        <div class="slide"></div>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content card-block">
                                    <div class="tab-pane active" id="textFormat" role="tabpanel">
                                      <div class="table-responsive" id="showSermonText">
                                            <p class="text-center">
                                              <img src="../gif/trans2.gif" alt="loader">Please wait...</p>
                                      </div>
                                    </div>
                                    <div class="tab-pane" id="audioFormat" role="tabpanel">
                                      <div class="table-responsive" id="showSermonAudio">
                                        <p class="text-center">
                                          <img src="../gif/trans2.gif" alt="loader">Please wait...</p>

                                      </div>
                                    </div>
                                    <div class="tab-pane" id="textForm" role="tabpanel">
                                      <?php include 'sermonText.php' ;?>
                                    </div>
                                    <div class="tab-pane" id="audioForm" role="tabpanel">
                                        <?php include 'sermonAudio.php' ;?>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Row end -->
                    </div>
                </div>
                <!-- Tab variant tab card start -->
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>






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
          gifroot =  '../gif/trans2.gif';

          $("#sermon_audio").change(function() {
              readURL(this);
          });


          $('#sermon').summernote({
             placeholder: 'Paste Your sermon or type',
             focus: true,
             tabsize: 2,
             toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['fontsize', ['fontsize']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'help']],
              ],
            // height: 300,

          });
          $('#description').summernote({
             placeholder: 'Description',
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

            fetchSermonText();
            function fetchSermonText(){
                $.ajax({
                    url: 'script/sermon-process.php',
                    method: 'post',
                    data: {action: 'fetchSermonTextForm'},
                    success:function(response){
                        $('#showSermonText').html(response);
                        $('#showSermons').DataTable({
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

            fetchSermonAud();
            function fetchSermonAud(){
                $.ajax({
                    url: 'script/sermon-process.php',
                    method: 'post',
                    data: {action: 'fetchSermonAuds'},
                    success:function(response){
                        $('#showSermonAudio').html(response);
                        $('#showSermonA').DataTable({
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

            $("body").on("click", ".deleteSermonBtn", function(e){
                e.preventDefault();
                delserm_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You can only see this in trash can",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, trash it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'script/sermon-process.php',
                            method: 'POST',
                            data: {delserm_id: delserm_id},
                            success:function(response){
                              if (response==='success') {
                                Swal.fire(
                                    'Sermon  Trashed!',
                                    'Sermon Trashed check Trash can if  you want to restort <a href="admin-trash" class="text-underline text-bold text-info">Trash</a>!',
                                    'success'
                                )
                                  fetchSermonText();
                              }else{
                                $('#showMessage').html(response);
                              }


                            }
                        });

                    }
                });

            });

            $("body").on("click", ".deleteAudioSermon", function(e){
                e.preventDefault();
                delserma_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You can only see this in trash can",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, trash it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'script/sermon-process.php',
                            method: 'POST',
                            data: {delserma_id: delserma_id},
                            success:function(response){
                              if(response==='success'){
                                Swal.fire(
                                    'Sermon  Trashed!',
                                    'Sermon Trashed check Trash can if  you want to restort <a href="admin-trash " class="text-underline text-bold text-info">Trash</a>!',
                                    'success'
                                )
                                fetchSermonAud();
                              }else{
                                $('#showMessage').html(response);
                              }

                            }
                        });

                    }
                });

            });

            $('#addSermonBtn').click(function(e){
              e.preventDefault();
              $.ajax({
                url:'script/sermon-process.php',
                method:'post',
                data:$('#sermonTextForm').serialize()+'&action=addSermon',
                beforeSend:function(){
                  $('#addSermonBtn').html('<img src="'+gifroot+'">adding...');
                },
                success:function(response){
                  if ($.trim(response) === 'success') {
                    $('#sermonTextForm')[0].reset();
                    swal.fire({
                        icon:'success',
                        title:'Added',
                        text:'Sermon Added Successfully'
                    });
                    fetchSermonText();

                  }else{
                    $('#showError').html(response);
                  }
                },
                complete:function(){
                  $('#addSermonBtn').html('Add Sermon');
                }
              })
            })

            $('#sermonAudioForm').submit(function (e){
                e.preventDefault();
                $.ajax({
                    url:'script/sermon-process2.php',
                    method:'post',
                    processData: false,
                    contentType:false,
                    cache:false,
                    data: new FormData(this),
                    beforeSend:function(){
                      $('#addSermonBtnAudio').html('<img src="'+gifroot+'">adding...');
                    },
                    success:function (response){
                        if (response==='success'){
                          $('#sermonAudioForm')[0].reset();
                          swal.fire({
                              icon:'success',
                              title:'Added',
                              text:'Sermon Added Successfully'
                          });
                          fetchSermonAud();

                        }else{
                            $('#showError2').html(response);
                        }
                    },
                    complete:function(){
                      $('#addSermonBtnAudio').html('Add Sermon');
                    }
                });
            });


            //publish
            $("body").on("click", ".publishSermonBtn", function(e){
                e.preventDefault();
                publishtext_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This sermon will be visible to the public",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, publish it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'script/sermon-process.php',
                            method: 'POST',
                            data: {publishtext_id: publishtext_id},
                            success:function(response){
                                Swal.fire(
                                    'Sermon  Published!',
                                    'Sermon Published Successfully!',
                                    'success'
                                )
                                fetchSermonText();

                            }
                        });

                    }
                });

            });

            // Unpublish
            $("body").on("click", ".UnpublishSermonBtn", function(e){
                e.preventDefault();
                unpublishtext_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This sermon will no longer be visible to the public",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, unpublish it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'script/sermon-process.php',
                            method: 'POST',
                            data: {unpublishtext_id: unpublishtext_id},
                            success:function(response){
                                Swal.fire(
                                    'Sermon  Unpublished!',
                                    'Sermon Unpublished Successfully!',
                                    'success'
                                )
                                fetchSermonText();

                            }
                        });

                    }
                });

            });


            $("body").on("click", ".publishSermonAudioBtn", function(e){
                e.preventDefault();
                publishaudio_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This sermon will be visible to the public",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, publish it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'script/sermon-process.php',
                            method: 'POST',
                            data: {publishaudio_id: publishaudio_id},
                            success:function(response){
                                Swal.fire(
                                    'Sermon  Published!',
                                    'Sermon Published Successfully!',
                                    'success'
                                )
                                fetchSermonAud();

                            }
                        });

                    }
                });

            });

              // Unpublish
            $("body").on("click", ".UnpublishSermonAudioBtn", function(e){
                e.preventDefault();
                unpublishaudio_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This sermon will no longer be visible to the public",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, unpublish it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'script/sermon-process.php',
                            method: 'POST',
                            data: {unpublishaudio_id: unpublishaudio_id},
                            success:function(response){
                                Swal.fire(
                                    'Sermon  Unpublished!',
                                    'Sermon Unpublished Successfully!',
                                    'success'
                                )
                                fetchSermonAud();

                            }
                        });

                    }
                });

            });

        })
    </script>
    <script type="text/javascript" src="scripts.js"></script>
    <script type="text/javascript" src="activity.js"></script>
    <script type="text/javascript" src="notify.js"></script>
