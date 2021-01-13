<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>


<?php if (isset($_GET['post_id'])) : ?>
    <?php $post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT); ?>

    <?php $post_info = getPostInfo($pdo, $post_id) ?>

    <!-- Upvote button -->
    <?php if (logged_in()) : ?>
        <?php if (checkIfUpvoted($pdo, $post_id)) : ?>
            <form action="/app/posts/upvotes.php" method="post">
                <input type="hidden" name="onPost" id="onPost" value="onPost">
                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                <button type="submit" name="submit" id="submit" value="remove">Upvoted</button>
            </form>
        <?php else : ?>
            <form action="/app/posts/upvotes.php" method="post">
                <input type="hidden" name="onPost" id="onPost" value="onPost">
                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                <button type="submit" name="submit" id="submit" value="add"></button>
            </form>
        <?php endif ?>
    <?php endif ?>
    <form action="/app/posts/update.php" method="post">
        <!-- Title -->
        <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
            <input type="text" name="title" id="title" value="<?= $post_info['title'] ?>">
        <?php else : ?>
            <h1><?= $post_info['title'] ?></h1>
        <?php endif ?>

        <!-- Votes -->
        <p><?= getPostUpvotes($pdo, $post_id) ?></p>

        <!-- Url/link -->
        <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
            <input type="url" name="link" id="link" value="<?= $post_info['link'] ?>">
        <?php else : ?>
            <a href="<?= $post_info['link'] ?>"><?= $post_info['link'] ?></a>
        <?php endif ?>

        <!-- Date -->
        <p>Created on: <?= $post_info['created_at'] ?></p>

        <!-- Created by -->
        <p>Post by: <?= getUserByID($pdo, $post_info['user_id'])['username'] ?></p>

        <!-- Commit changes -->
        <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
            <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
            <button type="submit">Submit changes</button>
        <?php endif ?>

    </form>
    <!-- Delete post -->
    <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
        <form action="/app/posts/delete.php" method="post">
            <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
            <button type="submit">Delete post</button>
        </form>
    <?php endif ?>

    <!-- Post comment -->
    <form action="/app/comments/store.php" method="post">
        <label for="comment">Post a comment</label>
        <br>
        <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
        <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Write your message here..."></textarea>
        <button type="submit">Submit</button>
    </form>

    <!-- Comments -->
    <?php $comments = getPostComments($pdo, $post_info['post_id']); ?>
    <?php if ($comments) : ?>
        <section class="comment-section">
            <?php foreach ($comments as $comment) : ?>
                <div class="comment">
                    <?php if ($_SESSION['user']['user_id'] == $comment['user_id']) : ?>
                        <form action="/views/edit_comment.php" method="post">
                            <input type="hidden" name="edit" value="<?= $comment['content'] ?>">
                            <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
                            <button type="submit" name="submit" value="<?= $comment['comment_id'] ?>">Edit comment</button>
                        </form>
                        <form action="/app/comments/delete.php" method="post">
                            <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
                            <button type="submit" name="submit" value="<?= $comment['comment_id'] ?>">Delete comment</button>
                        </form>
                    <?php endif ?>
                    <p class="content"><?= $comment['content'] ?></p>
                    <p class="date"><?= $comment['created_at'] ?></p>
                    <p class="user"><?= getUserByID($pdo, $comment['user_id'])['username'] ?></p>
                </div>
            <?php endforeach ?>
        </section>
    <?php endif ?>

<?php endif ?>

<?php require __DIR__ . '/views/footer.php'; ?>