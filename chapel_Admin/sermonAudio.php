<form class="material" action="#" method="post" id="sermonAudioForm">
  <div class="row mb-3">
    <div class="form-group col-md-6">
      <label for="sermon_title">Sermon Title:<sup class="text-danger">*</sup>  </label>
      <input type="text" name="sermon_title" id="sermon_title" class="form-control form-control-success form-control-round form-control-bold">
    </div>
    <div class="form-group col-md-6">
      <label for="sermon_author">Sermon Author:<sup class="text-danger">*</sup>  </label>
      <input type="text" name="sermon_author" id="sermon_author" class="form-control form-control-success form-control-round form-control-bold">
    </div>
  </div>
  <div class="row mb-3">
    <div class="form-group col-md-6">
      <label for="date_preached">Sermon Date:<sup class="text-danger">*</sup>  </label>
      <input type="date" name="date_preached" id="date_preached" class="form-control form-control-success form-control-round form-control-bold">
    </div>

  </div>
  <div class="row mb-3">
    <div class="form-group col-md-12">
      <label for="description">Description:<sup class="text-danger">*</sup>  </label>
      <textarea name="description" id="description" rows="8" class="form-control"></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <div class="form-group col-md-6">
      <label for="sermon_audio">Sermon Audio:<sup class="text-danger">*</sup>  </label>
      <input type="file" name="sermon_audio" id="sermon_audio" class="form-control form-control-success form-control-round form-control-bold">
    </div>
    <div class="form-group col-md-6" >
      <label for="">Preview Audio file before upload</label>
      <div class="container"  id="previewAudio">

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6 form-group">
      <button type="submit" name="addSermonBtnAudio" id="addSermonBtnAudio" class="btn btn-outline-info"><i class="fa fa-plus-circle fa-lg"></i>&nbsp;Add Sermon </button>
    </div>
    <div class="col-6 form-group">
      <input type="reset"  class="btn btn-outline-danger" value="Reset Form">
    </div>
  </div>
  <hr class="inivisible">
  <div class="row">
    <div class="form-group" id="showError2">

    </div>
  </div>
</form>
