<?php
  //route: /
  $app->get('/', function() use ($app) {
    $app->render(200,array(
      'message' => 'NAMSAI RESTful system'
    ));
  });
  $app->get('/test', function() use ($app,$database) {
    $data = $database->get('edge',array('id','repoid','storyid','nodeid','nodenext','priority(order)'),array(
      'AND'=>array(
          'nodeid'=>0,
          'nodenext'=>3,
      )
    ));
    $app->render(200,$data);
  });
  require('v1/index.php');
?>
