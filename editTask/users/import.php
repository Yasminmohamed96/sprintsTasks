<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');

function getuserRequest($line)
{
    $vals  = explode(',', $line);
    return [
        'name' => $vals[1],
        'username' => $vals[2],
        'password' => $vals[3],
        'email' => $vals[4],
        'phone' => $vals[5],
        'type' => $vals[6],
        'active' => $vals[7]
    ];
}

function getUserIdFromLine($line)
{
    $vals = explode(',', $line);
    return $vals[7];
}

$file_path = $_FILES['csv']['tmp_name'];
$myfile = fopen($file_path, "r") or die("Unable to open file!");
$content = fread($myfile, filesize($file_path));
fclose($myfile);

$lines = explode(PHP_EOL, $content);
foreach ($lines as $line) {
    if ($line == '')
        continue;
    $request = getuserRequest($line);
    $user_id = getUserIdFromLine($line);
    addNewUser($request, $user_id);
}

header('Location:index.php');
die();
