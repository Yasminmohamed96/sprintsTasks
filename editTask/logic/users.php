<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getAllUsers(
    $page_size,
    $page = 1,
    $q = null,
    $order_field = "name",
    $order_by = "desc",
    $block_by_user_id = null,
    $follow_by_me=null
) {

    $offset = ($page - 1) * $page_size;
    $types = '';
    $vals = [];
    $sql = "SELECT  *
    FROM users WHERE 1=1";
    if ($q != null) {
        $types .= 'ssi';
        
        array_push($vals, '%' . $q . '%');
        array_push($vals, '%' . $q . '%');
        array_push($vals, '%' . $q . '%');
        
        $sql .= " AND ( username like ? OR email like ? OR phone like ?)";
    }
    $sql .= " ORDER BY $order_field $order_by limit $offset,$page_size";
    
    $users =  getRows($sql,$types, $vals);

    for ($i = 0; $i < count($users); $i++) {
        if ($block_by_user_id) {
            $users[$i]['block_by_me'] = getIfBlockedByMe($users[$i]['id'], $block_by_user_id);
        } else
        {$users[$i]['block_by_me'] = false;}
        if ($follow_by_me) {
            $users[$i]['follow_by_me'] = getIfFollowedByMe($follow_by_me,$users[$i]['id']);
        } else
            $users[$i]['follow_by_me'] = false;    
    }

    return $users;
}

function getIfFollowedByMe($myid, $user_id)
{
    $sql = "SELECT id FROM follows WHERE follower_id=? and following_id=?";
    return getRow($sql, 'ii', [$myid, $user_id]) != null;
}
function getIfBlockedByMe($user_id, $admin_id)
{
    $sql = "SELECT id FROM blocks WHERE user_id=? and admin_id=?";
    return getRow($sql, 'ii', [$user_id, $admin_id]) != null;
}
function getUsersCount()
{
    $sql = "SELECT count(0) as cnt FROM users"; 
        return  getRow($sql)['cnt'];
}
function addNewUser($request)
{
    $sql = "INSERT INTO users (id,name,username,password,email,phone,type,active)
    VALUES (null,?,?,?,?,?,?,?)";
    $post_id = addData($sql, 'ssssiii', [
        $request['name'],
        $request['username'],
        $request['password'],
        $request['email'],
        $request['phone'],
        $request['type'],
        $request['active'],
    ]);
    
  return true;
}
function editUser($id, $request)
{
    $types = 'sssiiii';
    $vals = [$request['name'], $request['username'], $request['email'], $request['phone'], $request['type'], $request['active'],$id];
    $sql = "UPDATE users SET name=?,username=?,email=?,phone=?,type=?,active=? WHERE id=?";
    
    return editData($sql, $types, $vals);
}
function blockUser($user_id, $admin_id)
{
    $sql = "INSERT INTO blocks (id,user_id,admin_id) VALUES (null,?,?)";
    execute($sql, 'ii', [$user_id, $admin_id]);
}
function unblockUser($user_id, $admin_id)
{
    $sql = "DELETE FROM blocks WHERE user_id=? AND admin_id=?";
    execute($sql, 'ii', [$user_id, $admin_id]);
}


function getUserById($id)
{
    $sql = "SELECT * FROM users WHERE id=?";
    $user = getRow($sql, 'i', [$id]);
   
    return $user;
}
function getUserByEmail($email)
{
    $sql = "SELECT * FROM users WHERE email=?";
    $user = getRow($sql, 's', [$email]);
   
    return $user;
}
function checkIfUserIsAdmin($user)
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!isset($_SESSION['user']))
        return false;
    return $_SESSION['user']['type'] == 1;
}

function validateUserCreate($request)
{
    $errors = [];
    return $errors;
}
function validateUserEdit($request)
{
    return validateUserCreate($request);
}

function followUser($myid, $user_id)
{
    $sql = "INSERT INTO follows (id,follower_id ,following_id) VALUES (null,?,?)";
    execute($sql, 'ii', [$myid, $user_id]);
}
function unfollowUser($myid, $user_id)
{
    $sql = "DELETE FROM follows WHERE follower_id=? AND following_id=?";
    execute($sql, 'ii', [$myid, $user_id]);
}
function deleteUser($id)
{
    $sql = "DELETE FROM users WHERE id=?";
    execute($sql, 'i', [$id]);
}
?>