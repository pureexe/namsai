<?php
class Response{
  public static function _match($repoId,$input,$currentNode){
    global $pdo;
    if($currentNode!=0){
      $query = $pdo->prepare('SELECT `node_id` FROM `node` JOIN edge ON node.node_id = edge.edge_nodenext WHERE node_repoid = ? AND edge_nodenext IN (SELECT edge_nodenext FROM edge WHERE edge_nodeid = ?) AND ? REGEXP `node_value` ORDER BY edge_order DESC');
      $result = $query->execute(array($repoId,$currentNode,$input));
      if($query->rowCount() == 0){
        $currentNode = 0;
      }else{
        return $result->fetch()['node_id'];
      }
    }
    if($currentNode == 0){
      $query = $pdo->prepare('SELECT `node_id` FROM `node` JOIN edge ON node.node_id = edge.edge_nodenext JOIN story ON node.node_storyid = story.story_id WHERE node_repoid = ? AND edge_nodeid = 0 AND ? REGEXP `node_value` ORDER BY story_order DESC');
      $result = $query->execute(array($repoId,$input));
      if($query->rowCount() == 0){
        return null;
      }else{
        return $query->fetch()['node_id'];
      }
    }
  }
  public static function _getChild($nodeId){
    global $pdo;
    //SELECT * FROM `node` JOIN edge ON node.node_id = edge.edge_nodenext WHERE edge.edge_nodeid = '4' AND node_type != 'pattern'
    $query = $pdo
      ->select(array('node_id','node_type','node_value'))
      ->from('node')
      ->join('edge','node.node_id','=','edge.edge_nodenext')
      ->where('edge_nodeid','=',$nodeId)
      ->where('node_type','!=','pattern');
    $result = $query->execute();
    if($result->rowCount() == 0){
      return null;
    }else{
      $output = array('id'=>$nodeId,'next'=>array());
      $result = $result->fetchAll();
      foreach ($result as $row) {
        $out =  array(
          'id' => $row['node_id'],
          'type'=> $row['node_type'],
          'value'=> $row['node_value'],
        );
        $output['next'][] = $out;
      }
      return $output;
    }
  }
  public static function get($repoId,$userId,$input){
    $cNode = UserSession::getNode($repoId,$userId);
    $cNode = self::_match($repoId,$input,$cNode);
    if(!$cNode){
      return null;
    }
    $output = array();
    while($child = self::_getChild($cNode)){
      $ptr = (count($child['next'])>1)?rand(0,count($child['next'])-1):0;
      if($child['next'][$ptr]['type'] == 'response'){
        $output[] = $child['next'][$ptr]['value'];
      }
      $cNode = $child['next'][$ptr]['id'];
    }
    UserSession::setNode($repoId,$userId,$cNode);
    if(count($output)==0){
      return null;
    }else{
      return $output;
    }
  }
}

?>
