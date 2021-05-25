<!-- Modal -->
<style>
    input[type='text'],input[type='email'],input[type='tel'],input[type='date']{
        border: 0;
        background:none;
        border-radius:0;
        border-bottom: 2px solid rgba(97,26,26,0.7);
    }
    input[type='text']:hover,input[type='email']:hover,input[type='tel']:hover,input[type='date']:hover{
        border: 0;
        background:none;
        border-radius:0;
        border-bottom: 2px solid rgba(97,26,26,0.7);
    }
    input[type='text']:focus,input[type='email']:focus,input[type='tel']:focus,input[type='date']:focus{
        border: 0;
        background:none;
        border-radius:0;
        border-bottom: 2px solid rgba(97,26,26,0.7);
    }
    input[type='text']:active,input[type='email']:active,input[type='tel']:active,input[type='date']:active{
        border: 0;
        background:none;
        border-radius:0;
        border-bottom: 2px solid rgba(97,26,26,0.7);
    }
    .signature{
        width:120px;
        height:60px;
    }
    .fa-cloud-upload-alt{
        font-size:2.5rem;
        cursor: pointer;
    }
    .imgDivs{
        cursor:pointer;
    }
    .btn{
        border-radius:20px;
    }
</style>
<div  style="color: rgba(97,26,26,0.7);"  class="modal fade" id="visitorModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">VISITOR'S SLIP</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="container">
                    <h3 class="text-center">
                        ALL SAINTS CHAPEL <br>
                        (Interdenominational)<br>
                        THE FEDERAL POLYTECHNIC IDAH
                    </h3>
                    <h5 class="text-center"><u>VISITOR'S SLIP</u></h5>
                </div>
                <hr>
                <div class="container">
                    <form action="" method="post" id="visitorForm" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="form-inline col-sm-8">
                                <label for="fullname">
                                    Full Name: <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" name="fullname" id="fullname" class="form-control-input">

                            </div>
                            <div class="form-inline col-md-4">
                                <label for="gender">
                                   Gender: <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" name="gender" id="gender" class="form-control-input">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-inline col-sm-4">
                                <label for="department">
                                   Department:
                                </label>
                                <input type="text" name="department" id="department" class="form-control-input">

                            </div>
                            <div class="form-inline col-sm-4">
                                <label for="level">
                                    Level:
                                </label>
                                <input type="text" name="level" id="level" class="form-control-input">

                            </div>
                            <div class="form-inline col-md-4">
                                <label for="gender">
                                    E-mail:
                                </label>
                                <input type="text" name="email" id="email" class="form-control-input">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-inline col-sm-12">
                                <label for="fullname">
                                    Residential Address: <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" name="address" id="address" class="form-control-input">

                            </div>
                            <div class="form-inline col-md-12">
                                <label for="comment">
                                   General Comments about the Service: <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" name="comment" id="comment" class="form-control-input">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-inline col-md-12">
                                <label for="phoneNo">
                                    Phone No: <sup class="text-danger">*</sup>
                                </label>
                                <input type="tel" name="phoneNo" id="phoneNo" class="form-control-input">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-inline col-sm-12">
                                <label for="invited_by">
                                    Who invited you to the service:
                                </label>
                                <input type="text" name="invited_by" id="invited_by" class="form-control-input">

                            </div>
                            <div class="form-inline col-sm-12">
                                <label for="prayerRequest">
                                    Prayer Request:
                                </label>
                                <input type="text" name="prayerRequest" id="prayerRequest" class="form-control-input">

                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label for="become_member">
                                   Would you like to be a member: <sup class="text-danger">*</sup>
                                </label>
                                <select name="become_member" id="become_member" class="form-control">
                                    <option value="">Select Answer</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-6">
                                <div class="imgDivs" id="showFileSignature">
                                    Signature Preview
                                </div>
                                <br>
                                <input type="file" name="signatureFile" id="signatureFile" style="display: none;">
                                <label for="signatureFile"><i class="fa fa-cloud-upload-alt fa-lg text-info"></i> &nbsp;Select Signature</label>
                            </div>
                        </div>
                        <hr class="invisible">
                        <div class="row mb-3">

                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary btn-block" id="visitorBtn">Submit</button>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="reset" class="btn btn-danger btn-block" id="visitorBtn">Clear Form</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div id="showError"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close Form</button>
            </div>
        </div>
    </div>
</div>
