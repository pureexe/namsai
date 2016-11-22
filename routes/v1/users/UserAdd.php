<?php
$app->post('/users',function() use ($app){
  $app->render(200,array(
    'message'=>'OK',
  ));
});
?>
