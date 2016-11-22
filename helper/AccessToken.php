<?php
use \Firebase\JWT\JWT;
class AccessToken
{
  public function getId()
  {
    require(__DIR__.'/../config.php');
    try {
      $decoded = (array)JWT::decode($token, $config['jwt']['secret'], array('HS256'));
    } catch (Exception $e) {
      return null;
    }
    if(!isset($decoded['data'])){
      return null;
    }else{
      if($decoded['exp']<time()){
        return null;
      }else{
        return $decoded['data']->userId;
      }
    }
  }
}
?>
