<?php 
require_once '../core/init.php';
$post = new Post();
$user = new User();
if (isset($_POST['count_id'])) {
  $id = $_POST['count_id'];

   $data = $post->fetchDownloads($id);
   if ($data) {
     echo $data->source_downloads;
   }else{
    echo '0';
     
    }
   }


if (isset($_POST['like_id'])) {
    $postid = (int)$_POST['like_id'];
    $userid = $user->getUserId();

    $post->likeSys($postid, $userid);

}

if (isset($_POST['unlike_id'])) {
    $postid = (int)$_POST['unlike_id'];
    $userid = $user->getUserId();

    $post->UnlikeSys($postid, $userid);

}

if (isset($_POST['like_post_id'])) {
  $tutid = $_POST['like_post_id'];

   $data = $post->getLikeCount($tutid);
  echo $data;


  }

  if (isset($_POST['liked'])) {
  $tutid = $_POST['liked'];
  $users = $user->getUserId();
  $countLike = $post->checkUserLike($tutid, $users);

    if($countLike) {
    echo'<button class="btn btn-sm btn-outline-danger unlike">
            <i class="fa fa-thumbs-down"></i>&nbsp;
            (<span id="countLikes"></span>)
          </button>';
        
      }else{
        
    echo '<button class="btn btn-sm btn-outline-primary like" >
          <i class="fa fa-thumbs-up"></i>&nbsp;
           (<span id="countLikes"></span>)
        </button>';

      }

  }

                  

    // comment

$comm = new Comment();

if (isset($_POST['clike_id'])) {
    $postid = (int)$_POST['clike_id'];
    $userid = $user->getUserId();

    $comm->likeSys($postid, $userid);

}

if (isset($_POST['cunlike_id'])) {
    $postid = (int)$_POST['cunlike_id'];
    $userid = $user->getUserId();

    $comm->UnlikeSys($postid, $userid);

}

if (isset($_POST['like_postc'])) {
  $tutid = $_POST['like_postc'];

   $data = $comm->getLikeCount($tutid);
  echo $data;


  }
