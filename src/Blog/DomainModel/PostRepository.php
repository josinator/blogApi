<?php

namespace Blog\DomainModel;

interface PostRepository
{
    public function save(Post $post): void;
    public function remove(Post $post):void;

    public function findById(PostId $postId): Post;

    public function findPaginate(int $limit, int $page): array;
}