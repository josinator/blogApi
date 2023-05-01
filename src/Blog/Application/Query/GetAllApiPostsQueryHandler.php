<?php

declare(strict_types=1);

namespace Blog\Application\Query;

use Blog\Application\DTO\PostApiDto;
use Blog\DomainModel\PostRepository;
use Common\Application\Query;

class GetAllApiPostsQueryHandler implements Query
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    /**
     * @return array|PostApiDto[]
     */
    public function __invoke(GetAllApiPostsQuery $query): array
    {
        $posts = $this->postRepository->findAll();

        $listPosts = [];
        foreach ($posts as $post) {
            $listPosts[] = PostApiDto::builder($post);
        }

        return $listPosts;
    }
}
