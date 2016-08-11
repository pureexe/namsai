<?php
    $config = array(
      'db' => array(
        'host' => 'mysql:host=localhost;dbname=namsai;charset=utf8',
        'user' => 'root',
        'password'=> ''
      ),
      'jwt' => array(
        'secret' => 'ThisIs-A-SecretForJWTYouMustChangeInProduction',
        'domain'=>'http://localhost', //use for JWT iss data
        'expire'=>2592000, //Token expire date in 2 month
      ),
      'reserved_username'=>array(
        'username',
        'admin',
        'password',
        'email',
        'bio',
        'register',
        'docs'
      ),
      'english_username' => true,
    );
?>
