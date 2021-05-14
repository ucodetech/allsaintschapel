<?php
require_once '../core/init.php';
if (!isLoggedInMember()){
    Session::flash('warning', 'You need to login to access that page!');
    Redirect::to('member-login');
}
$user = new User();
$general = new General();
$fileupload = new FileUpload();

require APPROOT . '/includes/headpanel1.php';
require APPROOT . '/includes/navpanel1.php';

?>
<style>
    input[type="text"],input[type="email"],input[type="tel"],input[type="date"]{
        border:none;
        background: none;
        border-bottom:3px dotted #000;
        font-size: 1.2rem;
    }
    input[type="text"]:hover,input[type="email"]:hover,input[type="tel"]:hover,input[type="date"]:hover{
        border:none;
        background: none;
        border-bottom:3px dotted #000;

    }
    input[type="text"]:active,input[type="email"]:active,input[type="tel"]:active,input[type="date"]:active{
        border:none;
        background: none;
        border-bottom:3px dotted #000;

    }
    input[type="text"]:focus,input[type="email"]:focus,input[type="tel"]:focus,input[type="date"]:focus{
        border:none;
        background: none;
        border-bottom:3px dotted #000;

    }
    .form-control[readonly]{
        background: none;
    }

    textarea{
        border:none;
        background: none;
        border:3px dotted #000;
    }
    select{
        border:none;
        background: none;
        border-bottom:3px dotted #000;
    }
    .passport{
        width:150px;
        height:160px;
        border:2px solid #000;
    }
    .signature{
        width:80px;
        height:50px;
    }
    .fa-cloud-upload{
        font-size:2.5rem;
        cursor: pointer;
    }
    .imgDiv,  .imgDivs{
        cursor:pointer;
    }
    .btn{
        border-radius:20px;
    }
</style>

<div class="pcoded-inner-content" style="font-size: 1.0rem">
<!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">

                <div class="container-fluid">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Membership Registration Form</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form action="#" id="profileUpdateForm" method="post"  enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <div id="showError" class="text-danger" style="font-size: 1.2rem;">Note: update your passport and signature first before updating the membership form!</div>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <label for="profileFile">
                                                <div class="imgDiv" id="showFile">
                                                    <img src="profile/<?=$user->data()->passport;?>" class="img-fluid passport" alt="passport">
                                                </div>
                                                </label><br>
                                                <?php if($user->data()->passport == 'default.png'):?>
                                                <input type="file" name="profileFile" id="profileFile" style="display: none;">
