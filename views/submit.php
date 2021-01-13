<?php require dirname(__DIR__, 1) . '/app/autoload.php'; ?>
<?php require __DIR__ . '/header.php'; ?>

<?php if (!logged_in()) {
    redirect('/views/login.php');
    exit;
} ?>

<article>
    <h1>Create a post</h1>

    <form action="../app/posts/store.php" method="post">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
            <small>Please provide a title for your post.</small>
        </div>

        <div>
            <label for="link">Link</label>
            <input type="url" name="link" id="link" required>
            <small>Please provide a link/url</small>
        </div>

        <button type="submit">Submit post</button>
    </form>
</article>

<?php require __DIR__ . '/footer.php'; ?>