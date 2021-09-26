<?php
require_once('config.php');
require_once(BASE_PATH . '/logic/users.php');
require_once(BASE_PATH . '/layout/header.php');
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
$page_size = 10;
$order_field = isset($_REQUEST['order_field']) ? $_REQUEST['order_field'] : 'name';
$order_by = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : 'asc';
$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
function getUrl($page, $q, $order_field, $order_by)
{
    return "allusers.php?page=$page&q=$q&order_field=$order_field&order_by=$order_by";
}
function getSortingUrl($field, $oldOrderField, $oldOrderBy, $q)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "allusers.php?page=1&q=$q&order_field=$field&order_by=desc";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "allusers.php?page=1&q=$q";
    }
    return  "allusers.php?page=1&q=$q&order_field=$field&order_by=asc";
}

function getSortFlag($field, $oldOrderField, $oldOrderBy)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "<i class='fa fa-sort-up'></i>";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "<i class='fa fa-sort-down'></i>";
    }
    return  "";
}
function getUserId()
{
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    if (isset($_SESSION['user'])) return $_SESSION['user']['id'];
    return 0;
}
$users = getAllUsers($page_size,$page,$q,$order_field,$order_by,getUserId(),getUserId());

// `name`, `username`, `password`, `email`, `phone`, `type`, `active`
$page_count = ceil(getUsersCount() / $page_size);
/*
$posts = ['data'=>[],'count'=>100,'order_field'=>'title','order_by'=>'asc']
*/

?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>ALL Users</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="blog-posts">
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sidebar-item search">
                                <form id="search_form" name="gs" method="GET" action="<?= BASE_URL . 'allusers.php' ?>">
                                    <input type="text" value="<?= isset($_REQUEST['q']) ? $_REQUEST['q'] : '' ?>" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                                    <button type='submit' class='btn btn-primary'>Search</button>
                                </form>
                            </div>
                        </div>
                       
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><a href="<?= getSortingUrl('name',  $order_field, $order_by,$q) ?>">Name <?= getSortFlag('name', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('username', $order_field, $order_by, $q) ?>">User Name <?= getSortFlag('username', $order_field, $order_by) ?></a></th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($users as $user) {
                                    $followID="follow_btn_".$user['id'];
                                    $followDISPLAY=!$user['follow_by_me'] ? "block" : "none" ;
                                    $unfollowID="unfollow_btn_".$user['id'];
                                    $unfollowDISPLAY=!$user['follow_by_me'] ? "none" : "block" ;
                                    echo "<tr>
                                    <td>$i</td>
                                    <td>{$user['name']}</td>
                                    <td>{$user['username']}</td>
                                    
                                    <td>
                                   
                                    <button id={$followID} class ='btn' type='button' onclick='followUser({$user['id']})' style='display:{$followDISPLAY}'>Follow</button>
                                    <button id={$unfollowID} class ='btn' type='button' onclick='unfollowUser({$user['id']})' style='display:{$unfollowDISPLAY}'>unfollow</button>
                                    </td></tr>";

                                    $i++;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <ul class="page-numbers">
                            <?php
                            $prevUrl = getUrl($page - 1, $q, $order_field, $order_by);
                            $nxtUrl = getUrl($page + 1, $q, $order_field, $order_by);

                            if ($page > 1) echo "<li><a href='{$prevUrl}'><i class='fa fa-angle-double-left'></i></a></li>";

                            for ($i = 1; $i <= $page_count; $i++) {
                                $url = getUrl($i, $q, $order_field, $order_by);
                                echo "<li class=" . ($i == $page ? "active" : "") . "><a href='{$url}'>{$i}</a></li>";
                            }

                            if ($page < $page_count) echo "<li><a href='{$nxtUrl}'><i class='fa fa-angle-double-right'></i></a></li>";
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>