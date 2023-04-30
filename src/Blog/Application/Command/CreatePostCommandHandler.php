<?php

declare(strict_types=1);

namespace Blog\Application\Command;

use Blog\Application\DTO\PostDetailDto;
use Blog\DomainModel\AuthorRepository;
use Blog\DomainModel\Post;
use Blog\DomainModel\PostException;
use Blog\DomainModel\PostRepository;
use function PHPUnit\Framework\throwException;

class CreatePostCommandHandler
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly AuthorRepository $authorRepository
    ) {

    }

    public function __invoke(CreatePostCommand $command):PostDetailDto
    {
        $post = $command->post;

        try{
            $author = $this->authorRepository->findById($post['userId']);
            $postEntity = Post::postPostBuilder(
                title: $post['title'],
                description: $post['body'],
                author: $author
            );
            $post = $this->postRepository->save($postEntity);
            return PostDetailDto::builder($post);
        }catch (\Throwable $th){
            throw PostException::withData($post);
        }
    }
}
