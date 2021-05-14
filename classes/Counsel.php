<?php


class Counsel
{
    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function create($field = array()){
        return $this->_db->insert('counsellingForm', $field);
    }

    public function getTable($table, $val, $field){
        return $this->_db->get($table, array($val, '=', $field));
    }

    public function fetchCounselling(){
        $output = '';
        $counsel = $this->getTable('counsellingForm','deleted',0);
        if ($counsel->count()) {
            $grabbed = $counsel->results();

            $output .= '
      <table class="table table-striped table-hover" id="showCounselling">
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Phone No</th>
            <th>Department</th>
            <th>Level</th>
            <th>Date Filled</th>
            <th>Action</th>


          </tr>
        </thead>
        <tbody>
      ';
            foreach ($grabbed as $row) {
                $full_name = $row->surname . $row->othernames;
                $output .= '
            <tr>
         <td>'.$row->id.'</td>
         <td>'.$full_name.'</td>
          <td>'.$row->phoneNo.'</td>
         <td>'.$row->department.'</td>
         <td>'.$row->level.'</td>
         <td>'.pretty_dates($row->dateApplied).'</td>
           <td>
           <a href="detail/counsel-detail/'.$row->id.'" class="btn btn-sm btn-primary"><i class="fa fa-info-circle fa-lg"></i>&nbsp;Details</a>
           
           </td>
            </tr>
            ';
            }

            $output .= '
        </tbody>
      </table>';

            return  $output;
        }else{
            return  '<h3 class="text-center text-secondary align-self-center lead">No Data Yet</h3>';
        }

    }

    public function triggerForm($formName, $value){
        $data = $this->_db->get('triggerTable' , array($formName, '=', $value));
        if ($data->count()){
            return $data->first();
        }else{
            return false;
        }
}

}//end of class