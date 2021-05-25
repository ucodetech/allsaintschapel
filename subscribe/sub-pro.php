<?php 
require_once '../core/init.php';
$user = new User();

if (isset($_POST['action']) && $_POST['action'] == 'sub') {
    $email = Show::test_input($_POST['sub-email']);

    $sub = $user->subNews($email);
    if ($sub) {
        echo 'true';
    }
}



if (isset($_POST['action']) && $_POST['action'] == 'cont_mail') {
    $name = Show::test_input($_POST['con-name']);
    $subject = Show::test_input($_POST['con-subject']);
    $email = Show::test_input($_POST['con-email']);
    $msg = Show::test_input($_POST['msg']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       echo Show::showMessage('danger', 'Invalid E-mail!', 'warning');
       return false;
    }

            $mail =  new PHPMailer\PHPMailer\PHPMailer();
               //SMTP settings
               $mail->isSMTP();
               $mail->Host = "smtp.gmail.com";
               $mail->SMTPAuth = true;
               $mail->Username = "ucodetech.wordpress@gmail.com";
               $mail->Password =  "echo@mike12@@";
               $mail->Port = 587; //587 for tls
               $mail->SMTPSecure = "tls";

               //email settings
               $mail->isHTML(true);
               $mail->setFrom('ucodetech.wordpress@gmail.com', 'UcodeTut');
               $mail->addAddress('ucodetech.wordpress@gmail.com');
               $mail->addReplyTo($_POST['con-email'], $_POST['con-name']);
               $mail->Subject = 'Form Submisson';
               $mail->Body = "
            <div style='width:80%; height:auto; padding:10px; margin:10px'>
        <p align='center'><img src='http://localhost/ucodeTuts/images/ucodeTut%20Logo.png' class='img-fluid' width='300' alt='Ucode Logo' align='center'>  </p>
        <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>$subject</p>
        <h3>Name : $name <br>Email : $email <br>Message :</h3>
        <p>$msg</p>
        <hr>
        <h4>UcodeTuts</h4>
        <p style='color: #fff; font-size:20px; text-align: center; text-transform: uppercase;'>
        <a href='http//uzbgraphix.com.ng' style='color:#fff;'>Offical Site</a></p> </div>
        ";
        try{
        $mail->send();
            echo Show::showMessage('success', 'Thank you! for contacting us, We\'ll get back to you soon!', 'check');
       
        } catch (\Exception $e) {
        echo Show::showMessage('danger', 'something went wrong', 'warning');
        }
    


    
}
