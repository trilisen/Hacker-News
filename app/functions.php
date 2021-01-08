<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function getPosts($pdo, int $offset)
{
    $offset = $offset * 20;
    $statement = $pdo->prepare('SELECT * FROM posts ORDER BY votes LIMIT 20 OFFSET :offset');
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();

    $posts = $statement->fetch(PDO::FETCH_ASSOC);
    if ($posts) {
        return $posts;
    }
}
