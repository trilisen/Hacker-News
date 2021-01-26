<?php require dirname(__DIR__, 1) . '/app/autoload.php'; ?>
<?php require __DIR__ . '/header.php'; ?>


<?php if (isset($_GET['post_id'])) : ?>
    <?php $post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT); ?>

    <?php $post_info = getPostInfo($pdo, $post_id) ?>
    <div class="on-post-container">

        <div class="top-container">
            <!-- Votes -->
            <p class="nmbr-votes"><?= getPostUpvotes($pdo, $post_id) ?></p>

            <!-- Upvote button -->
            <?php if (logged_in()) : ?>
                <?php if (checkIfUpvoted($pdo, $post_id)) : ?>
                    <form action="../app/posts/upvotes.php" method="post" class="votes">
                        <input type="hidden" name="onPost" id="onPost" value="onPost">
                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <button type="submit" name="submit" value="remove" class="votes-button">
                            <div class="arrow-up remove"></div>
                        </button>
                    </form>
                <?php else : ?>
                    <form action="../app/posts/upvotes.php" method="post" class="votes">
                        <input type="hidden" name="onPost" id="onPost" value="onPost">
                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <button type="submit" name="submit" value="add" class="votes-button">
                            <div class="arrow-up"></div>
                        </button>
                    </form>
                <?php endif ?>
            <?php else : ?>
                <div class="votes">
                    <button class="votes-button nonUserUpvote">
                        <div class="arrow-up"></div>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] == $post_info['user_id']) : ?>
                <form action="../app/posts/update.php" method="post" class="form-content">
                    <!-- Title -->
                    <input type="text" name="title" class="title-box" value="<?= $post_info['title'] ?>">

                <?php else : ?>
                    <h1 class="title"><?= $post_info['title'] ?></h1>
                <?php endif ?>

                <!-- Url/link -->
                <?php if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] == $post_info['user_id']) : ?>
                    <input type="url" name="link" id="link" value="<?= $post_info['link'] ?>">
                <?php else : ?>
                    <a href="<?= $post_info['link'] ?>">(<?= substr($post_info['link'], 8, 25) ?>...)</a>
                <?php endif ?>

                <!-- Commit changes -->
                <?php if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] == $post_info['user_id']) : ?>
                    <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
                    <button type="submit" class="button3">Submit changes</button>
                <?php endif ?>

                </form>
        </div>


        <!-- Date -->
        <p>Created on: <?= $post_info['created_at'] ?></p>

        <!-- Created by -->
        <p>Post by: <?= getUserByID($pdo, $post_info['user_id'])['username'] ?></p>

        <!-- Delete post -->
        <?php if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] == $post_info['user_id']) : ?>
            <form action="../app/posts/delete.php" method="post">
                <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
                <button type="submit" class="button3">Delete post</button>
            </form>
        <?php endif ?>
    </div>

    <!-- Post comment -->
    <?php if (isset($_SESSION['user']['user_id'])) : ?>
        <form action="../app/comments/store.php" method="post" class="post-comment">
            <label for="comment">Post a comment</label>
            <br>
            <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
            <textarea name="comment" id="comment" cols="50" rows="10" placeholder="Write your message here..."></textarea>
            <button type="submit" class="button3">Submit</button>
            <?php if (isset($errors['errors']['commentTooLong'])) : ?>
                <small class="error"><?= $errors['errors']['commentTooLong'] ?></small>
            <?php endif ?>
        </form>
    <?php endif; ?>

    <!-- Comments -->
    <?php $comments = getPostComments($pdo, $post_info['post_id']); ?>
    <?php if ($comments) : ?>
        <section class="comment-section">
            <?php foreach ($comments as $comment) : ?>
                <div class="comment">
                    <div class="content">
                        <p class="text"><?= $comment['content'] ?></p>
                        <div class="post-info">
                            <p class="user"><?= getUserByID($pdo, $comment['user_id'])['username'] ?></p>
                            <p class="date"><?= $comment['created_at'] ?></p>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] == $comment['user_id']) : ?>
                        <div class="change-comment">
                            <form action="/views/edit_comment.php" method="post">
                                <input type="hidden" name="edit" value="<?= $comment['content'] ?>">
                                <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
                                <button type="submit" name="submit" value="<?= $comment['comment_id'] ?>" class="button3">Edit comment</button>
                            </form>
                            <form action="../app/comments/delete.php" method="post">
                                <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
                                <button type="submit" name="submit" value="<?= $comment['comment_id'] ?>" class="button3">Delete comment</button>
                            </form>
                        </div>



                        <?php else :
                        if (isset($_SESSION['user']['user_id'])) : ?>
                            <form action="/views/reply_to_comment.php" method="post">
                                <input type="hidden" name="reply_to" value="<?= $comment['content'] ?>">
                                <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
                                <input type="hidden" name="athur" value="<?= getUserByID($pdo, $comment['user_id'])['username'] ?>">
                                <button type="submit" name="submit" value="<?= $comment['comment_id'] ?>" class="button3">Reply to comment</button>
                            </form>
                        <?php endif; ?>
                        <?php $replies = getPostCommentReplies($pdo, $post_info['post_id']); ?>
                        <?php if ($replies) :
                            foreach ($replies as $reply) : ?>
                                <div class="comment comment-reply">
                                    <div class="content">
                                        <p class="text"><?= $reply['content'] ?></p>
                                        <div class="post-info">
                                            <p class="user"><?= getUserByID($pdo, $reply['user_id'])['username'] ?></p>
                                            <p class="date"><?= $reply['created_at'] ?></p>
                                        </div>
                                        <?php if ($_SESSION['user']['user_id'] == $reply['user_id']) : ?>

                                            <form action="/views/edit_comment.php" method="post">
                                                <input type="hidden" name="edit" value="<?= $reply['content']; ?>">
                                                <input type="hidden" name="reply_id" value="<?= $reply['id']; ?>">
                                                <input type="hidden" name="comment_id" value="<?= $comment['comment_id']; ?>">
                                                <input type="hidden" name="post_id" value="<?= $comment['post_id']; ?>">
                                                <button class="button3" type="submit" name="submit" value="edit_reply">Edit Reply</button>
                                                <button class="button3" type="submit" name="submit" value="delete_reply" formaction="/app/comments/delete.php">Delete Reply</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                    <?php endforeach;
                        endif;
                    endif ?>


                </div>
            <?php endforeach ?>
        </section>
    <?php endif ?>

<?php endif ?>

<?php require __DIR__ . '/footer.php'; ?>