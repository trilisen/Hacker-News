<nav>
    <a href="/" class="logo"><?= $config['title']; ?></a>
    <div class="link-container">
        <a href="/">Home</a>
        <a href="/about.php">About</a>
        <?php if (logged_in()) : ?>
            <a href="/app/users/logout.php"> Logout</a>
        <?php else : ?>
            <a href="/login.php">Login</a>
        <?php endif ?>
        <?php if (logged_in()) : ?>
            <a href="/profile.php">Profile</a>
            <a href="/submit.php">Submit a post</a>
        <?php endif ?>

    </div>
</nav>