<?php
/**
* @class Repo
**/
class Repo
{
  public function add($ownerId,$name,$description)
  {
    global $database;
    $data = array(
      'owner'=>$ownerId,
      'name'=>$name,
      'description'=>$description
    );
    $repoId = $database->insert('repo',$data);
    return $repoId;
  }
  public function update($id,$data)
  {
    global $database;
    if(is_numeric($id)){
      $where = array('id' => $id);
    }else{
      $where = array('name' => $id);
    }
    $output = $database->update('repo', $data, $where);
    return $output;
  }
  public function get($id)
  {
    global $database;
    if(is_numeric($id)){
      $where = array('id' => $id);
    }else{
      $where = array('name' => $id);
    }
    $fields = array('id','name','description','owner');
    $data = $database->get('repo',$fields,$where);
    if($data == false){
      return null;
    }
    $data['id'] = intval($data['id']);
    return $data;
  }
  public function delete($id)
  {
    global $database;
    if(is_numeric($id)){
      $where = array('id' => $id);
    }else{
      $where = array('name' => $id);
    }
    $data = $database->delete('repo',$where);
    return $data;
  }
  /**
  * check malform username
  **/
  public function isUsernameMalform($username)
  {
    if(is_numeric($username)){
      return true;
    }
    return false;
  }
  public function isExist($name)
  {
    global $database;
    $data = array('name'=>$name);
    $count = $database->count("repo",$data);
    return ($count>0)?true:false;
  }
  public static function isReserved($username){
    global $config;
    return (array_search($username, $config['reserved_username']) !== false)?true:false;
  }
  public function hasWritePermission($repoId,$user){
    global $database;
    $userId = 0;
    if(is_numeric($user)){
      $userId = intval($user);
    }else{
      $userId = intval(User::get($user)['id']);
    }
    return $database->has('repo',array(
      'AND'=>array(
        'id'=>$repoId,
        'owner'=>$userId
      )
    ));
  }
  public function hasReadPermission($repoId,$user){
    global $database;
    $userId = 0;
    if(is_numeric($user)){
      $userId = intval($user);
    }else{
      $userId = intval(User::get($user)['id']);
    }
    return $database->has('repo',array(
      'AND'=>array(
        'id'=>$repoId,
        'owner'=>$userId
      )
    ));
  }

}
?>