<!--                                                    <hr class="invisible">-->
                                                <label for="profileFile"><i class="fa fa-cloud-upload fa-lg text-info"></i> &nbsp;Select File</label>
                                               &nbsp;<br><button type="submit" class="btn btn-sm btn-info" id="updateProfile">Update</button>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <hr>
                                    </form>
                                    <form class="form" id="formUpdate" action="#" method="post">

                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <label class="float-label">Full Name</label>
                                                <input type="text" class="form-control" name="fullName" id="fullName" value="<?=$user->data()->full_name;?>" readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="float-label">Gender</label>
                                                <input type="text" class="form-control"  name="gender" id="gender" value="<?=$user->data()->Gender;?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="float-label">Marital Status</label><br>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">Select Marital Status</option>
                                                    <?php
                                                    $required = array('single','in_courtship','married','divorced' );
                                                    ?>
                                                    <?php foreach($required as $status): ?>
                                                        <option value="<?=$status?>"<?=(($status == $user->data()->marital_status))?' selected':''?>><?=strtoupper($status)?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">Phone No</label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?=$user->data()->mobile;?>" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">E-Mail</label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?=$user->data()->email;?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="float-label">Department(if FPI Staff/Student)</label>
                                                <input type="text" class="form-control" name="department" id="department" value="<?=$user->data()->department;?>" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">Level</label>
                                                <input type="text" class="form-control"  name="level" id="level" value="<?=$user->data()->level;?>" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">School</label>
                                                <input type="text" class="form-control"  name="school" id="school" value="<?=$user->data()->school;?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="float-label">Residential Address(Hostel/Lodge for student)</label>
                                                <input type="text" name="address" id="address"  class="form-control" value="<?=$user->data()->Residence;?>"/>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="float-label">Permanent Home Address</label>
                                                <input type="text" name="p_address" id="p_address"  class="form-control" value="<?=$user->data()->Residence;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="float-label">State of Origin</label>
                                                    <select name="state" id="state" class="form-control">
                                                        <?php
                                                        $getState = $general->getState();
                                                        ?>
                                                        <option value="">Select State of Origin</option>

                                                        <?php foreach($getState as $state): ?>
                                                            <option value="<?=$state->state?>" <?=(($state->state == $user->data()->state))?' selected':''?>><?=strtoupper($state->state)?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            <div class="col-sm-6">
                                                <label class="float-label">LGA</label>
                                                <select name="lga" id="lga" class="form-control">
                                                    <?php
                                                    $getLga = $general->getLGA();
                                                    ?>
                                                    <option value="">Select State of Origin</option>

                                                    <?php foreach($getLga as $lga): ?>
                                                        <option value="<?=$lga->lga?>" <?=(($lga->lga == $user->data()->lga))?' selected':''?>><?=strtoupper($lga->lga)?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="float-label">Date of Birth</label>
                                                <input type="text" class="form-control" name="birthday" id="birthday" value="<?=$user->data()->Birthday;?>" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">Date of New Birth</label>
                                                <input type="date" class="form-control" name="dateOfNewBirth" id="dateOfNewBirth" value="<?=$user->data()->date_new_birth;?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">Date of Water Baptism</label>
                                                <input type="date" class="form-control" name="dateOfBaptism" id="dateOfBaptism" value="<?=$user->data()->dateOfBaptism;?>">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                    <label class="float-label">Have you experience the Baptism of Holy Spirit</label><br>
                                                    <select name="baptism_holy" id="baptism_holy" class="form-control">
                                                        <option value="">Select one of the option</option>
                                                        <?php
                                                        $hp = array('yes','no');
                                                        ?>
                                                        <?php foreach($hp as $answer): ?>
                                                            <option value="<?=$answer?>" <?=(($answer == $user->data()->baptism_holy))?' selected':''?>><?=strtoupper($answer)?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">Spiritual Gift</label>
                                                <select name="spiritual_gift" id="spiritual_gift" class="form-control">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $gift = array(
                                                            'prophecy',
                                                        'service',
                                                        'teaching',
                                                        'exhorting',
                                                        'giving',
                                                        'leadership',
                                                        'mercy/helps',
                                                        'word of wisdom',
                                                        'word of knowledge',
                                                        'discerning of spirits',
                                                        'gift of faith',
                                                        'gifts of healing',
                                                        'working of miracles',
                                                        'kinds of tongues',
                                                        'interpretation of tongues'
                                                    );
                                                    ?>
                                                    <?php foreach($gift as $thick): ?>
                                                        <option value="<?=$thick?>" <?=(($thick == $user->data()->spiritual_gift))?' selected':''?>><?=strtoupper($thick)?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="float-label">Home Church Denomination</label>
                                                <input type="text" class="form-control" name="homeChurch" id="homeChurch" value="<?=$user->data()->home_church;?>" readonly>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="float-label">Position Held in your Church</label>
                                                <input type="text" class="form-control" name="position" id="position" value="<?=$user->data()->position;?>">
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="float-label">Choose Chapel Group(Type the unit you want and separate  by comma if you are choosing two)</label>
                                                <input type="text" class="form-control" name="ChapelUnit" id="ChapelUnit" value="<?=$user->data()->ChapelUnit;?>">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="">Not more than two</label>
                                                <div class="row m-t-25 text-left">
                                                    <?php
                                                        $getUnit = $general->getUnit();
                                                    ?>
                                                    <?php foreach($getUnit as $units): ?>
                                                    <div class="col-sm-4">
                                                        <div class="checkbox-fade fade-in-primary">
                                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                <label class="text-inverse" for="ChapelUnit"><?=$units->unit?></label>

                                                        </div>
                                                    </div>
                                                    <?php  endforeach; ?>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button class="btn btn-lg btn-block btn-primary" id="updateFormBtn" type="button">Update Membership Form</button>
                                        </div>
                                    </form>
                                    <hr class="invisible">
                                    <!--    update signature-->
                                    <form action="" id="signatureUpdateForm" method="post"  enctype="multipart/form-data">
                                        <div class="form-group row">

                                            <div class="col-sm-3 text-center">
                                                <label for="signatureFile">
                                                    <div class="imgDivs" id="showFileSignature">
                                                        <img src="profile/<?=$user->data()->memberSignature;?>" class="img-fluid signature" alt="signature">
                                                    </div>
                                                </label>
                                                <?php if($user->data()->memberSignature == 'defaultSign.png'):?>
                                                <input type="file" name="signatureFile" id="signatureFile" style="display: none;">
                                                <!--<hr class="invisible">-->
                                                <label for="updateSignature"><i class="fa fa-cloud-upload fa-lg text-info"></i> &nbsp;Select Signature</label>
                                                &nbsp;<br><button type="submit" class="btn btn-sm btn-info rounded-10" id="updateSignature">Update</button>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-3">
                                                <span class="text-dark">Date:&nbsp;<?=pretty_dates($user->data()->signatureDate);?></span>
                                            </div>

                                        </div>
                                        <hr>
                                    </form>
                                    <hr class="invisible">
                                    <div id="showError2"></div>
                                </div>
                            </div>
                        </div>

                </div>

            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
