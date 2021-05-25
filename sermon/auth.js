//switch authentication
  $('#register-link').click(function(){
        $('#login-box').hide();
        $('#register-box').show();
      });
      $('#login-link').click(function(){
        $('#login-box').show();
        $('#register-box').hide();
      });
      $('#forgot-link').click(function(){
        $('#login-box').hide();
        $('#forgot-box').show();
      });
      $('#back-link').click(function(){
        $('#login-box').show();
        $('#forgot-box').hide();
      });

      //Register Ajax Request
      $('#register-btn').click(function(e){
          if ($('#register-form')[0].checkValidity()) {
            e.preventDefault();
            $("#register-btn").html('<img src="<?= URLROOT ?>users/images/tra.gif" /> Please Wailt..');
            $.ajax({
              url: URLROOT + 'users/action.php',
              method:'POST',
              data: $('#register-form').serialize()+'&action=register',
              success:function(response){
                $("#register-btn").html('Sign Up');
              // console.log(response);
              if ($.trim(response) === 'success' ) {
                $('#showLoginBox').modal('hide');
                $('#showLoginBox').modal('show');
              }else{
                  $('#regAlert').html(response);
              }

              }

                  });

          }
      });

  //Login Ajax Request
      $('#login-btn').click(function(e){
          if ($('#login-form')[0].checkValidity()) {
            e.preventDefault();

            $("#login-btn").html('<img src="<?= URLROOT ?>users/images/tra.gif" /> Please Wailt..');
           if ($('#Lemail').val() == '') {
                $('#error-message').fadeIn().html('* Email is Required!');
                setTimeout(function(){
                  $('#error-message').fadeOut('slow');
                }, 5000);
            }  else if ($('#Lpassword').val() == '') {
                $('#error-message').fadeIn().html('* Please enter password!');
                setTimeout(function(){
                  $('#error-message').fadeOut('slow');
                }, 5000);
            }else{
                  $('#error-message').text('');
                  $.ajax({
                    url: URLROOT +'users/action.php',
                    method:'POST',
                    data: $('#login-form').serialize()+'&action=login',
                    beforeSend: function(){},
                success:function(response){
                    $("#login-btn").html('Sign In');
                  if ($.trim(response) === 'success') {
                         window.location.href = '<?php $_SERVER['PHP_SELF'] ?>';
                  }else{
                      $('#logAlert').html(response);
                  }
                }

                  });
                }
          }
      });



      $('#reset-btn').click(function(e){
        if ($("#reset-form")[0].checkValidity()) {
          e.preventDefault();
          $("#reset-btn").html('<img src="<?= URLROOT ?>users/images/success.gif"> Please wait...');
          $.ajax({
            url: URLROOT + 'users/action.php',
            method: 'post',
            data: $("#reset-form").serialize()+'&action=forgot',
            success:function(response){
              $("#reset-btn").html('<img src="<?= URLROOT ?>users/images/success.gif"> Please wait...');
              $('#reset-form')[0].reset();
              $("#reset-btn").html('Reset Password');
              $("#forAlert").html(response);
            }
          });
        }
      });




function smile() {
  var a;
  a = document.getElementById("emoji");
  a.innerHTML = "&#xf118;";
  setTimeout(function () {
      a.innerHTML = "&#xf11a;";
    }, 1000);
  setTimeout(function () {
      a.innerHTML = "&#xf119;";
    }, 2000);
  setTimeout(function () {
      a.innerHTML = "&#xf11a;";
    }, 3000);
}
smile();
setInterval(smile, 4000);


function hourglass() {
  var a;
  a = document.getElementById("glass");
  a.innerHTML = "&#xf251;";
  setTimeout(function () {
      a.innerHTML = "&#xf252;";
    }, 1000);
  setTimeout(function () {
      a.innerHTML = "&#xf253;";
    }, 2000);
}
hourglass();
setInterval(hourglass, 3000);

