<?php

declare(strict_types=1);

namespace Blog\Application\Query;

use Blog\Application\DTO\PostItemDto;
use Blog\DomainModel\PostRepository;
use Common\Application\Query;

class GetAllPostsQueryHandler implements Query
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    /**
     * @return array|PostItemDto[]
     */
    public function __invoke(GetAllPostsQuery $query): array
    {
        $posts = $this->postRepository->findAll();

        $listPosts = [];
        foreach ($posts as $post) {
            $listPosts[] = PostItemDto::builder($post);
        }

        return $listPosts;
    }
}
