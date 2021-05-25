<?php
    require_once 'core/init.php';
    require APPROOT . '/includes/head.php';

    $sermon = new Sermon();
    $download = new Download();

?>
	<style>
		.banner{
			width:100%;
			height: 400px;
			padding: 0px;
			margin: 0px !important;
		}
		.audioContainer{

		}
		.playerTitleLink{

		}
		.buttons form{
			display: inline !important;
		}
		.details span{
			display: block;
			padding:3px;


		}
		audio{ 
		  border: 2px double #78ed93;
		  border-radius: 30px;
		}
	</style>
	<?php 
	

	 ?>

	<div class="container">
		<header>
			<img src="images/featured.png" class="img-fluid banner" alt="all saints chapel">
			<hr class="invisible">
			<a href="<?=URLROOT;?>" class="btn btn-outline-info"><i class="fa fa-home fa-lg"></i>Return to Home</a>
		</header>
		<div class="container mt-5 shadow-lg">
			<div class="row mb-3">
				<?php 
				      $output = $sermon->getAudio();

						echo $output;
				 ?>
			
			</div>
		</div>
	</div>





<?php
require APPROOT . '/includes/footer.php';
?>

<script>
	$(document).ready(function(){
		$('body').on('click', '#downloadAudio', function(e){
			e.preventDefault();
			download_id = $(this).attr('au-id');		
			$.ajax({
				url:'frontlock/lock.php',
				method:'post',
				data:{download_id:download_id},
				success:function(response){}
			});
		});




	})
</script>