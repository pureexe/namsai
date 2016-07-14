<?php
$app->post('/register',function() use ($app){
  $email = $app->request->post("email");
  $password = $app->request->post("password");
  if(!$email||!$password){
    $app->render(400,array(
      'error'=>true,
      'error_code'=>1,
      'message'=>'parameter email and password is require for register',
    ));
  }else{
    require("helper/pdo.php");
    $passwordHasher = new Pentagonal\Phpass\PasswordHash(8,false);
    $query = $pdo->select()->from('user')->where('email','=',$email);
    $count = $query->execute()->rowCount();
    if($count!=0){
      $app->render(400,array(
        'error'=>true,
        'error_code'=>2,
        'message'=>'this email has been already register',
      ));
    }else{
      $pdo
        ->insert(array('email', 'hash'))
        ->into('user')
        ->values(array($email,$passwordHasher->hashPassword($password)))
        ->execute();
      $app->render(200,array(
        'message'=>'user '.$email.' register complete',
      ));
    }
  }
});
?>
