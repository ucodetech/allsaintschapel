<?php
require_once '../core/init.php';
if(isIsLoggedIn()){
    Redirect::to('member-dashboard');
}
require APPROOT . '/includes/headpanel1.php';

?>

<section class="login-block" style="font-size: 1.2rem">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->

                <form class="md-float-material form-material" id="loginForm" action="#" method="post">
                    <div class="text-center">
                        <img src="../img/chaps.jpeg" alt="chapel logo" class="img-fluid img-80 chapelLogo">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Member Login</h3>
                                    <hr class="invisible">
                                    <div class="container">
                                        <?php
                                            if (Session::exists('denied')){
                                                echo '
                                                    <div class="alert alert-danger alert-dismissible">
                                                    <button class="close" type="button" data-dismiss="alert">&times;</button>
                                                    <strong class="text-center">'.Session::flash('denied').'</strong>
                                                    </div>
                                                ';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="tel" name="username" id="username" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Username</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" id="password" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary d-">
                                        <label>
                                            <input type="checkbox" name="remember" id="remember">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="forgot-phone text-right f-right">
                                        <a href="#" class="text-right f-w-600" style="font-size: 1.2rem"> Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="button" id="loginBtn" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-10">
                                    Don't have an Account?&nbsp;<a href="member-register" class="text-info text-underline text-lg" style="font-size: 1.2rem">Register</a>
                                    <p class="text-inverse text-left m-b-0" id="showError"></p>
                                </div>
                                <div class="col-md-2">

                                    <img src="../img/chap.png" alt="small-logo.png" class="img-50">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
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
        $('#loginBtn').click(function (e){
            e.preventDefault();
            $.ajax({
                url:'script/login-process.php',
                method:'post',
                data:$('#loginForm').serialize()+'&action=login',
                beforeSend:function(){
                    $('#loginBtn').html('<span class="text-info"><img src="../gif/trans.gif" alt="loader">&nbsp;Please wait</span>');
                },
                success:function (response){
                    if ($.trim(response)==='success'){
                        $('#showError').html('<span class="text-success"><img src="../gif/tra.gif" alt="loader">&nbsp;Success:&nbsp;Redirecting...</span>');
                        setTimeout(function(){
                            window.location = 'member-dashboard';
                        },5000);
                    }else{
                        $('#showError').html(response);
                    }
                },
                complete:function(){
                    $('#loginBtn').html('Sign In');
                },
            })
        });
    })
</script>
