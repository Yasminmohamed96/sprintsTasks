<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getAllUsers(
    $page_size,
    $page = 1,
    $q = null,
    $order_field = "name",
    $order_by = "desc",
    $block_by_user_id = null
) {

    $offset = ($page - 1) * $page_size;
    $types = '';
    $vals = [];
    $sql = "SELECT * FROM users WHERE 1=1";
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
            $users[$i]['block_by_me'] = false;
    }

    return $users;
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

?>