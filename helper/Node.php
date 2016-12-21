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
    global $database;
    if(self::getType($nodeId) == 'pattern'){
      $database->update('node',array('value'=>$value,'pattern'=>$IrinLang::toRegex($value)),array('id'=>$nodeId));
    }else{
      $database->update('node',array('value'=>$value),array('id'=>$nodeId));
    }
  }
  /*
  remove: Don't confuse with delete
  */
  public static function remove($nodeId)
  {
    global $database;
    $database->delete('node',array('id'=>$nodeId));
  }
  /*
  delete: Don't confuse with remove
  */
  public static function delete($nodeId){
    //TODO: implement tabel and delete node by node
  }
  public static function get($storyId){
    global $database;
    $data = $database->get(
      'node',
      array('id','repoid','storyid','type','value'),
      array('id'=>$storyId)
    );
    $data['id']=intval($data['id']);
    $data['repoid']=intval($data['repoid']);
    $data['storyid']=intval($data['storyid']);
    return $data;
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
  /*
  isExist
  */
  public static function isExist($storyId,$repoId = null){
    global $database;
    if($repoId != null){
      return $database->has('node',array(
        'AND'=>array(
            'id'=>$storyId,
            'repoid'=>$repoId,
        )
      ));
    }else{
      return $database->has('node',array('id'=>$storyId));
    }
  }
  public static function getType($nodeId){
    global $database;
    $type = $database->get('node','type',array(
      'id' => $nodeId,
    ));
    return ($type)?$type:null;
  }
}

?>
