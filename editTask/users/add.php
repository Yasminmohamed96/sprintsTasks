<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
require_once(BASE_PATH . '/logic/auth.php');
require_once(BASE_PATH . '/logic/tags.php');
require_once(BASE_PATH . '/logic/categories.php');


if (isset($_REQUEST['name'])) {
    
    $_REQUEST['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $errors = validateUserCreate($_REQUEST);
    if (count($errors) == 0) {

        if (addNewUser($_REQUEST) ){
            header('Location:index.php');
            die();
        } else {
            $generic_error = "Error while adding the user";
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
                        <h4>Add User</h4>
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
                                <input name="name" placeholder="name" class="form-control" />
                                <?= isset($errors['name']) ? "<span class='text-danger'>" . $errors['name'] . "</span>" : "" ?>
                                <textarea name="username" placeholder="username" class="form-control"></textarea>
                                <?= isset($errors['username']) ? "<span class='text-danger'>" . $errors['username'] . "</span>" : "" ?>

                                <input name="password" placeholder="password" class="form-control" />
                                <?= isset($errors['password']) ? "<span class='text-danger'>" . $errors['password'] . "</span>" : "" ?>

                                <label>email<input type="email" name="email" class="form-control"></label>
                                <?= isset($errors['email']) ? "<span class='text-danger'>" . $errors['email'] . "</span>" : "" ?>
                                 
                                <label>phone<input type="number" name="phone" class="form-control"></label>
                                <?= isset($errors['phone']) ? "<span class='text-danger'>" . $errors['phone'] . "</span>" : "" ?>
                                
                                <label>type<input type="number" name="type" class="form-control"></label>
                                <?= isset($errors['type']) ? "<span class='text-danger'>" . $errors['type'] . "</span>" : "" ?>
                                
                                <label>active<input type="number" name="active" class="form-control"></label>
                                <?= isset($errors['active']) ? "<span class='text-danger'>" . $errors['active'] . "</span>" : "" ?>
                                <button class="btn btn-success">Create User</button>
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