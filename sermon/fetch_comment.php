<?php 
require_once '../core/init.php';
$com = new Comment();

$sermon_id = $_POST['sermon_id'];
    
    $result = $com->getComment($sermon_id);
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