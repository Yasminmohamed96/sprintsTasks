<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getAllUsers(
    $page_size,
    $page = 1,
    $q = null,
    $order_field = "name",
    $order_by = "desc",
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

    return $users;
}
function getUsersCount()
{
    $sql = "SELECT count(0) as cnt FROM users"; 
        return  getRow($sql)['cnt'];
}
?>