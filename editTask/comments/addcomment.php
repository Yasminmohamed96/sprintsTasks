<?php
require_once('../config.php');
require_once('../logic/posts.php'); 
require_once('../logic/users.php');
function getUserId()
{
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    if (isset($_SESSION['user'])) return $_SESSION['user']['id'];
    return 0;
}  

if (isset($_REQUEST['email'])) {
  $user_id=getUserByEmail($_REQUEST['email']);
  if($user_id!=null){
  addNewComment($_REQUEST,  $_REQUEST['view'], $user_id['id']);
  header('Location:../post-details.php?view='.$_REQUEST['view']);
    die();
  }
  else {
    header('Location:../register.php');
    die();
  }
}
if (!isset($_REQUEST['email'])) {
    $user_id=getUserId();
    addNewComment($_REQUEST,  $_REQUEST['view'], $user_id);
    header('Location:../post-details.php?view='.$_REQUEST['view']);
      die();
    
  }
  
?>