<?php
$app->post('/users/:user',function($username) use ($app){
  $app->render(200,array(
    'message'=>'OK',
  ));
});
?>
