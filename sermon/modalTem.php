
           <div class="modal fade" id="loginBoxModal">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-secondary">
                    <h4 class="modal-title text-light"><i class="fa fa-sign-in fa-lg"></i>&nbsp; Login</h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body text-primary">
       <div class="row align-items-center justify-content-center " id="loginBoxhide">
        <div class="col-lg-5">
          <?php 
              if(Session::exists('denied')){
              echo '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">
                            &times;
                            </button>
                            <strong class="text-center">'. Session::flash('denied') .'</strong>
                            </div>';
                        }
                    ?>
          <div id="showError" class="px-3">
          </div>
        </div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">
          <div class="card border-info shadow-lg">
            <div class="card-header ug-primary">
              <h3 class="m-0 text-dark">
                <i class="fas fa-sign-in-alt"></i>&nbsp;Sign In
              </h3>
            </div>
            <div class="card-body text-dark">
             <form action="#" method="post" id="FormLogin" class="px-3 my-auto">
              <div class="form-group">
              <label for="username">Username.<sup class="text-danger">*</sup></label>
              <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Enter your Username">
            </div>
            <div class="form-group">
              <label for="password">Password<sup class="text-danger">*</sup></label>
              <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter Password">
            </div>
          <div class="form-group">
           <div class="custom-control custom-checkbox float-left">
             <input type="checkbox" name="remember" id="customCheck"  class="custom-control-input"/>
             <label for="customCheck" class="custom-control-label">Remember me</label>
           </div>
           <div class="forget float-right">
             <a href="#" id="forgot-link" data-target="forgetModal" data-toggle="modal">Forgot Password?</a>
           </div>
         </div>         
         <div class="clearfix"> </div>
          <div class="form-group">
            <hr class="invisible">
              <button type="submit" name="loginStudentBtn" id="loginStudentBtn" class="btn  btn-success">Login</button>
           
           </div><hr>
            <div class="form-group">
              Don't have account?<a href="../../chapel_Members/member-login">&nbsp;Register</a>
            </div>

        
        </form>
            </div>
          </div>
        </div>
      </div>

                  </div>
                </div>


              </div>
            </div>