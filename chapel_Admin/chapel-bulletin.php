<div class="container-fluid">
  <h2 class="text-center text-bold text-info"><i class="fa fa-plus fa-lg"></i>Add Bulletin</h2><hr>
<form class="material" action="#" method="post" id="addBulletinForm">
  <div class="row mb-3">
    <div class="form-group">
      <label for="title">Title of Service: <sup class="text-danger">*</sup> </label>
      <input type="text" name="title" id="title" class="form-control form-control-lg">
    </div>
  </div>
  <div class="row mb-3">
    <div class="form-group col-md-3">
      <label for="conductor">Conductor: <sup class="text-danger">*</sup> </label>
      <input type="text" name="conductor" id="conductor" class="form-control form-control-lg">
    </div>
    <div class="form-group col-md-3">
      <label for="dateOfService">Date of Service: <sup class="text-danger">*</sup> </label>
      <input type="date" name="dateOfService" id="dateOfService" class="form-control form-control-lg">
    </div>
    <div class="form-group col-md-3">
      <label for="timeOfSercviceStart">Time of Service (Start): <sup class="text-danger">*</sup> </label>
      <input type="time" name="timeOfSercviceStart" id="timeOfSercviceStart" class="form-control form-control-lg">
    </div>
    <div class="form-group col-md-3">
      <label for="timeOfSercviceEnd">Time of Service (End): <sup class="text-danger">*</sup> </label>
      <input type="time" name="timeOfSercviceEnd" id="timeOfSercviceEnd" class="form-control form-control-lg">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-12">
      <div class="form-group">
        <label for="chaplain_desk">Chaplain's Desk: <sup class="text-danger">*</sup> </label>
        <textarea name="chaplain_desk" id="chaplain_desk" class="form-control"></textarea>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="form-group">
        <label for="orderOfService">Order Of Service: <sup class="text-danger">*</sup> </label>
        <textarea name="orderOfService" id="orderOfService" class="form-control"></textarea>
      </div>
      <!-- special notice -->
      <div class="form-group">
        <label for="specialNotice">Special Notice: <sup class="text-danger">*</sup> </label>
        <textarea name="specialNotice" id="specialNotice" class="form-control">
          Have you experienced salvation, deliverance (from sin, curses,addictions,evil spirit etc.), healing,spiritaul growth.
        </textarea>
      </div>
      <!-- end of special notice -->
      <!-- share your story  -->
      <div class="form-group">
        <label for="shareYourStory">Share your story: <sup class="text-danger">*</sup> </label>
        <textarea name="shareYourStory" id="shareYourStory" class="form-control"></textarea>
      </div>
      <!-- end of share your story -->
    </div>
    <div class="col-lg-12">
      <div class="form-group">
        <label for="biblStudyOutline">Bible Study Outline: <sup class="text-danger">*</sup> </label>
        <textarea name="biblStudyOutline" id="biblStudyOutline" class="form-control"></textarea>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <button type="button" class="btn btn-success btn-block" id="addBulletinBtn">ADD BULLETIN</button> <hr class="invisible">
    <div class="form-group" id="showError">

    </div>
  </div>
</form>
</div>
