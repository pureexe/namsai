<?php
  class Story{
    public static function get($stroyId){
      global $pdo;
      $query = $pdo
        ->select()
        ->from('story')
        ->where('story_id','=',$stroyId);
      $result = $query->execute();
      if($result->rowCount()==0){
        return null;
      }else{
        $result = $result->fetch();
        return array(
          'id'=>intval($result['story_id']),
          'name'=>$result['story_name'],
        );
      }
    }
  }
?>
