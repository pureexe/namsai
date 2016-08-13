<?php
/*
get user information
GET: /v1/users/:user/repos
PARAMETER:
  - access_token (require for view private repo)
RESPONSE:
  - repo (array)
*/
$app->get('/:user/repos',function($username) use ($app,$config,$pdo){
  $access_token = $app->request->get('access_token');
  $app->render(400,array(
    'error' => array(
      'code' => 400,
      'message' => 'Not implement yet'
    )
  ));
});

?>
