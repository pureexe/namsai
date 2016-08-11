<?php
/*
Register new user
POST: /v1/users
PARAMETER:
  - name
  - email
  - username
  - password
RESPONSE:
  - id
*/
$app->post('/',function() use ($app,$config,$pdo){
  $email = $app->request->post("email");
  $password = $app->request->post("password");
  $username = $app->request->post("username");
  $name = $app->request->post("name");
  if(!$email||!$password||!$username||!$name){
    $app->render(400,array(
      'error'=>array(
        'code'=>4,
        'message'=>'parameter name,email,username and password is require for register',
      ),
    ));
  }else{
    $passwordHasher = new Pentagonal\Phpass\PasswordHash(8,false);
    $query = $pdo->select()->from('user')->where('user_email','=',$email);
    $count = $query->execute()->rowCount();
    if($count!=0){
      $app->render(400,array(
        'error'=>array(
          'code'=>5,
          'message'=>'this email has been already register',
        ),
      ));
    }else{
      $query = $pdo->select()->from('user')->where('user_name','=',$username);
      $count = $query->execute()->rowCount();
      if($count!=0){
        $app->render(400,array(
          'error'=>array(
            'code'=>6,
            'message'=>'this username has been already register',
          ),
        ));
      }else{
        if(($pos = array_search($username, $config['reserved_username'])) !== false){
          $app->render(400,array(
            'error'=>array(
              'code'=>7,
              'message'=>'username '.$username.' is reserved for system',
            ),
          ));
        }else{
          $pdo
            ->insert(array('user_name','user_email','user_fullname','user_hash'))
            ->into('user')
            ->values(array($username,$email,$name,$passwordHasher->hashPassword($password)))
            ->execute();
          $app->render(200,array(
            'id'=>intval($pdo->lastInsertId())
          ));
        }
      }
    }
  }
});
?>
