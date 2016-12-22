<?php
$app->group('/v1', function () use ($app,$config) {
  require('auth/Login.php');
  require('edges/EdgeAdd.php');
  require('edges/EdgeDelete.php');
  require('nodes/NodeAdd.php');
  require('nodes/NodeDelete.php');
  require('nodes/NodeGet.php');
  require('nodes/NodeUpdate.php');
  require('repos/RepoAdd.php');
  require('repos/RepoDelete.php');
  require('repos/RepoGet.php');
  require('repos/RepoOwner.php');
  require('repos/RepoUpdate.php');
  require('users/UserAdd.php');
  require('users/UserGet.php');
  require('users/UserUpdate.php');
  require('users/UserRepo.php');
  require('story/StoryAdd.php');
  require('story/StoryDelete.php');
  require('story/StoryGet.php');
  require('story/StoryList.php');
  require('story/StoryUpdate.php');
  require('nodes/NodeAdd.php');
});
?>
