<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/users/login.php" method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="francis@darjeeling.com" required>
            <small>Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <small>Please provide your password.</small>
        </div><!-- /form-group -->

        <button type="submit">Login</button>
    </form>
</article>

<article>
    <h1>Register</h1>
    <form action="app/users/register.php" method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Francis" required>
            <small>Please provide your username.</small>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="francis@darjeeling.com" required>
            <small>Please provide the email address.</small>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <small>Please provide your password.</small>
        </div>

        <div>
            <label for="pass-confirm">Confirm password</label>
            <input type="password" name="pass-confirm" id="pass-confirm" required>
            <small>Please confirm your password.</small>
        </div>
        <button type="submit">Register</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>