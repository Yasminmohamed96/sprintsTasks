<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');

function getLine($user)
{
    return "{$user['id']},{$user['name']},{$user['username']},{$user['password']},{$user['email']},{$user['phone']},{$user['type']},{$user['active']}" . PHP_EOL;
}

$users = getAllUsers(10);
$filename = strtotime("now") . ".csv";
$file_path = BASE_PATH . "/files/" . $filename;
$myfile = fopen($file_path, "w+") or die("Unable to open file!");
foreach ($users as $user) {
    fwrite($myfile, getLine($user));
}
fclose($myfile);

header('Content-type: application/octet-stream');
header("Content-Type: " . mime_content_type($file_path));
header("Content-Disposition: attachment; filename=" . $filename);
while (ob_get_level()) {
    ob_end_clean();
}
readfile($file_path);
