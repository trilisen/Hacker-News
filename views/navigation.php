<nav>
    <a href="/" class="logo"><?= $config['title']; ?></a>
    <div class="link-container">
        <a href="/">Home</a>
        <a href="/about.php">About</a>
        <?php if (logged_in()) : ?>
            <a href="/app/users/logout.php"> Logout</a>
        <?php else : ?>
            <a href="/views/login.php">Login</a>
        <?php endif ?>
        <?php if (logged_in()) : ?>
            <a href="/views/profile.php">Profile</a>
            <a href="/views/submit.php">Submit a post</a>
        <?php endif ?>
    </div>

</nav>