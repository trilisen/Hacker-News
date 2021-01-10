<nav>
    <a href="#"><?= $config['title']; ?></a>
    <ul>
        <li>
            <a href="/index.php">Home</a>
        </li>
        <li>
            <a href="/about.php">About</a>
        </li>
        <li>
            <?php if (logged_in()) : ?>
                <a href="/app/users/logout.php"> Logout</a>
            <?php else : ?>
                <a href="/login.php">Login</a>
            <?php endif ?>
        </li>
        <?php if (logged_in()) : ?>
            <li>
                <a href="/profile.php">Profile</a>
            </li>
            <li>
                <a href="/post.php">Submit a post</a>
            </li>
        <?php endif ?>

    </ul>
</nav>