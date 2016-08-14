<?php
class Repo{

  /*
  Intanal use only
  Chnage /:user/:repo to repoId
  */
  public static function __getId($username,$reponame){
    global $pdo;
    $userId = User::getId($username);
    $query = $pdo
      ->select(array('repo_id'))
      ->from('repo')
      ->where('repo_name','=',$reponame)
      ->where('repo_ownerid','=',$userId);
    $result = $query->execute();
    if($result->rowCount()!=0){
      return $result->fetch()['repo_id'];
    }else{
      return null;
    }
  }

  /*
  GET repoId from /:user/:repo
  */
  public static function getId($username,$reponame,$userId = null){
    $repoId = self::__getId($username,$reponame);
    if(self::isPrivate($repoId)){
      if(self::canAccess($repoId,$userId)){
        return $repoId;
      }else{
        return null;
      }
    }else if($repoId){
      return $repoId;
    }else{
      return null;
    }
  }

  /*
  Check is private repo
  */
  public static function isPrivate($repoId){
    global $pdo;
    $query = $pdo
      ->select(array('repo_private'))
      ->from('repo')
      ->where('repo_id','=',$repoId);
    $result = $query->execute();
    if($result->rowCount() == 0){
      return null;
    }else{
      $result = $result->fetch();
      if($result['repo_private'] == 0){
        return false;
      }else{
        return true;
      }
    }
  }

  /*
  Check is user accessible to repo
  */
  public static function canAccess($repoId,$userId){
    global $pdo;
    if(!$userId){
      return false;
    }
    $query = $pdo
      ->select()
      ->from('repo')
      ->where('repo_id','=',$repoId)
      ->where('repo_ownerid','=',$userId);
    $result = $query->execute();
    if($result->rowCount()!=0){
      return true;
    }
    $query = $pdo
      ->select()
      ->from('contributor')
      ->where('repo_id','=',$repoId)
      ->where('user_id','=',$userId);
    $result = $query->execute();
    if($result->rowCount()!=0){
      return true;
    }else{
      return false;
    }
  }

  /*
  get Repo data
  Warning: get is raw query don't use directly
  */
  public static function get($repoId){
    global $pdo;
    $query = $pdo
      ->select()
      ->from('repo')
      ->where('repo_id','=',$repoId);
    $result = $query->execute();
    if($result->rowCount()==0){
      return null;
    }else{
      return $result->fetch();
    }
  }

  /*
  DELTE Repo
  */
  public static function remove($repoId){
    global $pdo;
    $query = $pdo
      ->delete()
      ->from('repo')
      ->where('repo_id', '=', $repoId);
    $query->execute();
  }

  /*
  GET owner
  */
  public static function getOwner($repoId){
    global $pdo;
    $query = $pdo
      ->select(array('repo_ownerid'))
      ->from('repo')
      ->where('repo_id','=',$repoId);
    $result = $query->execute();
    if($result->rowCount()==0){
      return null;
    }else{
      return $result->fetch()['repo_ownerid'];
    }
  }
  /*
  Check repo name isAvaliable
  */
  public static function isAvaliable($repoName,$userId){
    global $pdo;
    $query = $pdo
      ->select()
      ->from('repo')
      ->where('repo_ownerid','=',$userId)
      ->where('repo_name','=',$repoName);
    $result = $query->execute();
    if($result->rowCount()==0){
      return true;
    }else{
      return false;
    }
  }
  /*
  Add new Repo
  $Data = array($userid,$name,$description,$private);
  */
  public static function add($Data){
    global $pdo;
    $query = $pdo
      ->insert(array('repo_ownerid', 'repo_name','repo_description','repo_private'))
      ->into('repo')
      ->values($Data);
    $result = $query->execute();
    return $pdo->lastInsertId();
  }
  public static function setPrivate(){

  }
  public static function getPrivate($repoId){
    global $pdo;
    $query = $pdo
      ->select(array('repo_private'))
      ->from('repo')
      ->where('repo_id','=',$repoId);
    $result = $query->execute();
    if($result->rowCount()==0){
      return null;
    }else{
      $result = $result->fetch();
      return ($result["repo_private"]==0)?false:true;
    }

  }
  public static function setDescription(){

  }
  public static function getDescription(){

  }
}
?>
