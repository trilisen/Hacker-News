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
            <?php if (isset($_SESSION['user'])) : ?>
                <a href="/app/users/logout.php"> Logout</a>
            <?php else : ?>
                <a href="/login.php">Login</a>
            <?php endif ?>
        </li>
        <?php if (isset($_SESSION['user'])) : ?>
            <li>
                <a href="/profile.php">Profile</a>
            </li>
            <li>
                <a href="/post.php">Submit a post</a>
            </li>
        <?php endif ?>

    </ul>
</nav>