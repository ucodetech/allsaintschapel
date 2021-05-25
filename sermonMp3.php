<?php
    require_once 'core/init.php';
    require APPROOT . '/includes/head.php';

    $sermon = new Sermon();
    // $db = Database::getInstance();
    // $sql = "SELECT * FROM sermonAudioFormat";
    // $audioFile = $db->query($sql);

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
		.buttons{
			
		}
		.details span{
			display: block;
			padding:3px;


		}
	</style>

	<div class="container-fluid">
		<header>
			<img src="images/featured.png" class="img-fluid banner" alt="all saints chapel">
			<hr class="invisible">
			<a href="<?=URLROOT;?>" class="btn btn-outline-info"><i class="fa fa-home fa-lg"></i>Return to Home</a>
		</header>
		<div class="container mt-5 shadow-lg">
			<div class="row mb-2">
				<?php 
					$audioFile = $sermon->getAudio();
					foreach ($audioFile as $audio) {
						?>
							<div class="col-lg-12 audioContainer shadow-lg">
					<div class="row p-3">
						<div class="col-md-4 details">
							<span class="text-left">Author: <?=$audio->author?></span>
							<span class="text-left">Sermon Date:  <?=$audio->dateOfSErmon?></span>
							<span class="text-left">Date Posted:  <?=$audio->datePosted?></span>
							<?php if ($audio->dateUpdated == ' '): ?>
							<span class="text-left">No update<span>

								<?php else: ?>
								<span class="text-left">Date Updated: <?=$audio->dateUpdated?><span>
							<?php endif ?>

							<p class="text-justified">Dscription: <?=$audio->description?></p>

						</div>
						<div class="col-md-4 playerTitleLink">
							<h3 class="text-center"> <?=$audio->title?></h3>
							<hr>
							<p>
								<audio controls>
									<source src=""></source>
								</audio>
							</p>
						</div>
						<div class="col-md-4 buttons">
							<button class="btn btn-sm  btn-outline-primary"><i class="fas fa-cloud-download-alt"></i></button>&nbsp;
							<button class="btn btn-sm  btn-outline-info"><i class="fas fa-share-alt"></i></button>&nbsp;
							<button class="btn btn-sm btn-outline-warning"><i class="fa fa-thumbs-up  fa-lg"></i></button>


						</div>
					</div>
				</div>
						<?
					}

				 ?>
			
			</div>
		</div>
	</div>





<?php
require APPROOT . '/includes/footer.php';
?>
