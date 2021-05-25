<?php 
require_once '../core/init.php';

$download = new Download();
$db = Database::getInstance();

if (isset($_POST['download_id']) && !empty($_POST['download_id'])) {
	$downid = $_POST['download_id'];
	$sql = "SELECT downloads FROM sermonAudioFormat WHERE id = '$downid' ";
	$query = $db->query($sql);
	$tot = $query->first();

	$file = $tot->downloads;

	echo '(<span>
             '.$file.'
            </span>)';
	
	
}

if (isset($_POST['like_id'])) {
	$like_id = (int)$_POST['like_id'];
	$sql = "UPDATE sermonAudioFormat SET likes = likes + 1 WHERE id = '$like_id' ";
	$query = $db->query($sql);

	$sql2 = "SELECT likes FROM sermonAudioFormat WHERE id = '$like_id' ";
	$query2 = $db->query($sql2);
	$tot = $query2->first();

	$like = $tot->likes;

	echo '(<span>
             '.$like.'
            </span>)';
}