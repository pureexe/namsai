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
    /*
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
    public static function get($cNode,$nNode = null){
      global $pdo;
      if($nNode!=null){
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
      }else{
        $query = $pdo
          ->select()
          ->from('edge')
          ->where('node_id', '=', $cNode);
        $result = $query->execute();
        if($result->rowCount()>0){
          $output = array('id'=>$cNode,'next'=>array());
          $result = $result->fetchAll();
          foreach ($result as $row) {
            $out =  array(
              'id' => $row['edge_id'],
              'current'=> $row['node_id'],
              'next'=> $row['node_next'],
              'order'=> $row['edge_order'],
            );
            $output['next'][] = $out;
          }
          return $output;
        }else{
          return null;
        }
      }
    }
    public static function isExist($cNode,$nNode){
      return (self::get($cNode,$nNode))?true:false;
    }
    public static function getMaxOrder($cNode){
      $data = self::get($cNode);
      if(!$data){
        return null;
      }
      $out = array();
      foreach($data['next'] as $edge){
        $out[] = $edge['order'];
      }
      return max($out);
    }
    public static function isOrderExist($cNode,$order){
      global $pdo;
      $query = $pdo
        ->select()
        ->from('edge')
        ->where('node_id', '=', $cNode)
        ->where('edge_order','=',$order);
      $result = $query->execute();
      return ($result->rowCount()>0)?true:false;
    }
  }
?>
