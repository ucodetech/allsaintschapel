<?php
/**
 * post class
 */
class Post
{
  private  $_db,
           $_userpost;


  function __construct()
  {
    $this->_db = Database::getInstance();
   $this->_userpost = new User() ;

  }

  public function userpost()
  {
   return $this->_userpost;
  }

  public function sendPost($message, $user_to_timeline)
    {

      $posted_by_id = $this->_userpost->getUserId();
      $posted_by_username = $this->_userpost->getUsername();


      if ($user_to_timeline == $posted_by_username) {
        $user_to_timeline = 'none';
      }

      $post = $this->_db->insert('code_posts', array(
        'message' => $message,
        'posted_by_id' => $posted_by_id ,
        'user_to_timeline' => $user_to_timeline
      ));

      if ($post) {
  //update count
         $num_posts = $this->_userpost->userNumPost();
         $num_posts = $num_posts + 1;

         $this->_db->update('codeChat_users', 'id', $posted_by_id, array(
          'num_posts' => $num_posts
        ));
        }


    }


//get number of posts of a user
    public function GetUserNumPost($currentChatUser)
    {
      $getUser = $this->_db->get('codeChat_users', array('id', '=', $currentChatUser));

     if ($getUser->count()) {
         $this->_userpost = $getUser->first();
         return $this->_userpost;

      }else{
        return false;
      }
    }

public function CountComment($postid)
{
   $counted = $this->_db->get('post_comments', array('post_id', '=', $postid));
      if ($counted->count()) {

       return $counted->count();
      }else{

        return false;
      }
}
public function CountLikes($postid)
{
   $counted = $this->_db->get('likes', array('post_id', '=', $postid));
      if ($counted->count()) {

       return $counted->count();
      }else{

        return false;
      }
}
public function CountShares($postid)
{
   $counted = $this->_db->get('shares', array('post_id', '=', $postid));
      if ($counted->count()) {

       return $counted->count();
      }else{

        return false;
      }
}
//LOAD POST
  public function loadPosts($data, $limit)
    {

    }





public function loadPostId($postId){
  $post = $this->_db->get('code_posts', array('id', '=', $postId));
  if ($post->count()) {
    return  $this->_db->first();
  }else{
    return false;
  }
}

public function LikePost($post_id_like)
  {

    $userLiked = new User();
    $user_liked = $userLiked->getUsername();
    $sql = "INSERT INTO likes (username,  post_id) VALUES ('$user_liked ', '$post_id_like')";
     $this->_db->query($sql);
     //update num likes
      $update = "UPDATE codeChat_users SET num_likes =  num_likes  + 1 WHERE user_username = '$user_liked' ";
      $this->_db->query($update);


     return true;


  }

public function DisLikePost($post_id_dislike){
  $userLiked = new User();
    $user_liked = $userLiked->getUsername();

  $sql = "DELETE FROM likes  WHERE username = '$user_liked ' AND post_id = '$post_id_dislike'";
      $this->_db->query($sql);
    // update num likes
  $update = "UPDATE codeChat_users SET num_likes =  num_likes - 1 WHERE user_username = '$user_liked' ";
    $this->_db->query($update);
  return true;

}



public function getTutorial($slug)
{

    $sql = "SELECT * FROM tutorials WHERE slug_url = '$slug'  AND deleted = 0";
      $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->first();
      }else{
        return false;
      }

}

public function getCategories($tutcategories){
$sql = "SELECT * FROM categories WHERE id = '$tutcategories'  AND deleted = 0";
   $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->first();
      }else{
        return false;
      };

}

public function getAuthor($author)
{
   $sql = "SELECT * FROM superusers WHERE id = '$author'";
     $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->first();
      }else{
        return false;
      };
}

public function getSourceCode($tutid)
{
  $sql = "SELECT * FROM sourceScreen WHERE tut_id = '$tutid'";
    $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->first();
      }else{
        return false;
      };

}



