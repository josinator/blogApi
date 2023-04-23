<?php

namespace Blog\DomainModel;

interface PostRepository
{
    public function save(Post $post): void;
    public function remove(Post $post):void;

    public function findById(int $postId): ?Post;

    public function findAll(): array;

    public function findPaginate(int $limit, int $page): array;
}