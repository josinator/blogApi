<?php

declare(strict_types=1);

namespace Blog\Application\DTO;

use Blog\DomainModel\Post;

class PostItemDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $authorId,
        public readonly string $authorName
    ) {
    }

    public static function builder(Post $post)
    {
        return new self(
            $post->getId(),
            $post->getTitle(),
            $post->getAuthor()->getId(),
            $post->getAuthor()->getName()
        );
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'authorId' => $this->authorId,
            'author' => $this->authorName,
        ];
    }
}
