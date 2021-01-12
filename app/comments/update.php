<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/login.php');
    exit;
}

redirect('/post.php?post_id=' . $post_id);
