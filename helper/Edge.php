<?php
class Edge{
  public static function add($cNode,$nNode,$order = null){
    global $database;
    if($order == null){
      $order = self::getMaxOrder($cNode)+1;
    }
    $node = Node::get($nNode);
    $data = array(
      'storyid'=> $node['repoid'],
      'repoid' => $node['storyid'],
      'nodeid'=>$cNode,
      'nodenext'=>$nNode,
      'priority' => $order
    );
    $edgeId = $database->insert('edge',$data);
    return intval($edgeId);
  }
  public static function remove($cNode,$nNode){
  }
  public static function get($cNode,$nNode = null){
  }
  public static function isExist($edgeId,$repoId){

  }
  public static function hasEdge($cNode,$nNode){
    global $dabase;
    return $database->has('edge',array(
      'AND'=>array(
          'nodeid'=>$cNode,
          'nodenext'=>$nNode,
      )
    ));
  }
  public static function getMaxOrder($cNode){
    global $database;
    $maxId = $database->get('edge','priority',array(
      'nodeid' => $cNode,
      'ORDER' => array(
        'priority' => 'DESC'
      )
    ));
    return intval($maxId);
  }
  public static function isOrderExist($cNode,$order){
    global $dabase;
    return $database->has('edge',array(
      'AND'=>array(
          'nodeid'=>$cNode,
          'nodenext'=>$nNode,
      )
    ));
  }
}
?>
