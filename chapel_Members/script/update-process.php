<?php

require_once  '../../core/init.php';
$user = new User();
$show = new Show();
$validate = new Validate();
$user_id = $user->data()->id;
$general = new General();

if (isset($_POST['action']) && $_POST['action'] == 'update_details'){
    if (Input::exists()){
        $validation = $validate->check($_POST, array(
            "fullName" => array(
                'required' => true,

            ),
            "gender" => array(
                'required' => true,
            ),
            "status" => array(
                'required' => true,
            ),
            "mobile" => array(
                'required' => true,
            ),
            "email" => array(
                'required' => true,
            ),
            "department" => array(
                'required' => true,
            ),
            "level" => array(
                'required' => true,
            ),
            'school' => array(
                'required' => true,
            ),
            "address" => array(
                'required' => true,
            ),
            "p_address" => array(
                'required' => true,
            ),
            "state" => array(
                'required' => true,
            ),
            "lga" => array(
                'required' => true,
            ),
            "birthday" => array(
                'required' => true,
            ),
            "dateOfNewBirth" => array(
                'required' => true,
            ),
            "dateOfBaptism" => array(
                'required' => true,
            ),
            "baptism_holy" => array(
                'required' => true,
            ),
            "spiritual_gift" => array(
                'required' => true,
            ),
            "homeChurch" => array(
                'required' => true,
            ),
            "position" => array(
                'required' => true,
            ),
            "ChapelUnit"     => array(
                'required' => true,
            ),
        ));

        if ($validation->passed()){
//            $unit = Input::get('ChapelUnit');
//                if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",',',$unit)){
//
//                }
           $one = 1;
            $general->updateMember($user_id, array(

                'full_name' => Input::get('fullName'),
                'Gender' => Input::get('gender'),
                'Birthday' => Input::get('birthday'),
                'Residence' => Input::get('address'),
                'home_church' => Input::get('homeChurch'),
                'mobile' => Input::get('mobile'),
                'email' => Input::get('email'),
                'department' => Input::get('department'),
                'level' => Input::get('level'),
                'school' => Input::get('school'),
                'marital_status' => Input::get('status'),
                'p_address' => Input::get('p_address'),
                'state' => Input::get('state'),
                'lga' => Input::get('lga'),
                'dateOfBaptism' => Input::get('dateOfBaptism'),
                'baptism_holy' => Input::get('baptism_holy'),
                'spiritual_gift' => Input::get('spiritual_gift'),
                'date_new_birth' => Input::get('dateOfNewBirth'),
                'position' => Input::get('position'),
                'ChapelUnit' => Input::get('ChapelUnit'),
                'updated' => $one

            ));
            echo 'success';
        }else{
            foreach($validation->errors() as $error){
                echo $show->showMessage('danger',$error, 'warning');
                return false;
            }
        }
    }


}