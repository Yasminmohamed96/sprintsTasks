<?php

require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
require_once(BASE_PATH . '/logic/auth.php');
require_once(BASE_PATH . '/logic/tags.php');
require_once(BASE_PATH . '/logic/categories.php');

if (!isset($_REQUEST['id'])) {
    header('Location:index.php');
    die();
}
$id = $_REQUEST['id'];
$user = getUserById($id);
if (!checkIfUserIsAdmin($user)) {
    header('Location:index.php');
    die();
}

if (isset($_REQUEST['name'])) {
    $errors = validateUserEdit($_REQUEST);
    if (count($errors) == 0) {
         if (editUser($id,$_REQUEST)) {
        header('Location:index.php');
        die();
    } else {
            $generic_error = "Error while edit the user";
        }
    }
}
require_once(BASE_PATH . '/layout/header.php');
?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Edit User</h4>
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
                        <div class="col-sm-12">
                            <form method="POST" enctype="multipart/form-data">
                                <input name="name" placeholder="name" class="form-control" value="<?= $user['name'] ?>" />
                                <?= isset($errors['name']) ? "<span class='text-danger'>" . $errors['name'] . "</span>" : "" ?>
                                <textarea name="username" placeholder="username" class="form-control"><?= $user['username'] ?></textarea>
                                <?= isset($errors['username']) ? "<span class='text-danger'>" . $errors['username'] . "</span>" : "" ?>
                                 <label>email<input type="email" name="email" class="form-control" value="<?= $user['email'] ?>"></label>
                                <?= isset($errors['email']) ? "<span class='text-danger'>" . $errors['email'] . "</span>" : "" ?>
                          
                                <input name="phone" type="number" placeholder="phone" class="form-control" value="<?= $user['phone'] ?>" />
                                <?= isset($errors['phone']) ? "<span class='text-danger'>" . $errors['phone'] . "</span>" : "" ?>
                          
                                <input name="type" type="number" placeholder="type" class="form-control" value="<?= $user['type'] ?>" />
                                <?= isset($errors['type']) ? "<span class='text-danger'>" . $errors['type'] . "</span>" : "" ?>
                          
                                <input name="active" type="number" placeholder="active" class="form-control" value="<?= $user['active'] ?>" />
                                <?= isset($errors['active']) ? "<span class='text-danger'>" . $errors['active'] . "</span>" : "" ?>
                          
                                <button class="btn btn-success">Edit User</button>
                                <a href="index.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>