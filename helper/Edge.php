<?php
  class Edge{
    /*add*/
    public static function add($cNode,$nNode,$order){
      global $pdo;
      $query = $pdo->insert(array('node_id','node_next','edge_order'))
                ->into('edge')
                ->values(array($cNode,$nNode,$order));
      $query->execute();
      return $pdo->lastInsertId();
    }
    public static function remove($cNode,$nNode){
      global $pdo;
      $query = $pdo
        ->delete()
        ->from('edge')
        ->where('node_id', '=', $cNode)
        ->where('node_next','=',$nNode);
      $query->execute();
    }
    /*delete
    public static function next($cNode){
      global $pdo;
      $query = $pdo
        ->select()
        ->from('edge')
        ->where('node_id', '=', $cNode)
        ->where('node_next','=',$nNode);
      $result = $query->execute();
      $result = $query->execute()->fetchAll();
      $EdgeData = array('current'=>$cNode);
      $nextNode = array();
      foreach ($result as $row) {
        $nextNode[] = $row['node_next'];
      }
      $EdgeData['next']=$nextNode;
      return $EdgeData;
    }
    */
    public static function get($cNode,$nNode){
      global $pdo;
      $query = $pdo
        ->select()
        ->from('edge')
        ->where('node_id', '=', $cNode)
        ->where('node_next','=',$nNode);
      $result = $query->execute();
      if($result->rowCount()>0){
        $result = $result->fetch();
        return array(
          'id' => $result['edge_id'],
          'current'=> $result['node_id'],
          'next'=> $result['node_next']
        );
      }else{
        return null;
      }
    }
    public static function isExist($cNode,$nNode){
      return (self::get($cNode,$nNode))?true:false;
    }
  }
?>
