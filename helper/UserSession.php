<?php
  class UserSession{
    private static function __add($repoId,$interactorId){
      global $pdo;
      
    }
    private static function __get($repoId,$interactorId){
      global $pdo;
      $query = $pdo
        ->select()
        ->from('session')
        ->where('repo_id','=',$repoId)
        ->where('interactor_id','=',$interactor_id)
        ->where('session_update','<','DATE_SUB(NOW(),INTERVAL 5 MINUTE)');
      $result = $query->execute();
      if($result->rowCount()==0){
        return null;
      }else{
        $result = $result->fetch();
        return array(
          'id' => $result['session_id'],
          'repo' => $result['repo_id'],
          'interactor'=>$result['interactor_id'],
          'node'=>$result['session_node'],
          'session_update'=>$result['session_update'],
        );
      }
    }
    private static function __extendLife($id,$repoId){
      global $pdo;
      $pdo
        ->$query = $pdo
          ->update(array('repo_id' => $repoId))
          ->table('session')
          ->where('session_id', '=', $id);
        $result = $query->execute();
    }
    public static function getId($repoId,$interactorId){
      $data = self::__get($repoId,$interactorId);
      $id = null;
      if(!$data){
        $id = self::__add($repoId,$interactorId);
      }else{
        $id = $data['id']
        self::__extendLife($data['id'],$data['repo']);
      }
      return $id;
    }
    public static function getNode($repoId,$interactorId){
      $data = self::__get($repoId,$interactorId);
      if(!$data){
        $id = self::__add($repoId,$interactorId);
        return 0;
      }else{
        self::__extendLife($data['id'],$data['repo']);
        $data['node']
      }
    }
    public static function setNode($repo,$interactorId,$node){
      global $pdo;
      $id = self::getId($repo,$interactorId);
      $query = $pdo
        ->$query = $pdo
        ->update(array('story_node' => $node))
        ->table('session')
        ->where('session_id', '=', $id);
      $result = $query->execute();
    }
  }
?>
