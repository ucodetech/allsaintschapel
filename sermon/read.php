<?php
require_once '../core/init.php';
include APPROOT .'/includes/head.php';

$sermon = new Sermon();
$user = new User();

//GEt id on url

  if (isset($_GET['p']) && !empty($_GET['p'])) {
    $readid = $_GET['p'];
    $readid = preg_replace('#[^0-9a-z_-]#i', '', $_GET['p']);
    $read = $sermon->fetchSermonSlug($readid);

  
}

?>
<style>
  .profile{
    width: 200px
    height:200px;
    border-radius: 50%;
    border: 3px double green;
  }
   .profile2{
    width: 90% !important;
    height:200px;
    border-radius: 50%;
    border: 3px double green;
  }

  .author{
    border: 3px double green;
    padding: 3px;
    text-transform: capitalize;
  }
  .banner{
    width: 100%;
    height: 200px;
  }
  .title{

  color: #000;
  text-shadow: 
    1px 0px 1px #ccc, 0px 1px 1px #368, 
    2px 1px 1px #ccc, 1px 2px 1px #eee,
    3px 2px 1px #253, 2px 3px 1px #584,
    4px 3px 1px #ccc, 3px 4px 1px #210,
    5px 4px 1px #789, 4px 5px 1px #896,
    6px 5px 1px #ccc, 5px 6px 1px #eee,
    7px 6px 1px #896;  
  }
  .spacer{
    border: 5px double #256;
  }

</style>
<div class="container-fluid">
  <div class="spacer"></div>
  <a href="<?=URLROOT?>" class="btn btn-outline-secondary"><i class="fa fa-home fa-lg"></i>Return to Home</a>
    <div class="row mt-5">
      <div class="col-lg-8">
        <div class="card rounded-0 mb-5 shadow-lg">
          <div class="card-header rounded-0 py-1 text-center lead">
            <div class="card-block">
              <div class="container-fliud">
                <div class="row">
                  <div class="col-md-4">
                    
                   <div class="container-fluid p-3 profileHolder float-left ">
                      <?php if ($read->author == 'Rev. Dr. Fred Kerbem'): ?>
                      <img src="https://media-exp1.licdn.com/dms/image/C5603AQGPSa4ptYQBVg/profile-displayphoto-shrink_200_200/0/1570861135586?e=1622678400&v=beta&t=5CKbeINATNu__0E4SAGp8q__NNGv6cO8M7bMUaZpPWM" alt="Rev. Dr. Fred Kerbem" class="img-fluid profile">
                      <?php else: ?>
                     <img src="https://localhost/allsaintschapel/images/featured.png" alt="Rev. Dr. Fred Kerbem" class="img-fluid profile2">
                    <?php endif ?> <br>
                    <span class="text-center author">
                      <?=$read->author?>
                    </span>
                   </div>

                  </div>

                   <div class="col-md-8">
                   <div class="container-fluid p-3">
                     <img src="https://localhost/allsaintschapel/images/featured.png" alt="Rev. Dr. Fred Kerbem" class="img-fluid banner"> <hr class="invisible">
                     <h4 class="title p-2 bg-success text-light shadow-lg">
                       <?=strtoupper($read->title);?>
                     </h4>
                    
                   </div>
                   
                  </div>
                </div>
                 <p class="spacer"></p>
                 <div class="container-fluid shadow-lg p-2 message">
                   <p>
                     <?=$read->message;?>
                   </p>
                 </div>
                  <p class="spacer"></p>
                  <?php 
                      if (isLoggedInMember()) {
                        $valuename = $user->data()->full_name;
                        $vlaueemail = $user->data()->email;

                      }else{
                        $valuename = 'Anonymous User';
                        $vlaueemail = 'anonymousemail@gmail.com';

                      }
                   ?>

                 <div class="container-fluid text-left shadow-lg p-2 comment">
                  <button class="btn btn-info" id="toggleCommentBox" type="button" style="display: block;">Drop Your Comment</button> <hr class="invisible">
                  <form class="shadow-lg p-3" action="#" method="post" id="commentForm" style="display: none;">
                    <p class="text-center text-danger">
                      Note: If you are a member of the CHAPEL and  want your real name on the comment box then login. else leave the box as Anonymous user thanks! 
                    </p>
                    <input type="hidden" name="sermon_id" id="sermon_id" value="<?=$read->id?>">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="comment_sender_name">Full Name: <sup class="text-danger">*</sup></label>
                        <input type="disabled" name="comment_sender_name" id="comment_sender_name" class="form-control" value="<?=$valuename?>" readonly>
                      </div>
                        <div class="form-group col-md-6">
                        <label for="comment_sender_email">Email: <sup class="text-danger">*</sup></label>
                        <input type="disabled" name="comment_sender_email" id="comment_sender_email" class="form-control" value="<?=$vlaueemail?>" readonly>
                      </div>
                        <div class="form-group col-md-12">
                        <label for="comment">Comment: <sup class="text-danger">*</sup></label>
                        <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
                      </div>
                        <div class="form-group col-md-6">
                          <input type="hidden" name="comment_id" id="comment_id" value="0">
                       <button class="btn btn-primary btn-sm" id="commentBtn" type="button"><i class="fa fa-comment fa-lg"></i>&nbsp;Comment</button>
                      </div>
                    </div>
                  </form> <hr class="invisible">
                  <div id="display_comment"></div>

                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">

         <div class="card rounded-0 mb-5 shadow-lg">
        <div class="card-header rounded-0 py-1 text-center lead">Search</div>
        <div class="card-body">
          <form class="form pb-5" method="POST" action="#">
            <div class="input-group">
              <input type="text" id="search" name="search" class="form-control border-secondary rounded-5" placeholder="Search sermon">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary rounded-0" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
          <div class="list-group" id="show-list" style="postion:relative; margin-top:-28px;">
        </div>
      </div>
    </div>


        <!-- recent post -->
      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px; overflow:hidden" scrolling="no">
        <div class="card-header rounded-0 py-3 text-center lead">Recent Posts</div>
        <div class="card-body" id="recentPost">
           <p class="text-center align-self-center lead"><img src="<?php echo URLROOT; ?>gif/success.gif"> Please Wait...</p>
        </div>
      </div>
      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px; overflow:hidden" scrolling="no">
        <div class="card-header rounded-0 py-3 text-center lead">Recent Posts</div>
        <div class="card-body" id="f">
           <button class="btn btn-block btn-outline-secondary" type="button" id="printPdf"><i class="fa fa-print"></i>Print PDF</button>
        </div>
      </div>
       <div class="card rounded-0 mb-3 shadow-lg" style="width:410px; overflow:hidden" scrolling="no">
        <div class="card-header rounded-0 py-3 text-center lead">User</div>
        <div class="card-body" id="f">
          <?php if (isLoggedInMember()): ?>
            <p class="text-center"><?=$user->data()->full_name;?></p>
            <?php else: ?>
              <p>Do you have an account with us login</p>
           <button class="btn btn-block btn-outline-danger" type="button" id="loginBox" data-toggle="modal" data-target="#loginBoxModal">
            <i class="fas fa-sign-in"></i>Login</button>

          <?php endif ?>
          
        </div>
      </div>
      </div>

    </div>

