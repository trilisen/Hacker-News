<?php

declare(strict_types=1);

function redirect(string $path): void
{
    header("Location: ${path}");
    exit;
}

function getPosts(object $pdo, int $offset)
{
    $offset = $offset * 20;
    $statement = $pdo->prepare('SELECT * FROM posts ORDER BY created_at LIMIT 20 OFFSET :offset');
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($posts) {
        return $posts;
    }
}

function getPostInfo(object $pdo, string $post_id): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    $post_info = $statement->fetch(PDO::FETCH_ASSOC);
    return $post_info;
}

function getPostComments(object $pdo, int $post_id): array
{
    // Same as getPostInfo() more or less
    $statement = $pdo->prepare('SELECT * FROM comments WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
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

function checkIfUpvoted(object $pdo, int $post_id): bool
{
    $statement = $pdo->prepare('SELECT * FROM votes WHERE post_id = :post_id AND user_id = :user_id');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $statement->execute();
    if ($statement->fetch()) {
        return true;
    } else {
        return false;
    }
}

function getPostUpvotes(object $pdo, int $post_id): string
{
    $statement = $pdo->prepare('SELECT COUNT(vote_id) AS votes FROM votes WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['votes'];
}
