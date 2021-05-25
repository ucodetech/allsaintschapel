<?php 
require_once '../core/init.php';

   $com = new Comment();


   $error = '';
    $comment_sender_name = Show::test_input($_POST['comment_sender_name']);
    $comment_sender_email = Show::test_input($_POST['comment_sender_email']);
    $comment = Show::test_input($_POST['msg']);
  
     if (empty($_POST['msg'])) {
       $error .= '<span class="text-danger text-sm">Comment  must not be empty!</span>';
    }
    $tut_id = $_POST['tut_id'];
    $parent = $_POST['comment_id'];

   if ($error == '') {
      try {
        $com->sendComment(array(
          'parent_comment_id' => $parent,
          'comment' => $comment,
          'comment_sender_name' => $comment_sender_name,
          'tut_id' => $tut_id,
          'comment_sender_email' => $comment_sender_email
        ));
     echo '<span class="text-success text-sm"><i class="fa fa-check fa-lg"></i></span>';

      } catch (Exception $e) {
        echo Show::showMessage('danger','something went wrong!', 'warning');
        return false;
      }
   }else{
        echo $error;
   }
    

  
    