public function getLikeCount($tutid)
{
   $sql = "SELECT * FROM likeSystem WHERE post_id = '$tutid'";
    $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->count();
      }else{
        return $count = 0;
      }

}

public function checkUserLike($tutid, $cuserid)
{
  $sql = "SELECT * FROM likeSystem WHERE post_id = '$tutid' AND user_id ='$cuserid' ";
    $this->_db->query($sql);
      if ($this->_db->count()) {
        return true;
      }else{
        return false;
      }

}

public function likeSys($pid, $uid)
{
  $this->_db->insert('likeSystem', array(
    'post_id' => $pid,
    'user_id' => $uid
  ));
  return true;

}
public function UnlikeSys($pid, $uid)
{
  $sql = "DELETE FROM likeSystem WHERE post_id = '$pid' AND user_id = '$uid' ";
  $this->_db->query($sql);
  return true;

}



public function getDisLikeCount($cuserid,$tutid)
{
   $sql = "SELECT * FROM likeSystem WHERE user_id = '$cuserid' AND post_id = '$tutid' AND like_dislike_count = 2 ";
    $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->count();
      }else{
        return false;
      };

}


public function getTags($tag)
{
  $sql = "SELECT * FROM tutorials WHERE tags LIKE '%$tag%'  AND deleted = 0 ";
  $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->results();
      }else{
        return false;
      };
}

public function getSourceScreen($id)
{
   $sql = "SELECT * FROM sourceScreen WHERE id = '$id' LIMIT 1";
     $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->first();
      }else{
        return false;
      };
}

public function UpdateDownloadSrc($downloads, $id){

  $this->_db->update('sourceScreen', 'id', $id, array(
    'source_downloads' => $downloads
  ));
  return true;
}


public function fetchDownloads($id){

  $sql = "SELECT source_downloads FROM sourceScreen WHERE id = '$id'";
 $this->_db->query($sql);
 if ($this->_db->count()) {
   return $this->_db->first();
 }else{
  return false;
 }

}

public function searchTut($search)
{
  $sql =  "SELECT *  FROM tutorials WHERE tut_title LIKE '%$search%' ";
$this->_db->query($sql);
 if ($this->_db->count()) {
   return $this->_db->results();
 }else{
  return false;
 }
}

//select category parent
public  function fetchCateParent($val){
  $this->_db->get('categories', array('deleted', '=', $val));
   if ($this->_db->count()) {
     return $this->_db->results();
   }else{
    return false;
   }
}

public function fetchTutorialsFront($val){
$sql = "SELECT * FROM tutorials WHERE deleted =  '$val' ORDER BY id DESC LIMIT 10";
$this->_db->query($sql);
if ($this->_db->count()) {
  return $this->_db->results();
}else{
 return false;
}
}

//FEtch tutorials
public function fetchTutorials($val){
$this->_db->get('tutorials', array('deleted',  '=', $val));
  if ($this->_db->count()) {
    return $this->_db->results();
  }else{
   return false;
  }
}


//Edit category parent
public function cateById($id){
  $sql = "SELECT * FROM categories WHERE  id = '$id' AND deleted = 0";
  $this->_db->query($sql);
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
   return false;
  }
}


public function updateTut($tut_title, $tut_description,  $tags,  $html, $html_description,  $css ,  $css_description, $jquery, $jquery_description,$category, $slug_url, $youtube_link, $php_tut, $php_description,$sql_tut, $sql_description, $id){
  // $sql = "UPDATE tutorials SET tut_title = ?, tut_description = ?, tags = ?, html = ?, html_description = ?, css = ?, css_description = ?, jquery = ?, jquery_description = ?, categories = ?, slug_url = ?, youtube_link = ?, php_tut = ?, php_description = ?, sql_tut = ?, sql_description = ?,   date_updated = NOW() WHERE id = ? ";
  // $stmt = $this->_pdo->prepare($sql);
  // $stmt->execute([$tut_title, $tut_description,  $tags,  $html, $html_description,  $css ,  $css_description, $jquery, $jquery_description,$category, $slug_url, $youtube_link,$php_tut, $php_description,$sql_tut, $sql_description, $id]);

$myDate = $this->NOW();
  $this->_db->update('tutorials', 'id', $id, array(
    'tut_title' => $tut_title,
    'tut_description' => $tut_description,
    'tags' => $tags,
    'html' => $html,
    'html_description' => $html_description,
    'css' => $css ,
    'css_description' => $css_description,
    'jquery' => $jquery,
    'jquery_description' => $jquery_description,
    'categories' => $category,
    'slug_url' => $slug_url,
    'youtube_link' => $youtube_link,
    'php_tut' => $php_tut,
    'php_description' => $php_description,
    'sql_tut' => $sql_tut,
    'sql_description' => $sql_description,
    'date_updated' => $myDate
  ));
  return true;
}


