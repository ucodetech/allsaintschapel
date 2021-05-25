<?php
require_once '../core/init.php';
require APPROOT .'/includes/head.php';

$post = new Post();
?>
<?php
    if (isset($_GET['down']) && !empty($_GET['down'])) {
      $id = $_GET['down'];

     
      $download = $post->getSourceScreen($id);

      if (isset($_POST['downLoad'])) {

        $filepath = '../uploads/'.$download->source_code;
      if (file_exists($filepath)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename=' . basename($filepath));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' .filesize('../uploads/'.$download->source_code));
           ob_clean();
            flush();
          readfile('../uploads/'.$download->source_code);
          $downloads = $download->source_downloads + 1;
          $post->UpdateDownloadSrc($downloads, $id);
          exit;
      }else{
       echo 'file doesnt exist';
      }

      }


    }
    ?>
         <div class="container-fluid">
          <div class="row h-100 align-items-center justify-content-center">
           <div class="col-lg-3 px-2 px-lg-3 mt-1">
             <div class="card rounded-10 mb-3 shadow-lg">
              <div class="card-header rounded-5 py-1 text-center lead">Back To Post</div>
              <div class="card-body">
                <button type="button" onclick="window.history.back();" class="btn  btn-info btn-block">Back To post page</button>
              </div>
            </div>
            <div class="card rounded-10 mb-3 shadow-lg">
              <div class="card-header rounded-5 py-1 text-center lead">Ads</div>
              <div class="card-body">
                Ads
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card rounded-10 mb-3 shadow-lg">
              <div class="card-header rounded-5 py-1 text-center lead">Download Source Code</div>
              <div class="card-body">
                <table class="table  table-borderd table-stripted">
                  <thead>
                    <tr>
                      <th>File Name</th>
                      <th>File Size</th>
                      <th>Downloads</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?= $download->source_code ;?></td>
                      <td><?= sizeFilter($download->source_size) ;?></td>
                      <td id="downloads"></td>
                      <td>
                        <form action="" method="post" >
                          <input type="hidden" value="<?= $download->id ;?>" id="cuSrc">
                          <button type="submit" name="downLoad" class="btn btn-sm btn-success"><i class="fa fa-download fa-lg"></i></button>
                        </form>

                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
          </div>
          </div>
          <div class="col-lg-3">
            <div class="card rounded-10 mb-3 shadow-lg">
              <div class="card-header rounded-5 py-1 text-center lead">Ads</div>
              <div class="card-body">
                Ads
              </div>
            </div>

            <div class="card rounded-10 mb-3 shadow-lg">
              <div class="card-header rounded-5 py-1 text-center lead">Ads</div>
              <div class="card-body">
                Ads
              </div>
            </div>
          </div>
      </div>
      </div>



 ?>
  <?php require APPROOT .'/includes/footer.php';?>

<script>
  countDownload();

  setInterval(function() {
    countDownload();
  }, 1000);

  function countDownload(){
    count_id = $('#cuSrc').val();
    $.ajax({
      url: '../download-process.php',
      method: 'post',
      data: {count_id: count_id},
      success:function(response){
        $('#downloads').html(response);
      }
    });
  }

  $(document).ready(function(){

  


  function goBack() {
    window.history.back()
  }

  })

</script>
