<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {
    $_SESSION['feed'] = 'mostUpvoted';
};

redirect('/');
