<?php
    require_once '../core/init.php';
    require APPROOT . '/includes/head.php';

    $sermon = new Sermon();

    $getSermon = $sermon->fetchSermonFront();


?>

	<style>
		.banner{
			width:100%;
			height: 400px;
			padding: 0px;
			margin: 0px !important;
		}
		.card-img{

		}
		.hr{
			border: 6px double #36946e;
		}
	</style>
	
<div class="container">
	<header>
		<img src="../images/featured.png" class="img-fluid banner" alt="all saints chapel">
		<hr class="invisible">
		<a href="<?=URLROOT;?>" class="btn btn-outline-info"><i class="fa fa-home fa-lg"></i>Return to Home</a>
	</header>
		<div class="container shadow-lg">
			<h3 class="text-center">Sermons</h3><hr>
			<!-- Search widget start -->
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


			<?php if ($getSermon): ?>
				<div class="row">
			<?php foreach ($getSermon as $audio): ?>
				<div class="col-md-4">
					<div class="card mb-5">
						<div class="card-header">
						<img src="../images/featured.png" class="img-fluid card-img" alt="all saints chapel">
						<hr class="hr">
						</div>
						<div class="card-block p-2">
							<h5 class="text-justified  text-bold lead"><?=$audio->title?> By <span class="text-bold"><i><?=$audio->author?></i></span> </h5>
							<p class="detail">
								<span class="text-left">Date Posted:<?=pretty_dates($audio->datePosted)?></span> || 
								<span class="text-left">Date Preached: <?=pretty_dates($audio->dateOfSermon)?></span>

							</p>
							
						</div>
						<div class="card-footer">
							<a href="read/<?=$audio->slug_url?>" class="btn btn-block btn-primary" style="text-decoration: none; "><i>Read..</i></a>
						</div>
					</div>
				</div>
			<?php endforeach ?>

			</div>
				<?php else: ?>
					<h3 class="text-center text-dark">No Sermon yet</h3>
			<?php endif ?>
			

		</div>

</div>


<?php
require APPROOT . '/includes/footer.php';
?>

<script>
	$(document).ready(function(){


//search box
  $('#search').keyup(function(){
    var searchText = $(this).val();
    if (searchText!= '') {
      $.ajax({
        url: '../search/search-process.php',
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
  })
 

	})
</script>