//add tuttorial
public function addTut($author, $tut_title, $tut_description,  $tags,  $html, $html_description,  $css ,  $css_description, $jquery, $jquery_description,$category, $slug_url, $youtube_link, $php_tut, $php_description, $sql_tut, $sql_description){
  // $sql = "INSERT INTO tutorials (author, tut_title, tut_description, tags, html, html_description, css, css_description, jquery, jquery_description, categories, slug_url, youtube_link, php_tut, php_description, sql_tut, sql_description) VALUES (?, ?, ?, ?, ?, ? ,? ,?, ? ,? , ?, ? , ?, ?, ?, ?, ? )";
  // $stmt = $this->_pdo->prepare($sql);
  // $stmt->execute([$author, $tut_title, $tut_description,  $tags,  $html, $html_description,  $css ,  $css_description, $jquery, $jquery_description,$category, $slug_url, $youtube_link, $php_tut, $php_description,$sql_tut, $sql_description]);
  // return true;
  $this->_db->insert('tutorials', array(
    'tut_title' => $tut_title,
    'tut_description' => $tut_description,
    'tags' => $tags,
    'html' => $html,
    'html_description' => $html_description,
    'css' => $css ,
    'css_description' => $css_description,
    'jquery' => $jquery,
    'jquery_description' => $jquery_description,
    'categories' => $category,
    'slug_url' => $slug_url,
    'youtube_link' => $youtube_link,
    'php_tut' => $php_tut,
    'php_description' => $php_description,
    'sql_tut' => $sql_tut,
    'sql_description' => $sql_description,
  ));
  return true;
}


public function postID($postid)
{
  $this->_db->get('tutorials', array('slug_url', '=', $postid));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
   return false;
  }
}

public function sourceCodes($val){
  $this->_db->get('sourceScreen', array('deleted', '=', $val));
  if ($this->_db->count()) {
    return $this->_db->results();
  }else{
   return false;
  }
}

public function tutById($id, $val){
$sql = "SELECT * FROM tutorials WHERE id = '$id' AND  deleted =  '$val' ";
$this->_db->query($sql);
if ($this->_db->count()) {
  return $this->_db->first();
}else{
 return false;
}

}

public function getSourceById($id, $val){
  $sql = "SELECT * FROM sourceScreen WHERE id = '$id' AND  deleted =  '$val' ";
  $this->_db->query($sql);
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
   return false;
  }

}

//Update tutorials table and source code table
public function tutAction($field, $val, $id){
$this->_db->update('tutorials', 'id', $id, array(
  $field => $val
));
return true;
}

public function srcAction($val, $id){
$this->_db->update('sourceScreen', 'tut_id', $id, array(
  'deleted' => $val
));
return true;
}


//Update tutorials featured image
public function featuredAction($dbpath, $tut_id){
    $this->_db->update('tutorials', 'id', $id, array(
      'featured_image' => $dbpath,
      'has_feat' => 1
    ));
    return true;
}


public function fetchTag($val){
    $this->_db->get('tags', array('deleted', '=', $val));
    if ($this->_db->count()) {
      return $this->_db->results();
    }else{
     return false;
    }
}








public function NOW()
{
  return date("Y, M d h:i s");
}

}//end of class