</div>
<style>
  input[type="text"], input[type="email"], input[type="password"]{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid green !important;
  }
  input[type="text"]:hover, input[type="email"]:hover, input[type="password"]:hover{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid orangered !important;
  }
.form-control[disabled]{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid orangered !important;
}
.form-control[readonly]{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid orangered !important;
}
  textarea{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid green !important;
    overflow: fixed !important;
    resize: horizontal !important;

}
  }
  textarea:hover{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid orangered !important;

  }
  textarea:focus{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid green !important;
  }
  textarea:active{
    border:0 !important;
    background:none !important;
    border-bottom: 3px solid green !important;
  }
  #submit{
    background: none !important;
    color: green;
    border:none;
    border-bottom: 2px solid green;
  }
  #submit:hover{
    background: none !important;
    color: green;
    border:none;
    border-bottom: 2px solid orangered;
  }
  small{
    font-size: 12px;

  }

</style>

<?php 
include APPROOT .'/sermon/modalTem.php';
require APPROOT .'/includes/footer.php';
?>

<script type="text/javascript">
  $(document).ready(function(){

      // process register
        $('#loginStudentBtn').click(function (e){
            e.preventDefault();
            $.ajax({
                url:'../login-process.php',
                method:'post',
                data:$('#FormLogin').serialize()+'&action=login',
                beforeSend:function(){
                    $('#loginStudentBtn').html('<span class="text-info"><img src="../../gif/trans.gif" alt="loader">&nbsp;Please wait</span>');
                },
                success:function (response){
                    if ($.trim(response)==='success'){
                        location.reload();
                    }else{
                        $('#showError').html(response);
                    }
                },
                complete:function(){
                    $('#loginStudentBtn').html('Sign In');
                },
            })
        });



    $('#toggleCommentBox').click(function(){
      $('#commentForm').toggle();
    })

    $(document).on('click', '.like', function(){
      like_id = '<?= $read->id;?>';

       $.ajax({
        url: '../download-process.php',
        method: 'post',
        data: {like_id: like_id},
        success:function(response){
          showBtn();
          fetchLike();

        }
    });

    });

    $(document).on('click', '.unlike', function(){
      unlike_id =  '<?= $read->id;?>';
      
       $.ajax({
        url: '../download-process.php',
        method: 'post',
        data: {unlike_id: unlike_id},
        success:function(response){
          showBtn();
          fetchLike();


        }
    });

    });

showBtn();

  function showBtn(){
     liked = '<?= $read->id;?>';
    $.ajax({
    url: '../download-process.php',
    method: 'post',
    data: {liked: liked},
    success:function(response){
      $('#showBtn').html(response);
    }
  });
};

// fetchLike();

//   function fetchLike(){
//   like_post_id = '<?= $read->id ?>';
//   $.ajax({
//     url: '../download-process.php',
//     method: 'post',
//     data: {like_post_id: like_post_id},
//     success:function(response){
//       $('#countLikes').html(response);
//     }
//   });
// };
    $('#commentBtn').click(function(e){
         e.preventDefault();

          $.ajax({
            url: '../add_comment.php',
            method: 'post',
            data: $('#commentForm').serialize()+'&action=addComment',
            beforeSend:function(){
               $('#commentBtn').html('Please Wait...');
            },
            success:function(response){
              $('#commentForm')[0].reset();
              $('#display_comment').html(response);
              load_comment();
            },
             complete:function(){
               $('#commentBtn').html('<i class="fa fa-comment fa-lg"></i>Comment');
            },
          });

      
    });

    //fetch comment
     load_comment();

    function load_comment(){

      var sermon_id = $('#sermon_id').val();
        $.ajax({
        url: "../fetch_comment.php",
        method:"POST",
        data:{sermon_id : sermon_id},
        success: function(data){
          $('#display_comment').html(data);

        }
      });
      }

    $('body').on('click', '.reply', function(){
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment').focus();
    });




    getRecent();
    function getRecent(){
      $.ajax({
        url: '../../chapel_Admin/script/sermon-process.php',
        method: 'post',
        data: {action: 'recentPost'},
        success:function(response){
          console.log(response);
          $('#recentPost').html(response);
        }
      })

    }





  //search box
  $('#search').keyup(function(){
    var searchText = $(this).val();
    if (searchText!= '') {
      $.ajax({
        url: '../../search/search-process.php',
        method: 'post',
        data: {query:searchText},
        success:function(response){
          $('#show-list').html(response);
          console.log(searchText);
        }
      })
    }else{
      $('#show-list').html('');
    }
  });

  $(document).on('click', 'a', function(){
    $('#search').val($(this).text());
    $('#show-list').html('');
  });


       const modalUpdate = $('#cookieUpdateGetPost');
        const notNowBtn = $('#notNowBtn');

        $(notNowBtn).click(function(){
            $(modalUpdate).modal('hide');
            localStorage.setItem("getPostUpdateShowed", "true");
        });

        setTimeout(function(){
            if (!localStorage.getItem("getPostUpdateShowed")) {
                $(modalUpdate).modal('show');
            }

        }, 5000);



    hits();

    function hits(){
      var action = 'hits';
      $.ajax({
        url: '../../includes/hits.php',
        method: 'post',
        data: {action:action},
        success:function(data){ }
      });
    };

$('#subBtn').click(function(e){
      if($('#subscribe-form')[0].checkValidity()){
        e.preventDefault();
        $("#subBtn").val('Please Wailt..');
        if ($('#sub-email').val() == '') {
          $('#sub_Error').html('<span class="text-danger">Email is required</span>');
        }else{
          $("#subBtn").val('Subscribe');
          $.ajax({
            url: '../subscribe/sub-pro.php',
            method: 'post',
            data: $('#subscribe-form').serialize()+'&action=sub',
            success:function(response){
              if ($.trim(response) === 'true') {
                $('#subscribe-form')[0].reset();
                $('#subBtn').html('Subscribe');
                $('#sub_Error').html('');
              Swal.fire({
                title: 'You have subscribed successfully',
                type: 'success'
              });
            }else{
              $('#sub_Error').html(response);
            }

            }
          });
        }
      }
    });



  });
</script>