</div>
</div>




<?php
require APPROOT . '/includes/footerpanel1.php';
?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#showFile').html('<img src="'+e.target.result+'" alt="passport" class="img-fluid passport">');
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#profileFile").change(function() {
        readURL(this);
    });

    function readURLSign(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#showFileSignature').html('<img src="'+e.target.result+'" alt="signature" class="img-fluid signature">');
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }


    $("#signatureFile").change(function() {
        readURLSign(this);
    });

    $(document).ready(function(){

        $('#profileUpdateForm').submit(function (e){
            e.preventDefault();
            $.ajax({
                url:'script/upload-process.php',
                method:'post',
                processData: false,
                contentType:false,
                cache:false,
                data: new FormData(this),
                success:function (response){
                    if (response==='success'){
                        $('#showError').html('<span class="text-success text-center">Passport Updated! Page will reload in 2secs</span>');
                        setTimeout(function (){
                            location.reload();
                        },2000);
                    }else{
                        $('#showError').html(response);
                    }
                }
            })
        });

        $('#signatureUpdateForm').submit(function (e){
            e.preventDefault();
            $.ajax({
                url:'script/upload-process2.php',
                method:'post',
                processData: false,
                contentType:false,
                cache:false,
                data: new FormData(this),
                success:function (response){
                    if (response==='success'){
                        $('#showError2').html('<span class="text-success text-center">Signature Updated! Page will reload in 2secs</span>');
                        setTimeout(function (){
                            location.reload();
                        },2000);
                    }else{
                        $('#showError2').html(response);
                    }
                }
            });
        });

        $('#updateFormBtn').click(function(e){
            e.preventDefault();
            $.ajax({
                url:'script/update-process.php',
                method:'post',
                data:$('#formUpdate').serialize()+'&action=update_details',
                beforeSend:function(){
                    $('#updateFormBtn').html('<span class="text-light"><img src="../gif/trans.gif" alt="loader">&nbsp;Please wait</span>');
                },
                success:function (response){
                    if($.trim(response)==='success'){
                        $('#showError2').html('<div id="" class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert"> &times;</button><i class="fa fa-check fa-lg"></i>&nbsp;<span>You have successfully completed your membership form! page will reload in 3secs</span></div>');
                        setTimeout(function(){
                            location.reload();
                        },3000);
                    }else{
                        $('#showError2').html(response);
                    }
                },
                complete:function(){
                    $('#updateFormBtn').html('Update Complete');
                }
            });
        });

    })
</script>

