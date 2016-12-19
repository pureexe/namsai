<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app,$database) {
    $data = $database->select('story',array('id','name','repoid'),array(
      'AND'=>array(
          'id'=>11,
          'repoid'=>1,
      )
    ));
    print_r($data);
    exit();
    $app->render(200,$data);
  });
  require('v1/index.php');
?>
