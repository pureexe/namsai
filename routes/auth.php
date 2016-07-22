<?php
use \Firebase\JWT\JWT;
$app->post('/auth',function() use ($app,$config,$pdo){
  $email = $app->request->post("email");
  $password = $app->request->post("password");
  $passwordHasher = new Pentagonal\Phpass\PasswordHash(8,false);
  $authenFailed = false;
  if(!$email || !$password){
    $authenFailed = true;
  }else{
    $query = $pdo->select()->from("user")->where("user_email","=",$email);
    $result = $query->execute();
    if($result->rowCount()==0){
      $app->render(401,array(
        'error_code' => 9,
        'message' => 'parameter email and password are require',
      ));
    }else{
      $result = $result->fetch();
      $isMatch = $passwordHasher->checkPassword($password,$result["user_hash"]);
      if(!$isMatch){
        $authenFailed = true;
      }else{
        $token = array(
            "iss" => $config["jwt"]["domain"],
            "aud" => $config["jwt"]["domain"],
            "iat" => time(),
            "nbf" => time(),
            "exp" => time()+$config["jwt"]["expire"],
            "data" => array(
              "userId" => $result["user_id"],
            )
        );
        $jwt = JWT::encode($token, $config["jwt"]["secret"]);
        $app->render(200,array(
          'id' => $result["user_id"],
          'username' => $result["user_name"],
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
