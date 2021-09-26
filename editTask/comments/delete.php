<?php

require_once('../config.php');
require_once(BASE_PATH . '/logic/posts.php');
require_once(BASE_PATH . '/logic/auth.php');
if (!isset($_REQUEST['id'])) {
    header('Location:index.php');
    die();
}
$id = $_REQUEST['id'];
$post_id=$_REQUEST['post_id'];
deleteComment($id);
header("Location:../post-details.php?view=".$post_id);
die();
