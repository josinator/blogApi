<?php

namespace Blog\Application\DTO;

use Blog\DomainModel\Post;

class PostItemDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $authorId,
        public readonly string $authorName
    )
    {
    }

    public static function builder(Post $post){
        return new self(
            $post->id,
            $post->getTitle(),
            $post->getAuthor()->id,
            $post->getAuthor()->getName()
        );
    }

}