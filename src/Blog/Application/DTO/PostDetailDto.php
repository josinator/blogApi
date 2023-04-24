<?php

namespace Blog\Application\DTO;

use Blog\DomainModel\Post;

class PostDetailDto
{

    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $description,
        public readonly int $authorId,
        public readonly string $author
    )
    {
    }


    public static function builder(Post $post){
        return new self(
            $post->id,
            $post->getTitle(),
            $post->getDescription(),
            $post->getAuthor()->id,
            $post->getAuthor()->getName(),

        );
    }
}