<?php
require_once '../core/init.php';
if (!isLoggedInMember()){
    Session::flash('denied', 'You need to login to access that page!');
    Redirect::to('member-login');
}
$user = new User();
$screen = new Counsel();
$checkscreenling = $screen->triggerForm('formName', 'electionScreeningFrom');

if($checkscreenling->switch != 1){
    Session::flash('warning', 'Screening  Form for Election is not open yet check back later!');
    Redirect::to('member-dashboard');
}else{
    if($screen->checkUser('screeningForm',$user->data()->id)){
        Session::flash('warning', 'You have already submitted your screening form!');
        Redirect::to('member-dashboard');
    }
}
require APPROOT . '/includes/headpanel1.php';
require APPROOT . '/includes/navpanel1.php';

$sur = explode(' ', $user->data()->full_name);
$surname = $sur[0];
$othernames = $sur[1];
if ($sur[2]){
    $lastname = $sur[2];
}
$othernames =   $othernames .'   ' . $lastname;
?>
<style>
    input[type='text'],input[type='tel'],input[type='email'],input[type='date']{
        border: none;
        border-bottom: 2px dotted #000;
        background:none;
    }
    input[type='text']:hover,input[type='tel']:hover,input[type='email']:hover,input[type='date']:hover{
        border: none;
        border-bottom: 2px dotted #000;
        background:none;
    }
    input[type='text']:active,input[type='tel']:active,input[type='email']:active,input[type='date']:active{
        border: none;
        border-bottom: 2px dotted #2bd225;
        background:none;
    }
    input[type='text']:focus ,input[type='tel']:focus,input[type='email']:focus,input[type='date']:focus{
        border: none;
        border-bottom: 2px dotted #000;
        background:none;
    }
    textarea{
        border: none;
        border-bottom: 2px dotted #000;
        background:none;
    }
    .signature{
        width:120px;
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
    .form-control[disabled],.form-control[readonly]{
        border: none;
        border-bottom: 2px dotted #000;
        background:none;
    }
</style>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Screening Form </h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-trash close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="col-lg-12 text-center">
                            <h2>ALL SAINTS CHAPEL</h2>
                            (<span class="text-uppercase text-center">Interdenominational</span>)
                            <h3>THE FEDERAL POLYTECHNIC, IDAH</h3>
                            <h6>_______NEW STUDENTS' EXCO ELECTION_______</h6>
                            <hr class="invisible">
                            <h3 class="text-underline">SCREENING FORM</h3>
                        </div>
                        <hr class="invisible">
                        <div class="col-lg-12">
                            <form action="#" id="screeningForm" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="form-group col-lg-4">
                                        <label for="surname">Surname: <sup class="text-danger">*</sup></label>
                                        <input type="disabled" name="surname" id="surname" class="form-control" value="<?=$surname?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="othernames">Other names: <sup class="text-danger">*</sup></label>
                                        <input type="disabled" name="othernames" id="othernames" class="form-control" value="<?=$othernames?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="phoneNo">Phone No <sup class="text-danger">*</sup>:</label>
                                        <input type="disabled" name="phoneNo" id="phoneNo" class="form-control"  value="<?=$user->data()->mobile?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-lg-6">
                                        <label for="dob">Date of Birth: <sup class="text-danger">*</sup></label>
                                        <input type="disabled" name="dob" id="dob" class="form-control" value="<?=$user->data()->Birthday?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-6 mb-4">
                                        <label for="maritalStatus">Marital Status: <sup class="text-danger">*</sup></label>
                                        <select name="maritalStatus" id="maritalStatus" class="form-control" readonly>
                                            <option value="">Select status</option>
                                            <?php
                                            $marital = array('single','married');
                                            foreach ($marital as $status){
                                                ?>
                                                <option value="<?=$status?>" <?=(($status == $user->data()->marital_status))?' selected' : ''?>><?=$status?></option>

                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-lg-4">
                                        <label for="department">Department:</label>
                                        <input type="disabled" name="department" id="department" class="form-control" value="<?=$user->data()->department?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="level">Level:</label>
                                        <input type="disabled" name="level" id="level" class="form-control" value="<?=$user->data()->level?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="cgpa">CGPA <sup class="text-danger">*</sup>:</label>
                                        <input type="text" name="cgpa" id="cgpa" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="bornAgain">Born Again: <sup class="text-danger">*</sup></label>
                                        <select name="bornAgain" id="bornAgain" class="form-control">
                                            <option value="">Select your decision</option>
                                            <?php
                                            $decision = array('yes','no');
                                            foreach ($decision as $decisioned){
                                                ?>
                                                <option value="<?=$decisioned?>"><?=strtoupper($decisioned)?></option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="bornAgainDate">If yes Date:</label>
                                            <input type="date" name="bornAgainDate" id="bornAgainDate" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="howItHappened">How did it happen: </label>
                                        <textarea name="howItHappened" id="howItHappened" cols="50" rows="5" class="form-control"></textarea>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-lg-4">
                                        <label for="homeChurch">Your Home Church: <sup class="text-danger">*</sup></label>
                                        <input type="text" name="homeChurch" id="homeChurch" class="form-control" value="<?=$user->data()->home_church;?>">
                                    </div>
                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="christianLeadership">Do you have any Christian Leadership Experience: <sup class="text-danger">*</sup></label>
                                        <select name="christianLeadership" id="christianLeadership" class="form-control">
                                            <option value="">Select your decision</option>
                                            <?php
                                            $leadership = array('yes','no');
                                            foreach ($leadership as $leader){
                                                ?>
                                                <option value="<?=$leader?>"><?=strtoupper($leader)?></option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="whereDid">If yes Where?:</label>
                                        <input type="text" name="whereDid" id="whereDid" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-lg-4">
                                        <label for="positionHeld">Position(S) held with date: <sup class="text-danger">*</sup></label>
                                        <input type="text" name="positionHeld" id="positionHeld"  class="form-control">

                                    </div>
                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="spiritualGift">Have you discovered your spiritual gift(s): <sup class="text-danger">*</sup></label>
                                        <select name="spiritualGift" id="spiritualGift" class="form-control">
                                            <option value="">Select your decision</option>
                                            <?php
                                            $gift = array('yes','no');
                                            foreach ($gift as $gifts){
                                                ?>
                                                <option value="<?=$gifts?>"><?=strtoupper($gifts)?></option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="brieflyDesribe">If yes briefly describe:</label>
                                        <input type="text" name="brieflyDesribe" id="brieflyDesribe" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">

                                        <label for="signatureFile">
                                            Signature: <br>
                                            <div class="imgDivs" id="showFileSignature">
                                                <img src="profile/<?=$user->data()->memberSignature;?>" class="img-fluid signature" alt="signature">
                                            </div>
                                            <input type="hidden" name="signature" id="signature" value="<?=$user->data()->memberSignature;?>">
                                        </label>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3"></div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <input type="hidden" name="user_id" id="user_id" value="<?=$user->data()->id;?>">
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-outline-success" id="screenBtn">Submit Form</button>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <a href="member-dashboard" class="btn btn-outline-danger" id="screenBtn">Cancel</a>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div id="showError"></div>
                                    </div>
                                </div>
                            </form>
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
require APPROOT . '/includes/footerpanel.php';
?>

<script>
    $(document).ready(function (){

        $('#screenBtn').click(function(e){
            e.preventDefault();
            $.ajax({
                url:'script/screen-process.php',
                method:'post',
                data:$('#screeningForm').serialize()+'&action=submitScreen',
                beforeSend:function (){
                    $('#screenBtn').html('<img src="../gif/trans.gif" alt="loader">&nbsp;please wait...');
                },
                success:function(response){
                    if (response==='success'){
                        $('#showError').html('<span class="text-success">Form submission was successful: Redirecting in 5secs</span>');
                        // setTimeout(function (){
                        //     window.location = 'member-dashboard';
                        // },5000);
                    }else{
                        $('#showError').html(response);
                    }

                },
                complete:function (){
                    $('#screenBtn').html('<img src="../gif/trans.gif" alt="loader">&nbsp;finishing up...');
                }
            })
        })
    })
</script>