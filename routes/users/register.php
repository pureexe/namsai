<?php
$app->post('/register',function() use ($app,$config,$pdo){
  $email = $app->request->post("email");
  $password = $app->request->post("password");
  $username = $app->request->post("username");
  if(!$email||!$password||!$username){
    $app->render(400,array(
      'error'=>true,
      'error_code'=>1,
      'message'=>'parameter email,username and password is require for register',
    ));
  }else{
    $passwordHasher = new Pentagonal\Phpass\PasswordHash(8,false);
    $query = $pdo->select()->from('user')->where('user_email','=',$email);
    $count = $query->execute()->rowCount();
    if($count!=0){
      $app->render(400,array(
        'error'=>true,
        'error_code'=>2,
        'message'=>'this email has been already register',
      ));
    }else{
      $pdo
        ->insert(array('user_name','user_email', 'user_hash'))
        ->into('user')
        ->values(array($username,$email,$passwordHasher->hashPassword($password)))
        ->execute();
      $app->render(200,array(
        'message'=>'user '.$email.' register complete',
      ));
    }
  }
});
?>
