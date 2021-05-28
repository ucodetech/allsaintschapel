<?php 
require_once '../core/init.php';

   $com = new Comment();
   $show = new Show();

   if (isset($_POST['action']) && $_POST['action'] == 'addComment') {
    $error = '';
    $comment_sender_name = $show->test_input($_POST['comment_sender_name']);
    $comment_sender_email = $show->test_input($_POST['comment_sender_email']);
    $comment = $show->test_input($_POST['comment']);
  
     if (empty($_POST['comment'])) {
       $error .= $show->showMessage('danger','Please write your comment!', 'warning');
    }
    $sermon_id = $_POST['sermon_id'];
    $parent = $_POST['comment_id'];

   if ($error == '') {
      try {
        $com->sendComment(array(
          'parent_comment_id' => $parent,
          'comment' => $comment,
          'comment_sender_name' => $comment_sender_name,
          'sermon_id' => $sermon_id,
          'comment_sender_email' => $comment_sender_email
        ));
     echo '<span class="text-success text-sm"><i class="fa fa-check fa-lg"></i></span>';

      } catch (Exception $e) {
        echo $show->showMessage('danger','something went wrong!', 'warning');
        return false;
      }
   }else{
        echo $error;
   }
    

  
    
}