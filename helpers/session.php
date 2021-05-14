<?php

  function isLoggedInMember(){
      $user = new User();
    if ($user->isLoggedIn()) {
        return true;
     }else{
        return false;
     }


      }



  function isOTPset($useremail){
    $sql = "SELECT * FROM verifyAdmin WHERE sudo_email = '$useremail'";
     $check = Database::getInstance()->query($sql);
    if ($check->count()) {
      return true;
    }else{
      return false;
    }
  }

  function isOTPsetMember($useremail){
    $sql = "SELECT * FROM otp WHERE email = '$useremail'";
     $check = Database::getInstance()->query($sql);
    if ($check->count()) {
      return true;
    }else{
      return false;
    }
  }


function isIsLoggedIn(){
      $admin = new Admin();
      if ($admin->isIsLoggedIn()){
          return true;
      }else{
          return  false;
      }
}

function hasPermissionSuper($permission = 'superuser'){
    $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }
}


function hasPermissionChaplain($permission = 'chaplain'){
     $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

function hasPermissionEditor($permission = 'editor'){
     $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

function hasPermissionLIBStudent($permission = 'lib_student'){
     $user = new User();
    if (isset($_SESSION[Config::get('session/session_members')])) {

    $permissioned = $user->data()->permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

function hasPermissionLIBStaff($permission = 'lib_staff'){
     $user = new User();
    if (isset($_SESSION[Config::get('session/session_members')])) {

    $permissioned = $user->data()->permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}


