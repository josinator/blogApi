<?php

declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\InMemory;

use Blog\DomainModel\Post;
use Blog\DomainModel\PostRepository;

class InMemoryPostRepository implements PostRepository
{

    private int $postsId = 1;
    private array $posts = [];
    public function save(Post $post): Post
    {
        $post->setId($this->postsId++);
        $this->posts[ $post->getId()] = $post;
        return $post;
    }

    public function remove(Post $post): void
    {
        unset($this->posts[$post->getId()]);
    }

    public function findById(int $postId): ?Post
    {
        return $this->posts[$postId] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->posts);
    }
}
