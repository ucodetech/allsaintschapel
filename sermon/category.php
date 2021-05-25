<?php
require_once '../core/init.php';
require APPROOT .'/includes/head.php';
require APPROOT .'/includes/tutnav.php';

  $catego = new Category();
  $athor = new Post();

//GEt id on url

  if (isset($_GET['cat']) && !empty($_GET['cat'])) {
    $virusid = $_GET['cat'];
    $virusid = Show::test_input($_GET['cat']);
    // $virusid = preg_replace('#[^0-9]#', '', $_GET['cat']);


      $count = $catego->getCategoryCount($virusid);
      $row = $catego->getCategory($virusid);


    if ($count < 1 ) {
        die('<div class="container">
            <h3 class="text-center text-white px-3">Opps <br>There is No post here! check back later!</h3>
          </div>');
    }else{
      $results = $catego->getTutCategory($row->id);
    }
  }

?>


  <div class="container-fluid">
    <div class="card rounded-0 mb-3 shadow-lg">
        <div class="card-header rounded-0 py-1 text-center lead">Search Terms</div>
        <div class="card-body">
          <form method="POST" action="#">
            <div class="input-group">
              <input type="text" id="search" name="search" class="form-control border-secondary rounded-0" placeholder="Search tutorial">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary rounded-0" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="list-group" id="show-list" style="postion:relative; margin-top:-28px;">
        </div>
      </div>
    <?php

      if ($results) {
        ?>
      <div class="row">


        <?php foreach ($results as $grateful):
            $author = $athor->getAuthor($grateful->author);
          ?>

            <div class="col-lg-4 m-1">
             <div class="container-fluid" style="height:10px; background:green"></div>
              <header class="bg-dark text-light py-3">
                <div class="container">
                  <div class="row">

                    <div class="col-lg-12">
                      <div class="row">

                        <div class="col-lg-12">
                            <h4 class="text-light lead m-0 px-1 text-center">
                                <?= $grateful->tut_title; ?>
                            </h4>
                            <hr>
                            <div class="container text-secondary text-center">
                                <span class="noti lead"><i class="fa fa-calendar fa-lg"></i>Created <?= timeAgo($grateful->date_created); ?>| </span>
                                <span class="noti lead"><i class="fa fa-calendar fa-lg"></i>Updated <?= timeAgo($grateful->date_updated); ?>| </span>
                                <span class="noti lead"><i class="fas fa-user-cog fa-lg"></i>Created By <?= $author->super_name; ?></span>
                            </div>
                            <hr>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="mt-2 align-self-center">
                 <img width="100%" height="215" src="<?= URLROOT; ?>uploads/featuredImage/<?= $grateful->featured_image; ?> " class=" img-fluid border-0" alt="Featured image">

                  </div>
                  <div class="container mt-2 px-3">
                      <p class="text-secondary lead align-justify">
                         <?= wrap3($grateful->tut_description); ?> <a href="<?=URLROOT?>tutorial/post/<?= $grateful->slug_url ?>" class="text-light btn btn-xs btn-primary"><i  class="fa fa-book"> </i> &nbsp;Read more ...</a>
                      </p>
                  </div>


              </header>
                 </div>


        <?php endforeach ?>


        </div>
        <?
      }else{
          ?>
          <div class="container">
            <h3 class="text-center text-secondary px-3">Opps <br>There is No post here! check back later!</h3>
          </div>
          <?
      }
     ?>

  </div>

<?php require APPROOT .'/includes/footer.php';?>
<script type="text/javascript">
  $(document).ready(function(){
    getNav();
    function getNav(){
      $.ajax({
        url: '../../ucode-warhead/virus/nav-process.php',
        method: 'post',
        data: {action: 'NavLinks'},
        success:function(response){
          $('#navCate').html(response);
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
        }
      })
    }else{
      $('#show-list').html('');
    }
  });

  $(document).on('click', 'a', function(){
    $('#search').val($(this).text());
    $('#show-list').html('');
  })

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


  });
</script>
