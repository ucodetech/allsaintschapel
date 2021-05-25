<?php 
require_once '../core/init.php';
$sermon = new Sermon();

if (isset($_POST['query'])) {
    $inputText = strtolower($_POST['query']);

    $data = $sermon->searchSermon($inputText);
 
    if ($data) {
        foreach ($data as $row) {
         echo '<a href="'.URLROOT.'sermon/read/'.$row->slug_url.'" class="list-group-item list-group-item-action">'.$row->title.'</a> ';
        }
    }else{
        echo '<a  class="list-group-item list-group-item-action">No record found</a> ';
    }
}