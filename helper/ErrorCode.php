<?php
/**
 *
 */
class ErrorCode
{
  function get($code,$attach = null){
    $c = array();
    $msg = self::build($code,$attach);
    if($msg == null){
      $c['error']['code'] = 0;
      $c['error']['message'] = 'unknown error';
    }else{
      $c['error']['code'] = $code;
      $c['error']['message'] = $msg;
    }
    return $c;
  }
  function build($code,$attach = null)
  {
    if($code == 4){
      return 'parameter name,email,username and password is require for register';
    }else if($code == 5){
      return 'this email has been already register';
    }else if($code == 6){
      return 'this username has been already register';
    }else if($code == 7){
      return 'this username is reserved for system';
    }else if($code == 8){
      return 'this username is malform';
    }else if($code == 9){
      return 'user not found';
    }else{
      return null;
    }
  }
}
?>
