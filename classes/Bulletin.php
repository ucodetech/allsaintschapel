<?php
/**
 *
 */
class Bulletin
{
  private $_db;

  public function __construct()
  {
    $this->_db = Database::getInstance();
  }

//create bulletin
public function create($fields = array())
{
  if (!$this->_db->insert('chapel_bullentin', $fields)) {
    throw new \Exception("Error Inserting bulletin", 1);

  }
}
//update bulletin
public function updatebulletin($id, $fields = array())
{
  if (!$this->_db->update('chapel_bullentin', 'id', $id, $fields)) {
    throw new \Exception("Error updating bulletin", 1);

  }
}


//fetch bulletin text textFormat
public function fetchBulletin()
{
  $bulletin = $this->_db->get('chapel_bullentin', array('deleted', '=', 0));
  if ($bulletin->count()) {
    $row =  $bulletin->results();
    $output = '';

      $output .= '<div class="row mb-3">';
        foreach ($row as $bulletin) {
          $output .= '<div class="col-md-4">
                <a href="detail/bulletin-detail/'.$bulletin->id.'" class="btn btn-primary btn-block" title="View Bulletin" target="_blank">'.pretty_dates($bulletin->dateOfService).'</a>
            </div>';
        }
      $output .= '</div>';

      return $output;
  }else{
    return '<h2 class="text-center">No bulletin yet</h3>';
  }
}

public function fetchBulletinfront()
{
  $bulletin = $this->_db->get('chapel_bullentin', array('deleted', '=', 0));
  if ($bulletin->count()) {
    $row =  $bulletin->results();
    $output = '';

      $output .= '<div class="row mb-3">';
        foreach ($row as $bulletin) {
          $output .= '<div class="col-md-4">
                <a href="frontlock/bulletin-detail/'.$bulletin->id.'" class="btn btn-primary btn-block" title="View Bulletin" target="_blank">'.pretty_dates($bulletin->dateOfService).'</a>
            </div>';
        }
      $output .= '</div>';

      return $output;
  }else{
    return '<h2 class="text-center">No bulletin yet</h3>';
  }
}



public function slugCheck($table, $slug_url)
{
  $data = $this->_db->get($table, array('slug_url', '=', $slug_url));
  if ($data->count()) {
    return $data->results();
  }else{
    return false;
  }

}

public function publishAction($table, $actionId, $val)
{
  $this->_db->update($table, 'id', $actionId, array(
    'published' => $val
  ));
  return true;
}

public function deleteAction($table, $actionId, $val)
{
  $this->_db->update($table, 'id', $actionId, array(
    'deleted' => $val
  ));
  return true;
}

public function getDetail($table, $detailid){
    $get = $this->_db->get($table, array('id','=', $detailid));
    if ($get->count()){
        return $get->first();
    }else{
        return false;
    }
}

public function deleteComp($table, $Id)
{
    $val = '';
  $this->_db->update($table, 'id', $Id, array(
    'audio' => $val
  ));
  return true;
}

//check if published before editing
public function publishStatus($table,$id)
{
  $check = $this->_db->get($table, array('id', '=', $id));
  if ($check->count()) {
    return $check->first();
  }else{
    return false;
  }

}

public function fetchBulletinDetail($detailid){
    $get = $this->_db->get('chapel_bullentin', array('id','=', $detailid));
    if ($get->count()){
        return $get->first();
    }else{
        return false;
    }
}

}//end of class
