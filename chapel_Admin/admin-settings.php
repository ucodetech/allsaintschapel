<?php
require_once '../core/init.php';
if (!isIsLoggedIn()){
    Session::flash('warning', 'You need to login to access that page!');
    Redirect::to('admin-login');
}
$admin = new Admin();
$adminEmail = $admin->getAdminEmail();


// if (isOTPset($adminEmail)) {
//   Redirect::to('otp-verify');
// }

require APPROOT . '/includes/headpanel.php';
require APPROOT . '/includes/navpanel.php';

    if (hasPermissionSuper()) {
     $type = 'text';
     $readonly = '';
    }elseif(hasPermissionChaplain()){
      $type = 'text';
      $readonly = '';
    }elseif(hasPermissionEditor()){
     $type = 'disabled';
     $readonly = 'readonly';
    }
?>
<style>
    .passport{
        width:150px;
        height:160px;
        border:2px solid #000;
        border-radius: 50%;
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
	.adminImg{
		border: 4px double navy;
		border-radius: 60%;
		width: 250px;
		height: 250px;

	}
	.adminImgs{
		border: 4px double navy;
		border-radius: 60%;
		width: 150px;
		height: 150px;

	}
	label:hover{
		cursor: pointer;
	}
</style>
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
        <div class="row">
        	<div class="col-lg-8 shadow-lg p-4">
        		<span class="text-center text-lg"><?=strtok($admin->data()->sudo_full_name,'')?> Details</span><hr>
        		<div class="row">
        			<div class="form-group col-lg-6">
        				<label for="sudo_full_name">Full Name</label>
        				<input type="<?=$type?>" name="sudo_full_name" id="sudo_full_name" value="<?=$admin->data()->sudo_full_name?>" class="form-control form-control-lg" <?=$readonly?>>
        			</div>

        			<div class="form-group col-lg-6">
        				<label for="sudo_username">Username</label>
        				<input type="<?=$type?>" name="sudo_username" id="sudo_username" value="<?=$admin->data()->sudo_username?>" class="form-control form-control-lg" <?=$readonly?>>
        			</div>
        			<div class="form-group col-lg-6">
        				<label for="sudo_email">Email</label>
        				<input type="email" name="sudo_email" id="sudo_email" value="<?=$admin->data()->sudo_email?>" class="form-control form-control-lg">
        			</div>
        			<div class="form-group col-lg-6">
        				<label for="sudo_phoneNo">Phone No</label>
        				<input type="tel" name="sudo_phoneNo" id="sudo_phoneNo" value="<?=$admin->data()->sudo_phoneNo?>" class="form-control form-control-lg">
        			</div>
        			<div class="form-group col-lg-6">
        				<label for="sudo_permission">Permission</label>
        				<input type="<?=$type?>" name="sudo_permission" id="sudo_permission" value="<?=$admin->data()->sudo_permission?>" class="form-control form-control-lg" <?=$readonly?>>
        			</div>
        			<div class="form-group col-lg-12">
						<span id="message2"></span>

        			</div>
        		</div>
        	</div>
        	<div class="col-lg-4 shadow-lg">
        		<span class="text-center">Profile Pic</span><hr>
        		<center>
        			<div id="profileShow">
        				<label for="profile_file">

        						<img src="<?=URLROOT?>chapel_Admin/profile/<?=$admin->data()->passport?>" alt="<?=$admin->data()->sudo_full_name;?>" class="img-fluid adminImg">

        			</label>
        			</div>
        		 <br>
        			Fullname: <?=$admin->data()->sudo_full_name;?>
        		<hr>
        		<form action="#" id="profileForm" enctype="multipart/form-data">
        			<div class="form-group">
        				<label for="profile_file"><i class="fa fa-cloud-upload fa-lg text-info"></i>&nbsp; Update Profile</label>
        				<input type="file" name="profile_file" id="profile_file" class="form-control" style="display: none">
        			</div>
        			<input type="submit" class="btn btn-info btn-xs" value="update">
        		</form>
        		</center> <hr class="invisible">
        		<span id="message"></span>
        	</div>
        </div>
        <p class="text-center lead mt-5"><i class="fa fa-password fa-lg"></i>Change Password</p>
        <div class="row shadow-lg">
        	<div class="col-lg-6 shadow-lg">
        		<form action="#" id="changePasswordForm" method="post">
        			<div class="form-group col-lg-12">
        				<label for="currentPwd">Current password: <sup class="text-danger">*</sup> </label>
        				<input type="password" name="currentPwd" id="currentPwd" class="form-control" placeholder="Current Password">
        			</div>
        			<div class="form-group col-lg-12">
        				<label for="newPwd">New password: <sup class="text-danger">*</sup> </label>
        				<input type="password" name="newPwd" id="newPwd" class="form-control" placeholder="New Password">
        			</div>
        			<div class="form-group col-lg-12">
        				<label for="retypeNewPwd">Retype New password: <sup class="text-danger">*</sup> </label>
        				<input type="password" name="retypeNewPwd" id="retypeNewPwd" class="form-control" placeholder="Retype New Password">
        			</div>
        			<div class="form-group col-lg-12" id="errors"></div>
        			   <hr class="invisible">

        			<div class="form-group">
        				<button type="submit" id="changeBtn" class="btn btn-info btn-block">Change Password</button>
        			</div>
        			<hr class="invisible">
        		</form>
        	</div>
          <!--
          <div class="col-lg-4">
            <div class="card border-primary">
            <img src="../gif/cga.png" alt="change password" width="408">
          </div>
          </div> -->
        	<div class="col-lg-6 shadow-lg">
        		<span class="text-center">Signature</span><hr>
        		<center>
        			<div id="profileShowSign">
        				<label for="signature_file">
        					<?php if ($admin->data()->signature != ''): ?>
        						<img src="<?=URLROOT?>chapel_Admin/signatures/<?=$admin->data()->signature?>" alt="signature" class="img-fluid adminImg">
        						<?php else: ?>
        							<img src="<?=URLROOT?>chapel_Admin/signatures/defaultSignature.png" alt="<?=$admin->data()->sudo_full_name;?>" class="img-fluid adminImgs">
        					<?php endif ?>

        			</label>
        			</div>

        		<hr>
        		<form action="#" id="signatureForm" enctype="multipart/form-data">
        			<div class="form-group">
        				<label for="signature_file"><i class="fa fa-cloud-upload fa-lg text-info"></i>&nbsp; Update Signature</label>
        				<input type="file" name="signature_file" id="signature_file" class="form-control" style="display: none">
        			</div>
        			<input type="submit" class="btn btn-info btn-xs" value="update Signature">
        		</form>
        		</center> <hr class="invisible">
        		<span id="messageSignature"></span>
        	</div>

        </div>
      </div>
      <!-- Page-body end -->
  </div>
  <div id="styleSelector"> </div>
</div>
</div>
<!--    council selection modal-->


<?php
require APPROOT . '/includes/footerpanel.php';
?>
<script>

  function readURL(input){

    if (input.files && input.files[0]) {
       var reader = new FileReader();
      reader.onload = function(e){
        $('#profileShow').html('<img src="'+e.target.result+'" alt="profile pic" class="img-fluid adminImg">');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

 function getURL(input){

      if (input.files && input.files[0]) {
         var reader = new FileReader();
        reader.onload = function(e){
          $('#profileShowSign').html('<img src="'+e.target.result+'" alt="signature pic" class="img-fluid adminImg">');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

	$(document).ready(function(){
		$('#profile_file').change(function(){
			readURL(this);
    });

	$('#signature_file').change(function(){
			getURL(this);
    });

    $('#profileForm').submit(function(e){
    	e.preventDefault();
		$.ajax({
	        url: "script/setting-process.php",
	        method: "post",
	        processData: false,
	        contentType: false,
	        cache: false,
	        // data: {file: $("#profile_file").val()},
	        data: new FormData(this),
	        success: function(response) {
	        	// console.log(response);
            if($.trim(response)==="success") {
                $('#message').html('<span class="text-success">You have updated your profile pic successfully!</span>');
            }else{
            	$('#message').html(response);
            }
	       }


		});

    })


    $('#signatureForm').submit(function(e){
    	e.preventDefault();
		$.ajax({
	        url: "script/setting-process.php",
	        method: "post",
	        processData:false,
	        contentType:false,
	        cache: false,
	        // data: {file: $("#profile_file").val()},
	        data: new FormData(this),
	        success: function(response) {
	        	// console.log(response);
            if($.trim(response)==="success") {
                $('#messageSignature').html('<span class="text-success">You have updated your signature successfully!</span>');
            }else{
            	$('#messageSignature').html(response);
            }
	       }


		});

    })

//update users

	$('#sudo_phoneNo').change(function(e){
		e.preventDefault();
		sudo_phoneNo = $('#sudo_phoneNo').val();
		$.ajax({
			url:'script/setting-process2.php',
			method:'post',
			data:{sudo_phoneNo:sudo_phoneNo},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+sudo_phoneNo+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})


	$('#sudo_email').change(function(e){
		e.preventDefault();
		sudo_email = $('#sudo_email').val();
		$.ajax({
			url:'script/setting-process2.php',
			method:'post',
			data:{sudo_email:sudo_email},
			success:function(response){
				console.log(response);
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+sudo_email+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})


	$('#sudo_full_name').change(function(e){
		e.preventDefault();
		sudo_full_name = $('#sudo_full_name').val();
		$.ajax({
			url:'script/setting-process2.php',
			method:'post',
			data:{sudo_full_name:sudo_full_name},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+sudo_full_name+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})


	$('#sudo_username').change(function(e){
		e.preventDefault();
		sudo_username = $('#sudo_username').val();
		$.ajax({
			url:'script/setting-process2.php',
			method:'post',
			data:{sudo_username:sudo_username},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+sudo_username+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})

	$('#sudo_permission').change(function(e){
		e.preventDefault();
		sudo_permission = $('#sudo_permission').val();
		$.ajax({
			url:'script/setting-process2.php',
			method:'post',
			data:{sudo_permission:sudo_permission},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#message2').html('<span class="text-success">'+sudo_permission+': Updated Successfully!</span>')
				}else{
					$('#message2').html(response);
				}
			}
		});
	})

	$('#changeBtn').click(function(e){
		e.preventDefault();

		$.ajax({
			url:'script/setting-process2',
			method:'post',
			data:$('#changePasswordForm').serialize()+'&action=change_password',
			success:function(response){
                if ($.trim(response)==='changed') {
                    $('#changePasswordForm')[0].reset();
                    $('#errors').html('<span class="text-success">You have changed your password! please you need to relog in!</span>');
                   setTimeout(function(){
                         location.reload();
                   },5000);
                }else{
                    $('#errors').html(response);
                }
				
			}
		})

	})



	})
</script>

<script type="text/javascript" src="notify.js"></script>
<!-- <script type="text/javascript" src="update.js"></script>
 -->
