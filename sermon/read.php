<?php
require_once '../core/init.php';
include APPROOT .'/includes/head.php';

$sermon = new Sermon();


//GEt id on url

  if (isset($_GET['p']) && !empty($_GET['p'])) {
    $readid = $_GET['p'];
    $readid = preg_replace('#[^0-9a-z_-]#i', '', $_GET['p']);
    $read = $sermon->fetchSermonSlug($readid);

  
}

?>

<div class="container-fluid">
    <div class="row mt-5 shadow-lg">
      <div class="col-lg-8">
        
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

<?php require APPROOT .'/includes/footer.php';?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.like', function(){
      like_id = '<?= $tut->id;?>';

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
      unlike_id =  '<?= $tut->id;?>';
      
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
     liked = '<?= $tut->id;?>';
    $.ajax({
    url: '../download-process.php',
    method: 'post',
    data: {liked: liked},
    success:function(response){
      $('#showBtn').html(response);
    }
  });
};

fetchLike();

  function fetchLike(){
  like_post_id = '<?= $tut->id ?>';
  $.ajax({
    url: '../download-process.php',
    method: 'post',
    data: {like_post_id: like_post_id},
    success:function(response){
      $('#countLikes').html(response);
    }
  });
};
    $('#commentBtn').click(function(e){
      if ($('#comment_form')[0].checkValidity()) {
         e.preventDefault();
          $('#commentBtn').val('Please Wait...');

          $.ajax({
            url: '../add_comment.php',
            method: 'post',
            data: $('#comment_form').serialize(),
            success:function(response){
              $('#commentBtn').val('Comment');
              $('#comment_form')[0].reset();
              $('#comment_message').html(response);
              load_comment();

            }
          });

      }
    });

    //fetch comment
     load_comment();

    function load_comment(){

      var tut_id = $('#tut_id').val();
        $.ajax({
        url: "../fetch_comment.php",
        method:"POST",
        data:{tut_id : tut_id},
        success: function(data){
          $('#display_comment').html(data);

        }
      });
      }

    $('body').on('click', '.reply', function(){
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#msg').focus();
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


  countDownload();

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


  //search box
  $('#search').keyup(function(){
    var searchText = $(this).val();
    if (searchText!= '') {
      alert(searchText);

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

//copmment 

  $(document).on('click', '.clike', function(){
      clike_id = $(this).attr('data-id');

       $.ajax({
        url: '../download-process.php',
        method: 'post',
        data: {clike_id: clike_id},
        success:function(response){
        load_comment();

        }
    });

    });

     $(document).on('click', '.cunlike', function(){
      cunlike_id =  $(this).attr('data-id');
      
       $.ajax({
        url: '../download-process.php',
        method: 'post',
        data: {cunlike_id: cunlike_id},
        success:function(response){
         load_comment();

        }
    });

    });

// showBtn();

//   function showBtn(){
//      liked = '<?= $tut->id;?>';
//     $.ajax({
//     url: '../download-process.php',
//     method: 'post',
//     data: {liked: liked},
//     success:function(response){
//       $('#showBtn').html(response);
//     }
//   });
// };

// fetchcLike();

//   function fetchcLike(){
//   like_postc = $(this).attr('data-id');
//   $.ajax({
//     url: '../download-process.php',
//     method: 'post',
//     data: {like_postc: like_postc},
//     success:function(response){
//       $('#commentcountLikes').html(response);
//     }
//   });
// };


  });
</script>
