<?php
require_once '../core/init.php';
if(isIsLoggedIn()){
    Redirect::to('member-dashboard');
}
require APPROOT . '/includes/headpanel1.php';
$general = new General();
?>


<section class="login-block" style="font-size: 1.2rem">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" id="memberForm" action="#" method="post">
                    <div class="text-center">
                        <img src="../img/chaps.jpeg" alt="chapel logo" class="img-fluid img-80 chapelLogo">

                    </div>
                    <div class="auth-box card shadow-lg">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Become a Member</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" name="fullName" id="fullName" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Full Name</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" name="username" id="username" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Chose a username</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="tel" name="mobile" id="mobile" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Phone No</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" name="email" id="email" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Email Address</label>
                            </div>
                            <?php
                            $gender = '';
                            $getGender = array('male','female');

                            ?>
                            <div class="form-group form-primary">
                                <select name="gender" id="gender" class="form-control">
                                    <option value=""<?=(($gender == ''))?' selected':'';?>>Select Gender</option>
                                    <?php foreach($getGender as $gen): ;?>
                                        <option value="<?=$gen?>"<?=(($gender == $gen))?' selected':'';?>><?=$gen?></option>

                                    <?php endforeach;?>>
                                </select>
                                <span class="form-bar"></span>
                            </div>
                                <?php
                                $school = '';
                                $getSchool = $general->getSchool();

                                ?>
                                <div class="form-group form-primary">
                                    <select name="school" id="school" class="form-control">
                                        <option value=""<?=(($school == ''))?' selected':'';?>>Select School</option>
                                        <?php foreach($getSchool as $sch): ;?>
                                            <option value="<?=$sch->school?>"<?=(($school == $sch->school))?' selected':'';?>><?=$sch->school?></option>

                                        <?php endforeach;?>>
                                    </select>
                                    <span class="form-bar"></span>
                                </div>


                                <?php
                                $department = '';
                                $getdepartment = $general->getDepartment();

                                ?>
                                <div class="form-group form-primary">
                                    <select name="department" id="department" class="form-control">
                                        <option value=""<?=(($department == ''))?' selected':'';?>>Select Department</option>
                                        <?php foreach($getdepartment as $depart): ;?>
                                            <option value="<?=$depart->department_name?>"<?=(($department == $depart->department_name))?' selected':'';?>><?=$depart->department_name?></option>

                                        <?php endforeach;?>>
                                    </select>
                                    <span class="form-bar"></span>
                                </div>


                                <?php
                                $level = '';
                                $getLevel = array('nd1', 'nd2','hnd1', 'hnd2');


                                ?>
                                <div class="form-group form-primary">
                                    <select name="level" id="level" class="form-control">
                                        <option value=""<?=(($level == ''))?' selected':'';?>>Select Level</option>
                                        <?php foreach($getLevel as $lev): ;?>
                                            <option value="<?=$lev?>"<?=(($level == $lev))?' selected':'';?>><?=strtoupper($lev)?></option>

                                        <?php endforeach;?>>
                                    </select>
                                    <span class="form-bar"></span>
                                </div>


                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input type="text" name="homeChurch" id="homeChurch" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Home Church</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input type="date" name="birthday" id="birthday" class="form-control" >
                                        <span class="form-bar"></span>
                                        <label class="float-label">Date of Birth</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" id="password" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Confirm Password</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" id="registerBtn"><i class="fa fa-user-plus fa-lg"></i>Register</button>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-10">
                                    Already have an Account?&nbsp;<a href="member-login" class="text-info text-underline" style="font-size: 1.2rem">Login</a>
                                    <p class="text-inverse text-left m-b-0" id="showError"></p>

                                </div>
                                <div class="col-md-2">
                                    <img src="../img/chap.png" alt="All saints Chapel" class="img-50">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>


<?php
require APPROOT . '/includes/footerpanel1.php';
?>

<script>
    $(document).ready(function(){

        // process register
        $('#registerBtn').click(function (e){
            e.preventDefault();
            $.ajax({
                url:'script/register-process.php',
                method:'post',
                data:$('#memberForm').serialize()+'&action=register',
                beforeSend:function(){
                    $('#registerBtn').html('<span class="text-danger"><img src="../gif/tra.gif" alt="loader">&nbsp;Please wait...</span>');
                },
                success:function(response){
                    if ($.trim(response)==='success'){
                        $('#showError').html('<span class="text-success"><img src="../gif/tra.gif" alt="loader">&nbsp;Success:&nbsp;Redirecting...</span>');
                        setTimeout(function(){
                            window.location = 'member-login.php';
                        },3000);
                    }else{
                        $('#showError').html(response);
                    }
                },
                complete:function(){
                    $('#registerBtn').html('<span class="text-success"><img src="../gif/trans.gif" alt="loader">&nbsp;Done</span>');

                }
            })
        });
    })
</script>