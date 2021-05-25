<div class="container-fluid">
  <h2 class="text-center text-bold text-info"><i class="fa fa-edit fa-lg"></i>Edit Bulletin</h2><hr>
<form class="material" action="#" method="post" id="editBulletinForm">
  <div class="row mb-3">
    <div class="form-group col-md-12">
      <label for="title">Title of Service: <sup class="text-danger">*</sup> </label>
      <input type="text" name="title" id="title" class="form-control form-control-lg" value="<?=$edit->topic?>">
    </div>
  </div>
  <div class="row mb-3">
    <div class="form-group col-md-3">
      <label for="conductor">Conductor: <sup class="text-danger">*</sup> </label>
      <input type="text" name="conductor" id="conductor" class="form-control form-control-lg" value="<?=$edit->conductor?>">
    </div>
    <div class="form-group col-md-3">
      <label for="dateOfService">Date of Service: <sup class="text-danger">*</sup> </label>
      <input type="date" name="dateOfService" id="dateOfService" class="form-control form-control-lg" value="<?=$edit->dateOfService?>">
    </div>
    <div class="form-group col-md-3">
      <label for="timeOfServiceStart">Time of Service (Start): <sup class="text-danger">*</sup> </label>
      <input type="time" name="timeOfServiceStart" id="timeOfServiceStart" class="form-control form-control-lg" value="<?=$edit->timeOfServiceStart?>">
    </div>
    <div class="form-group col-md-3">
      <label for="timeOfServiceEnd">Time of Service (End): <sup class="text-danger">*</sup> </label>
      <input type="time" name="timeOfServiceEnd" id="timeOfServiceEnd" class="form-control form-control-lg" value="<?=$edit->timeOfServiceEnd?>">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-12">
      <div class="form-group">
        <label for="chaplain_desk">Chaplain's Desk: <sup class="text-danger">*</sup> </label>
        <textarea name="chaplain_desk" id="chaplain_desk" class="form-control"><?=$edit->chaplainDesk?></textarea>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="form-group">
        <label for="orderOfService">Order Of Service: <sup class="text-danger">*</sup> </label>
        <textarea name="orderOfService" id="orderOfService" class="form-control"><?=$edit->orderOfService?></textarea>
      </div>
      <!-- special notice -->
      <div class="form-group">
        <label for="specialNotice">Special Notice: <sup class="text-danger">*</sup> </label>
        <textarea name="specialNotice" id="specialNotice" class="form-control"><?=$edit->specialNotice?></textarea>
      </div>
      <!-- end of special notice -->
      <!-- share your story  -->
      <div class="form-group">
        <label for="shareYourStory">Share your story: <sup class="text-danger">*</sup> </label>
        <textarea name="shareYourStory" id="shareYourStory" class="form-control"><?=$edit->shareStory?></textarea>
      </div>
      <!-- end of share your story -->
    </div>
    <div class="col-lg-12">
      <div class="form-group">
        <label for="biblStudyOutline">Bible Study Outline: <sup class="text-danger">*</sup> </label>
        <textarea name="biblStudyOutline" id="biblStudyOutline" class="form-control"><?=$edit->biblStudyOutline?></textarea>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <input type="hidden" name="edit_id" id="edit_id" value="<?=$edit_id?>">
    <button type="button" class="btn btn-success btn-block" id="editBulletinBtn">EDIT BULLETIN</button> <hr class="invisible">

    <div class="form-group col-lg-12" id="showError">

    </div>
  </div>
</form>
</div>
