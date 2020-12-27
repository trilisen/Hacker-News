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
    </ul>
</nav>