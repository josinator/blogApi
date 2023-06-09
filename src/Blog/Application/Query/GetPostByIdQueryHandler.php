<?php

declare(strict_types=1);

namespace Blog\Application\Query;

use Blog\Application\DTO\PostDetailDto;
use Blog\DomainModel\PostException;
use Blog\DomainModel\PostRepository;

class GetPostByIdQueryHandler
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    public function __invoke(GetPostByIdQuery $query): PostDetailDto
    {
        $post = $this->postRepository->findById($query->id);

        if (null === $post) {
            throw PostException::notPostFoundForId($query->id);
        }

        return PostDetailDto::builder($post);
    }
}
