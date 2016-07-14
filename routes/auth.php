<?php
use \Firebase\JWT\JWT;
$app->post('/auth',function() use ($app){
  require("helper/pdo.php");
  $email = $app->request->post("email");
  $password = $app->request->post("password");
  $passwordHasher = new Pentagonal\Phpass\PasswordHash(8,false);
  $authenFailed = false;
  if(!$email || !$password){
    $authenFailed = true;
  }else{
    $query = $pdo->select()->from("user")->where("email","=",$email);
    $result = $query->execute();
    if($result->rowCount()==0){
      $authenFailed = true;
    }else{
      $result = $result->fetch();
      $isMatch = $passwordHasher->checkPassword($password,$result["hash"]);
      if(!$isMatch){
        $authenFailed = true;
      }else{
        require_once("config.php");
        $token = array(
            "iss" => $config["jwt"]["domain"],
            "aud" => "http://example.com",
            "iat" => time(),
            "nbf" => time(),
            "exp" => time()+$config["jwt"]["expire"],
            "data" => array(
              "userId" => $result["id"],
            )
        );
        $jwt = JWT::encode($token, $config["jwt"]["secret"]);
        $app->render(200,array(
          'token' => $jwt,
        ));
      }
    }
  }
  if($authenFailed){
    $app->render(401,array(
      'error_code' => 4,
      'message' => 'Email or Password isn\'t correct',
    ));
  }
});
?>
