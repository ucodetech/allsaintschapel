<?php 
require_once '../core/init.php';
$com = new Comment();
$tut_id = $_POST['tut_id'];
    
    $result = $com->getComment($tut_id);
    echo $result;
?>
<style type="text/css">
  .on{
    padding-left: 10px;
  }
  .comment{
    margin: 0px;
    padding: 0px;
    text-align: justify;
    font-size: 16px;
  }
</style>