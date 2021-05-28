<?php
    require_once '../core/init.php';
    require APPROOT . '/includes/head.php';
    $bulletin = new Bulletin();
if (isset($_GET['bull']) && !empty($_GET['bull'])){
    $detail = $_GET['bull'];
    $getDetail = $bulletin->getDetail('chapel_bullentin',$detail);
    if ($getDetail){
   ?>

<style media="screen">
  .my-container{
    padding:5px;
  }
  .hr{
    border: 1px solid #000;
  }
  .date{
    font-size: 15px;
  }
  .orderShow{
    border:2px solid #000;
    width: 50%;
    margin:10px auto;
    padding:5px;
    font-size: 18px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;

  }
  .conduct{
    font-size: 15px;
  }
</style>
<div class="container">
<div class="card">
<div class="card-header">
    <h5>Chapel Bulletin</h5>
</div>
<div class="card-block">
    <div class="row">
      <div class="col-md-4" style="border:2px solid #535; border-radius: 8px;">
        <div class="my-container">
          <h5 class="pl-6"><sup>From the</sup></h5>
            <h4 class="pl-6">Chaplain's Desk <span>image</span> </h4>
            <hr  class="hr">
            <p>
              <?=
                nl2br($getDetail->chaplainDesk);
               ?>
            </p>
        </div>
      </div>
      <div class="col-md-4" style="border:2px solid #535; border-radius: 8px;">
        <div class="my-container">
          <h5 class="text-bold text-uppercase text-center"><?=$getDetail->topic?></h5>
          <p class="text-center date"><?=pretty_nameDay($getDetail->dateOfService)?></p>
          <p class="text-center orderShow">Order of Service</p>
          <p class="text-center date">(<?=pretty_time1($getDetail->timeOfServiceStart) .' - '. pretty_time($getDetail->timeOfServiceEnd)?>)</p>
          <p class="text-center conduct"><i>Conducting Today:&nbsp;<?=$getDetail->conductor?></i> </p>
          <p class="text-left text-bold myList">
            <?=$getDetail->orderOfService?>
          </p>
        <hr class="hr">
          <h4 class="text-center text-bold text-underline">Special Notice</h4>
          <p class="text-left text-bold">
            <?=$getDetail->specialNotice;?>
          </p>
          <hr class="hr">
            <h4 class="text-center text-bold text-underline">Share your Story with Us</h4>
            <p class="text-justified text-bold">
              <?=$getDetail->shareStory;?>
            </p>
            <hr class="hr">
              <h4 class="text-center text-bold text-underline">Our Bank Account Details</h4>
              <p class="text-center text-bold">
                <?= nl2br('Bank: name Type: Savings
                A/c Name: All Saints Chapel; A/c No: 53668996'); ?>
              </p>
        </div>
      </div>
      <div class="col-md-4" style="border:2px solid #535; border-radius: 8px;">
        <div class="my-container">
            <h4 class="text-center text-underline">Bible Study Outline</h4>
            <p class="text-left">
              <?=$getDetail->biblStudyOutline;?>
            </p>
        </div>
      </div>
    </div>
    <hr class="invisible">
    <div class="row">
      <div class="col-md-6">
          <a href="#" class="btn btn-outline-info btn-block" target="_blank"><i class="fa fa-file fa-lg"></i>Generate PDF</a>
      </div>
      
    </div>
</div>
</div>
</div>

<?php 
	}
}
?>


<?php
require APPROOT . '/includes/footer.php';
?>
