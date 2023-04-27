<?php

declare(strict_types=1);

namespace Blog\Application\Command;

use Blog\DomainModel\AuthorRepository;
use Blog\DomainModel\Post;
use Blog\DomainModel\PostRepository;

class CreatePostCommandHandler
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly AuthorRepository $authorRepository
    ) {

    }

    public function __invoke(CreatePostCommand $command): void
    {
        $post = $command->post;

        $author = $this->authorRepository->findById($post['userId']);

        $postEntity = Post::postPostBuilder(
            title: $post['title'],
            description: $post['body'],
            author: $author
        );
        $this->postRepository->save($postEntity);
    }
}
