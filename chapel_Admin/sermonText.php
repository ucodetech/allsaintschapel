<form class="material" action="#" method="post" id="sermonTextForm">
  <div class="row mb-3">
    <div class="form-group col-md-6">
      <label for="sermonTitle">Sermon Title:<sup class="text-danger">*</sup>  </label>
      <input type="text" name="sermonTitle" id="sermonTitle" class="form-control form-control-success form-control-round form-control-bold">
    </div>
    <div class="form-group col-md-6">
      <label for="sermonAuthor">Sermon Author:<sup class="text-danger">*</sup>  </label>
      <input type="text" name="sermonAuthor" id="sermonAuthor" class="form-control form-control-success form-control-round form-control-bold">
    </div>
  </div>
  <div class="row mb-3">
    <div class="form-group col-md-6">
      <label for="datePreached">Sermon Date:<sup class="text-danger">*</sup>  </label>
      <input type="date" name="datePreached" id="datePreached" class="form-control form-control-success form-control-round form-control-bold">
    </div>

  </div>
  <div class="row mb-3">
    <div class="form-group col-md-12">
      <label for="message">Message:<sup class="text-danger">*</sup>  </label>
      <textarea name="sermon" id="sermon" rows="8" class="form-control"></textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-6 form-group">
      <button type="button" name="addSermonBtn" id="addSermonBtn" class="btn btn-outline-info"><i class="fa fa-plus-circle fa-lg"></i>&nbsp;Add Sermon </button>
    </div>
    <div class="col-6 form-group">
      <button type="reset" name="reset" id="reset" class="btn btn-outline-danger"><i class="fa fa-recycle fa-lg"></i>&nbsp;Reset Form</button>
    </div>
  </div>
  <hr class="inivisible">
  <div class="row">
    <div class="form-group" id="showError">

    </div>
  </div>
</form>
