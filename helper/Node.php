<?php
class Node
{
  public static function add($storyId,$type,$value = null,$repoId = null)
  {
    global $database;
    if($repoId == null){
      $repoId = Story::getRepoId($storyId);
    }
    if($value == null){
      $value = '';
    }
    if($type=='pattern'){
      //TODO:Need New version of IRIN intergation support
      $data = array(
        'repoid' => $repoId,
        'storyid' => $storyId,
        'type' => $type,
        'value' => $value,
        'pattern' => $IrinLang::toRegex($value)
      );
    }else{
      $data = array(
        'repoid' => $repoId,
        'storyid' => $storyId,
        'type' => $type,
        'value' => $value
      );
    }
    $nodeId = $database->insert('node',$data);
    return intval($nodeId);
  }
  public static function update($nodeId,$value)
  {
    if(self::getType($nodeId) == 'pattern'){

    }else{

    }
  }
  /*
  remove: Don't confuse with delete
  */
  public static function remove($nodeId)
  {

  }
  /*
  delete: Don't confuse with remove
  */
  public static function delete($nodeId){

  }
  /*
  isAcceptType: check node type is support for db
  */
  public static function isAcceptType($type){
    if($type == 'pattern'){
      return true;
    }
    if($type == 'response'){
      return true;
    }
    if($type == 'hook'){
      return true;
    }
    if($type == 'bookmark'){
      return true;
    }
    return false;
  }
}

?>
