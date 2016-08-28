<?php
class User{
  /*
  getId from username
  */
  public static function getId($username){
    global $pdo;
    $query = $pdo
      ->select(array('user_id'))
      ->from('user')
      ->where('user_name','=',$username);
    $result = $query->execute();
    return $result->fetch()['user_id'];
  }
  /*
  fromToken
  */
  public static function fromToken($token){
    
  }
}
?>
