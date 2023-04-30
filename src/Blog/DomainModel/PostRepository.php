<?php

declare(strict_types=1);

namespace Blog\DomainModel;

interface PostRepository
{
    public function save(Post $post): void;

    public function remove(Post $post): void;

    public function findById(int $postId): ?Post;

    public function findAll(): array;
}
