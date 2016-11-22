<?php
//@user
class User
{
  public function add($username,$email,$password,$name)
  {
    global $database;
    $passwordHasher = new Pentagonal\Phpass\PasswordHash(8,false);
    $hash = $passwordHasher->hashPassword($password);
    $data = array(
      'username' => $username,
      'email' => $email,
      'password' => $hash,
      'name' => $name
    );
    $userId = $database->insert('user',$data);
    return $userId;
  }
  public function update()
  {

  }
  public function get($id)
  {
    global $database;
    if(is_numeric($id))
    {
      $data = $database->get('user',array('name','username','bio'),array('id'=>1));
      return $data;
    }
  }
}
?>
