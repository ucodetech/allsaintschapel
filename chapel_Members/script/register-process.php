<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once  '../../core/init.php';
$member = new User();
$validate = new Validate();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'register'){
    if (Input::exists()){
        $validation = $validate->check($_POST, array(

            'fullName' => array(
                'required' => true,
                'min' => 5,
                'max' => 255
            ),
            'mobile' => array(
                'required' => true,
                'min' => 11,
                'max' => 15,
                'unique' => 'members'
            ),
            'email' => array(
                'required' => true,
                'unique' => 'members'
            ),
            'gender' => array(
                'required' => true
            ),
            'school' => array(
                'required' => true
            ),
            'username' => array(
              'required' => true,
              'min' => 5,
              'max' => 20 ,
              'unique' => 'members'
            ),
            'department' => array(
                'required' => true
            ),
            'level' => array(
                'required' => true
            ),
            'homeChurch' => array(
                'required' => true
            ),
            'birthday' => array(
              'required' => true
            ),
            'password' => array(
                'required' => true,
                'min' => 10,
                'max' => 150

            ),
            'confirmPassword' => array(
                'required' => true,
                'matches' => 'password'
            ),
        ));
        if ($validation->passed()){
            if (!filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL)){
                echo $show->showMessage('danger', 'Invalid Email address!', 'warning');
                return false;
            }
            $default = 'default.png';
            $defaultSign = 'defaultSign.png';
            $password = Input::get('password');
            $newPassword = password_hash($password, PASSWORD_DEFAULT);

            try {
                $member->create(array(
                    'full_name' => Input::get('fullName'),
                    'Gender' => Input::get('gender'),
                    'Birthday' => Input::get('birthday'),
                    'home_church' => Input::get('homeChurch'),
                    'mobile' => Input::get('mobile'),
                    'email' => Input::get('email'),
                    'passport' => $default,
                    'password' => $newPassword,
                    'department' => Input::get('department'),
                    'level' => Input::get('level'),
                    'school' => Input::get('school'),
                    'username' => Input::get('username'),
                    'memberSignature' => $defaultSign
                ));
                $randNo = rand(1000, 9999);
                $token = md5(microtime(uniqid()));
                $url =  'https://localhost/allsaintschapel/chapel_Member/verify_email.php?token='.$token;

                $email = Input::get('email');
                $fullname = Input::get('fullName');



                //Load Composer's autoloader
                require APPROOT . '/vendor/autoload.php';

                //mail function
                $mail = new PHPMailer(true);



                try {
               //SMTP settings
//              $mail->SMTPDebug = 3;
              $mail->isSMTP();
              $mail->Host = "smtp.gmail.com";
              $mail->SMTPAuth = true;
              $mail->Username = EMAIL;
              $mail->Password =  PASSWORD;
              $mail->SMTPSecure = "tls";
              $mail->Port = 587; // for tls

               //email settings
               $mail->isHTML(true);
               $mail->setFrom("ucodetut@gmail.com",  "All Saints Chapel.");
               $mail->addAddress($email);
            //   $mail->addReplyTo("noreply@ucodetuts.com.ng");
               $mail->Subject = "Welcome to All Saints Chapel";
               $mail->Body = "
            <div style='width:80%; height:auto; padding:10px; margin:10px'>

           <p style='color: #000; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'> Welcome All Saints Chapel. </p>
        <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>Hi!&nbsp;&nbsp; $fullname<br>
            You have successfully registered as a member of the chapel. you are highly welcome, may the Good God bless you Amen
        </p>
        <p style='color:red;'>Note: You are been monitored so please becareful what you do here!</p>
        <p>
        	You are adviced to  verify your email address by clicking the link below: <br>
        	<a href='$url'>$url</a>
        </p>

         </div>

        ";
        if($mail->send())
             echo 'success';

        } catch (\Exception $e) {

        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }




        }catch( Exception $e){
            echo $show->showMessage('danger', $e->getMessage(), 'warning');
            echo $show->showMessage('danger', $e->getLine(), 'warning');
            echo $show->showMessage('danger', $e->getCode(), 'warning');
            return false;

        }


        }else{
            foreach($validation->errors() as $error){
                echo $show->showMessage('danger', $error, 'warning');
                return false;
            }
        }
    }
}


