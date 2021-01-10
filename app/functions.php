<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function getPosts(object $pdo, int $offset)
{
    $offset = $offset * 20;
    $statement = $pdo->prepare('SELECT * FROM posts ORDER BY votes LIMIT 20 OFFSET :offset');
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($posts) {
        return $posts;
    }
}

function getPostInfo(object $pdo, int $post_id): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    $post_info = $statement->fetch(PDO::FETCH_ASSOC);
    return $post_info;
}

function getPostComments(object $pdo, int $post_id)
{
    // Same as getPostInfo() more or less
}

function getUserByID(object $pdo, int $user_id): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function logged_in(): bool
{
    return isset($_SESSION['user']);
}
