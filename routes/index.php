<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app,$database) {
    $data = $database->select('repo',array('id','name','owner'),array("AND"=>array('id'=>1,'owner'=>1)));
    $app->render(200,array(
      'message' => $data
    ));
  });
  require('v1/index.php');
?>
