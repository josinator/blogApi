<?php

namespace Blog\Application\Query;


use Blog\Application\DTO\PostItemDto;
use Blog\DomainModel\PostRepository;
use Common\Application\Query;

class GetAllPostQueryHandler implements Query
{

    public function __construct(private readonly PostRepository $postRepository)
    {
    }


    /**
     * @param GetAllPostQuery $query
     * @return array|PostItemDto[]
     */
    public function __invoke(GetAllPostQuery $query): array
    {
        $posts = $this->postRepository->findAll();

        $listPosts = [];
        foreach ($posts as $post){
            $listPosts = PostItemDto::builder($post);
        }

        return $listPosts;
    }
}
