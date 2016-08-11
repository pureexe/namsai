<?php
/*
change fullname
POST: /v1/users/name
PARAMETER:
  - name
  - access_token
RESPONSE:
  - (user) id
*/
$app->post('/name',function() use ($app,$config,$pdo){
  $access_token = $app->request->post('access_token');
  $name = $app->request->post('name');
  $id = jwtToUserId($access_token);
  if($id){
    $query = $pdo->select()->from('user')->where('user_id','=',$id);
    $result = $query->execute()->fetch();
    $pdo
      ->update(array(
        'user_fullname' => $name
      ))
      ->table('user')
      ->where('user_id', '=', $result['user_id'])
      ->execute();
      $app->render(200,array(
        'id'=>$result['user_id'],
      ));
  }else{
    $app->render(401,array(
       'error' => array(
         'code' => 401,
         'message' => 'access_token is invalid'
       )
    ));
  }
});
?>
