<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/posts.php');
require_once(BASE_PATH . '/logic/tags.php');
require_once(BASE_PATH . '/logic/categories.php');
$post_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$categories = getCategories();
if (!isset($_REQUEST['id'])) {
    header('Location:index.php');
    die();
}
function getUserId()
{
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    if (isset($_SESSION['user'])) return $_SESSION['user']['id'];
    return 0;
}
$tags = getTags();
$categories = getCategories();
$old_post_data = getOldPostData(getUserId(), $post_id);

if (isset($_REQUEST['title'])) {
    $errors = validatePostCreate($_REQUEST);
    if (count($errors) == 0) {

        if (updatePost($_REQUEST,  $post_id, getUploadedImage($_FILES))) {
           
            header('Location:index.php');
            die();
        } else {
            $generic_error = "Error while adding the post";
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
                        <h4>Add Post</h4>
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
                                <input name="title" value="<?php echo $old_post_data['title']; ?>" type="text" placeholder="title" class="form-control" />
                                <?= isset($errors['title']) ? "<span class='text-danger'>" . $errors['title'] . "</span>" : "" ?>

                                <textarea name="content" placeholder="content" class="form-control"><?php echo $old_post_data['content'] ?></textarea>
                                <?= isset($errors['content']) ? "<span class='text-danger'>" . $errors['content'] . "</span>" : "" ?>

                                <label>Upload Image<input type="file" value="<?php echo BASE_URL.'/post_images/'.$old_post_data['image']; ?>" name="image" /></label><br />
                                <?= isset($errors['image']) ? "<span class='text-danger'>" . $errors['image'] . "</span>" : "" ?>

                                <label>Publish date<input type="date" value="<?php echo date('Y-m-d', strtotime($old_post_data['publish_date'])); ?>" name="publish_date" class="form-control"></label>
                                <?= isset($errors['publish_date']) ? "<span class='text-danger'>" . $errors['publish_date'] . "</span>" : "" ?>

                                <select name="category_id" class="form-control" value="">
                                    <option value="">Select category</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        echo "<option " . ($category['id'] == $old_post_data['category_id'] ? "selected" : "") . " value='{$category['id']}'>{$category['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['category_id']) ? "<span class='text-danger'>" . $errors['category_id'] . "</span>" : "" ?>

                                <select name="tags[]" multiple class="form-control" value="">
                                    <?php
                                    foreach ($tags as $tag) {
                                        if (count($tags) > 0) {
                                            foreach ($old_post_data['tags'] as $oldTag) {
                                                if ($tag['id'] == $oldTag['tag_id']) {
                                                    $flag=true;
                                                    echo "<option selected value='{$tag['id']}'>{$tag['name']}</option>";
                                                } 
                                            }
                                            if ($flag==true){ $flag =false;continue;}
                                            else {echo "<option value='{$tag['id']}'>{$tag['name']}</option>";}
                                        } else {
                                            echo "<option value='{$tag['id']}'>{$tag['name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['tags']) ? "<span class='text-danger'>" . $errors['tags'] . "</span>" : "" ?>

                                <button class="btn btn-success">Update Post</button>
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