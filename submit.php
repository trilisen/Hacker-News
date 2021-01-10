<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!logged_in()) {
    redirect('/login.php');
} ?>

<article>
    <h1>Create a post</h1>

    <form action="/app/posts/store.php" method="post">
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

<?php require __DIR__ . '/views/footer.php'; ?>