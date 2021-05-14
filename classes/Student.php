<?php

 /**
  * Student
  */
 class Student
 {

 	private  $_db,
           $_user,
           $_super;


  function __construct()
  {
    $this->_db = Database::getInstance();
    $this->_user = new User() ;

  }


  //Get gender percentage
public function genderPer(){
  $sql = "SELECT gender, COUNT(*) AS number FROM students WHERE gender != '' GROUP BY gender ";
  $data = $this->_db->query($sql);
	  if ($data->count()) {
	  	return $data->results();
	  }else{
	  	return false;
	  }
}

// verified and unverified percenta
public function verifiedPer(){
  $sql = "SELECT verified, COUNT(*) AS number FROM students  GROUP BY verified ";
   $data = $this->_db->query($sql);
	  if ($data->count()) {
	  	return $data->results();
	  }else{
	  	return false;
	  }
}



 public function getImgSuper($superimgid){
        $data = $this->_db->get('super_profile', array('sudo_id', '=', $superimgid));
     	  if ($this->_db->count()) {
     	  	return $this->_db->first();
     	  }else{
     	  	return false;
     	  }
    }


  public function verified_users($status){
    $count =  $this->_db->get('students', array('verified', '=', $status));
    if ($count->count()) {
      return $count->count();
    }else{
      return '0';
    }
  }


public function fetchUserDetail($id){
    $data = $this->_db->get('students', array('id', '=', $id));
    if ($data->count()) {
      return $data->first();
    }else{
      return false;
    }
}




public function loggedUsers(){
    $sql = "SELECT * FROM students WHERE lastLogin > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
    $data = $this->_db->query($sql);
  	  if ($data->count()) {
  	  	return $data->results();
  	  }else{
  	  	return false;
  	  }
  }


public function updateStudentRecored($student_id, $field, $value)
{
	$this->_db->update('students', 'id', $student_id, array(
    	$field => $value

    ));

    return true;
}




public function fetchStudentsApproved(){
  $output = '';
  $imgPath = '../studentPortal/avaters/';

  $sql = "SELECT * FROM students WHERE approved = 1 AND permission = 'lib_student' ";
  $query = $this->_db->query($sql);
  if ($query->count()) {
    $dat = $query->results();
  if ($dat) {
    $output .= '
    <table class="table table-striped table-hover" id="showStudent">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Matric Number</th>
          <th>Department</th>
          <th>Level</th>
          <th>Joined Date</th>
          <th>Last Login</th>
          <th>Email Verified</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
    foreach ($dat as $row) {

        $passport = '<img src="'.$imgPath.$row->passport.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

      if($row->verified == 0){
          $msg ='<span class="text-danger align-self-center lead">No</span>';
      }else{

        $msg ='<span class="text-success align-self-center lead">Yes</span>';

      }
      $output .= '
          <tr>
            <td>'.$row->id.'</td>
              <td>'.$passport.'</td>
                   <td>'.$row->full_name.'</td>
                     <td>'.$row->matric_no.'</td>
                       <td>'.$row->department.'</td>
                        <td>'.$row->level.'</td>
                       <td>'.pretty_dates($row->dateJoined).'</td>
                       <td>'.pretty_dates($row->lastLogin).'</td>

                         <td>'.$msg.'</td>
                         <td>
                         <a href="detail/student-detail/'.$row->id.'" id="'.$row->id.'" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                         <a href="#" id="'.$row->id.'" title="Trash Student" class="text-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;

                         </td>
          </tr>
          ';
    }



    $output .= '
      </tbody>
    </table>';
  }
  return  $output;

}else{
  echo '<h3 class="text-center text-secondary align-self-center lead">No Student  approved yet</h3>';
}

}
public function fetchStaffApproved(){
  $output = '';
  $imgPath = '../studentPortal/avaters/';

  $sql = "SELECT * FROM students WHERE approved = 1 AND permission = 'lib_staff' ";
  $query = $this->_db->query($sql);
  if ($query->count()) {
    $dat = $query->results();
  if ($dat) {
    $output .= '
    <table class="table table-striped table-hover" id="showStaff">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>File Number</th>
          <th>Department</th>
          <th>Position</th>
          <th>Joined Date</th>
          <th>Last Login</th>
          <th>Email Verified</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
    foreach ($dat as $row) {

        $passport = '<img src="'.$imgPath.$row->passport.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

      if($row->verified == 0){
          $msg ='<span class="text-danger align-self-center lead">No</span>';
      }else{

        $msg ='<span class="text-success align-self-center lead">Yes</span>';

      }
      $output .= '
          <tr>
            <td>'.$row->id.'</td>
              <td>'.$passport.'</td>
                   <td>'.$row->full_name.'</td>
                     <td>'.$row->fileNo.'</td>
                       <td>'.$row->department.'</td>
                        <td>'.$row->position.'</td>
                       <td>'.pretty_dates($row->dateJoined).'</td>
                       <td>'.pretty_dates($row->lastLogin).'</td>

                         <td>'.$msg.'</td>
                         <td>
                         <a href="detail/student-detail/'.$row->id.'" id="'.$row->id.'" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                         <a href="#" id="'.$row->id.'" title="Trash Student" class="text-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;

                         </td>
          </tr>
          ';
    }



    $output .= '
      </tbody>
    </table>';
  }
  return  $output;

}else{
  echo  '<h3 class="text-center text-secondary align-self-center lead">No Staff Approved yet</h3>';
}

}
public function fetchNotifactionCount(){
  $sql = "SELECT * FROM students WHERE hod_approval = 0 OR circulation_approval = 0 OR approved = 0 ";
   $this->_db->query($sql);
  if ($this->_db->count()) {
    return $this->_db->count();
  }else{
    return false;
}
}
public function notApprovedUser(){
  $output = '';
  $imgPath = '../studentPortal/avaters/';

  $sql = "SELECT * FROM students WHERE approved = 0";
  $query = $this->_db->query($sql);
  if ($query->count()) {
    $dat = $query->results();
  if ($dat) {
    $output .= '
    <table class="table table-striped table-hover" id="showNewStaffStud">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Department</th>
          <th>Joined Date</th>';


          if (hasPermissionHOD()) {
              $output .='

              <th class="bg-success">Approve</th>
              <th class="bg-danger">Reject</th>
              ';
          }elseif(hasPermissionCirculation()){
            $output .='
              <th>HOD Approved</th>
            <th class="bg-info">Approve</th>
              <th class="bg-warning">Reject</th>
            ';
          }
        $output .=' <th>Details</th>
          <th>Delete</th>

        </tr>
      </thead>
      <tbody>
    ';
    foreach ($dat as $row) {

        $passport = '<img src="'.$imgPath.$row->passport.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';
        $button = '';
      if (hasPermissionCirculation()) {
          if ($row->hod_approval == 0) {
                $answer ='<span class="text-danger align-self-center lead">No</span>';

          }else{
            $answer ='<span class="text-success align-self-center lead">Yes</span>';

          }
      }elseif(hasPermissionHOD()){
        $answer = '';
        if ($row->hod_approval == 0) {
              $answer ='<span class="text-danger align-self-center lead">No</span>';
              $button = '<a href="#" id="'.$row->id.'" title="Approve" class="btn btn-sm btn-info approveHOD"></i>Approve</a>&nbsp;';
        }else{
          $answer ='<span class="text-success align-self-center lead">Yes</span>';
          $button = '<span class="text-success align-self-center lead">Approved</span>';
        }
      }

      $output .= '
          <tr>
            <td>'.$row->id.'</td>
              <td>'.$passport.'</td>
                   <td>'.$row->full_name.'</td>
                       <td>'.$row->department.'</td>
                       <td>'.pretty_dates($row->dateJoined).'</td>';

                         if (hasPermissionHOD()) {
                             $output .='
                             <td>
                              '.$button.'
                             </td>
                             <td>
                             <a href="#" id="'.$row->id.'" title="Decline" class="btn btn-sm btn-danger declineHOD"></i>Decline</a>&nbsp;
                             </td>
                             ';
                         }elseif(hasPermissionCirculation()){
                           $output .='
                            <td>'.$answer.'</td>
                            <td>
                          <a href="#" id="'.$row->id.'" title="Approve" class="btn btn-sm btn-primary approveCirculation"></i>Approve</a>&nbsp;

                           </td>
                           <td>
                          <a href="#" id="'.$row->id.'" title="Decline" class="btn btn-sm btn-danger declineCirculation"></i>Decline</a>&nbsp;
                          </td>

                           ';
                         }

                        $output .=' <td>
                         <a href="detail/student-detail/'.$row->id.'" id="'.$row->id.'" title="View Details" class="btn btn-sm btn-primary"><i class="fas fa-info-circle fa-lg"></i>Details</a>&nbsp;

                         </td>
                         <td>

                         <a href="#" id="'.$row->id.'" title="Trash" class="btn btn-sm btn-danger deleteStudentIcon"><i class="fa fa-recycle fa-lg"></i> Delete</a>&nbsp;

                         </td>
          </tr>
          ';
    }



    $output .= '
      </tbody>
    </table>';
  }
  return  $output;

}else{
  return '<h3 class="text-center text-secondary align-self-center lead">No new student or staff in database</h3>';
}

}

public function approveAction($field,$val, $user_id)
{
  $data = $this->_db->get('students', array('id', '=', $user_id));
  if ($data->count()) {
    $dat = $data->first();
    $userid = $dat->id;
    if ($dat->updated == 1) {
      $sql = "UPDATE students SET $field = 1, approved = $val WHERE id = '$user_id'";
      $query = $this->_db->query($sql);
      if ($query) {
        return true;
      }else{
        return false;

      }
    }else{
      $show = new Show();
      echo $show->showMessage('danger','The student or staff have not updated his/her details completely!', 'warning');
    }
  }

}

public function giveCard($user_id)
{
  $stamp = 'stamp.jpeg';
  $this->_db->insert('greenCards', array(
    'user_id' => $user_id,
    'stamp' => $stamp
  ));
  return true;
}

public function getStudentDetail($student_id)
  {
    $student = $this->_db->get('students', array('id', '=', $student_id));
    if ($student->count()) {
      return  $student->first();

    }else{
      return false;
    }
}

public function fetchOffenders(){
    $output = '';
    $imgPath = '../studentPortal/avaters/';


    $this->_db->get('offenders', array('pardoned', '=', 0));
    if ($this->_db->count()) {
      $dat = $this->_db->results();
    if ($dat) {
      $output .= '
      <table class="table table-striped table-hover" id="showOffender">
        <thead>
          <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Full Name</th>
            <th>Matric/File No</th>
            <th>Offence</th>
            <th>Punishment</th>
            <th>Details</th>
            <th>Restore Access</th>


          </tr>
        </thead>
        <tbody>
      ';
      foreach ($dat as $row) {
        $student =  $this->_db->get('students', array('id', '=', $row->user_id));
        if ($student->count()) {
          $thatStudent = $student->first();
        }
          $passport = '<img src="'.$imgPath.  $thatStudent->passport.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

          if ($thatStudent->permission == 'lib_staff') {
            $idno = $thatStudent->fileNo;
          }else{
            $idno = $thatStudent->matric_no;
          }

        $output .= '
            <tr>
              <td>'.$thatStudent->id.'</td>
                <td>'.$passport.'</td>
                     <td>'.$thatStudent->full_name.'</td>
                       <td>'.$idno.'</td>
                         <td>'.$row->offence.'</td>
                         <td>'.$row->punishment.'</td>

                           <td>
                           <a href="detail/student-detail/'.$thatStudent->id.'" id="'.$thatStudent->id.'" title="View Details" class="btn btn-primary btn-sm">Details</a>&nbsp;

                           </td>
                           <td>
                           <a href="#" id="'.$thatStudent->id.'" title="Trash Student" class="btn  btn-sm btn-danger deleteStudentIcon">Restore Access</a>&nbsp;

                           </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
    }
    return  $output;

  }else{
    echo '<h3 class="text-center text-secondary align-self-center lead">No Offender In database</h3>';
  }

}
//log in error
public function sendToLog($studentId)
{
    $this->_db->insert('offenders', array(
        'user_id'  => $studentId,
        'offence' => 'Failed to return book as at well due!',
        'punishment' => 'Banned from borrowing book from the library, with immediate effect!'
      ));
      return true;
}

public function updateOffended($studentId)
{
  $this->_db->update('students', 'id', $studentId, array(
    'offended' => 1
  ));
  return true;
}


public function updateTimeInBorrowed($studentId)
    {
        $this->_db->update('borrowed_books', 'user_id', $studentId, array(
            'time_before_log' => '00:00:00'
        ));
        return true;
    }

















   }//end of class
