<?php
require_once('config.php');
require_once('logic/posts.php');
require_once('logic/auth.php');
require_once('logic/tags.php');
require_once('logic/users.php');
require_once('logic/categories.php');

$id = (isset($_REQUEST['view']) ? $_REQUEST['view'] : "");


$tags = getTags();
$categories = getCategories();
$post = getPostToView($id);
$comments = getPostComments($id,getUserId());

?>
<?php require_once('layout/header.php'); ?>



<section class="blog-posts grid-system">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="all-blog-posts">
          <div class="row">
            <div class="col-lg-12">
              <div class="blog-post">
                <div class="blog-thumb">
                  <?php
                  $img_src = BASE_URL . '/post_images/' . $post['image'];
                  ?>
                  <img src=<?= $img_src; ?> alt="">
                </div>
                <div class="down-content">
                  <span><?= $post['category_name']; ?></span>
                  <a>
                    <h4><?= $post['title']; ?></h4>
                  </a>
                  <ul class="post-info">
                    <li><a href="#"><?= $post['user_name']; ?></a></li>
                    <li><a href="#"><?= $post['publish_date']; ?></a></li>
                    <li><a href="#"><?= $post['comments']; ?> Comments</a></li>
                  </ul>
                  <p><?= $post['content']; ?></p>
                  <?php
                                        if ($post['tags']) {
                                        ?>
                                            <div class="post-options">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i></li>
                                                            <?php
                                                            foreach ($post['tags'] as $tag) {
                                                            ?>
                                                                <li><a href="<?= BASE_URL."/posts.php?tag_id={$tag['id']}"?>"><?= $tag['name'] ?></a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                      

            <div class="col-lg-12">
              <div class="sidebar-item comments">
                <div class="sidebar-heading">
                  <h2><?= $post['comments']; ?> comments</h2>
                </div>
                <div class="content">
                  <ul>
                    <?php
                    foreach ($comments as $comment) {
                     
                    ?>
                      <li>

                        <div class="right-content">
                          <h4><?= $comment['username']; ?><span><?= $comment['comment_date']; ?></span></h4>
                          <p><?= $comment['comment']; ?></p>
                      <?php if (thisIsMyPost($id,getUserId()))
                      {
                        echo"
                        <a onclick=return confirm(\"Are you sure ?\")' href='comments/delete.php?id={$comment['id']}&post_id={$id}' class='btn btn-danger'>Delete</a>";
                      }
                      ?>
                          <button id="likeComment_btn_<?= $comment['id'] ?>" class="btn" type="button" onclick="likeComment(<?= $comment['id']; ?>)" style="display:<?= !$comment['likedComment_by_me'] ? "block" : "none" ?>">Like</button>
                          <button id="unlikeComment_btn_<?= $comment['id'] ?>" class="btn" type="button" onclick="unlikeComment(<?= $comment['id']; ?>)" style="display:<?= !$comment['likedComment_by_me'] ? "none" : "block" ?>">UnLike</button>

                        
                        </div>

                
                      </li>
                      <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="sidebar-item submit-comment">
                <div class="sidebar-heading">
                  <h2>Your comment</h2>
                </div>
                <div class="content">
                  <form id="comment" action="comments/addcomment.php?view=<?=$id;?>" method="post">
                    <div class="row">
                     <?php
                     if (session_status() != PHP_SESSION_ACTIVE) session_start();
                     if (!isset($_SESSION['user']))
                     {
                       echo"<div class='col-md-6 col-sm-12'>
                      <input name='email' type='email' id='email' placeholder='Your email' required>
                     </div>";
                     }
                     ?>
                      <div class="col-lg-12">
                        <fieldset>
                          <textarea name="comment" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                        </fieldset>
                        <fieldset>
                          <input name="date"type="date" rows="6" id="date" placeholder="" required=""></input>
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                          <button type="submit" id="form-submit" class="main-button">Submit</button>
                        </fieldset>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     
</section>

<?php require_once('layout/footer.php') ?>