<div class="container-fluid">
  <h2 class="text-center text-bold text-info"><i class="fa fa-plus fa-lg"></i>Add Bulletin</h2><hr>
<form class="material" action="#" method="post" id="addBulletinForm">
 
  <div class="row mb-3">
    <div class="form-group col-md-3">
      <label for="dateOfService">Date of Service: <sup class="text-danger">*</sup> </label>
      <input type="date" name="dateOfService" id="dateOfService" class="form-control form-control-lg">
  </div>
</div>
  <div class="row mb-3">
   <div class="form-group col-md-6">
      <label for="front_file"><i class="fa fa-cloud-upload fa-lg text-info"></i>&nbsp; Front</label>
      <input type="file" name="front_file" id="front_file" class="form-control" style="display: none">
      <br>
      <span id="showFront"></span>
    </div>
     <div class="form-group col-md-6">
      <label for="back_file"><i class="fa fa-cloud-upload fa-lg text-info"></i>&nbsp; Back</label>
      <input type="file" name="back_file" id="back_file" class="form-control" style="display: none">
      <span id="showBack"></span>
    </div>
  </div>
  <div class="row mb-3">
    <button type="button" class="btn btn-success btn-block" id="addBulletinBtn">ADD BULLETIN</button> <hr class="invisible">
    <div class="form-group" id="showError">

    </div>
  </div>
</form>
</div>
