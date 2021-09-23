<?php

require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
require_once(BASE_PATH . '/logic/auth.php');
if (!isset($_REQUEST['id'])) {
    header('Location:index.php');
    die();
}
$id = $_REQUEST['id'];
$user = getUserById($id);
if (!checkIfUserIsAdmin($post)) {
    header('Location:index.php');
    die();
}
deletePost($id);
header('Location:index.php');
die();
