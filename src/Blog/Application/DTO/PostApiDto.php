<?php

declare(strict_types=1);

namespace Blog\Application\DTO;

use Blog\DomainModel\Post;

class PostApiDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $description,
        public readonly int $authorId,
        public readonly AuthorApiDto $author
    ) {
    }

    public static function builder(Post $post)
    {
        return new self(
            $post->getId(),
            $post->getTitle(),
            $post->getDescription(),
            $post->getAuthor()->getId(),
            AuthorApiDto::buildFromAuthor($post->getAuthor()),
        );
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'authorId' => $this->authorId,
            'author' => $this->author->__serialize(),
        ];
    }
}
