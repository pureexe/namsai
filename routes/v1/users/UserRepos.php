<?php
$app->get('/users/:user/repos',function($username) use ($app){
  $app->render(200,array(
    'message'=>'OK',
  ));
});
?>
