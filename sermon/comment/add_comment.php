<?php 
require_once '../../core/init.php';




if (isset($_POST['action']) && $_POST['action'] == 'add_comment') {
    
$comment_name = $warhead->test_input($_POST['comment_sender_name']);
$commet_email = $warhead->test_input($_POST['comment_sender_email']);
$tut_id = $warhead->test_input($_POST['tut_id']);
$comment = $warhead->test_input($_POST['comment_content']);

print_r($_POST);
    

}