<?php

declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\Doctrine\Repository;

use Blog\DomainModel\Post;
use Blog\DomainModel\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;

class DoctrinePostRepository implements PostRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {

    }

    public function save(Post $post): Post
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
        return $post;
    }

    public function remove(Post $post): void
    {
        $this->entityManager->remove($post);

    }

    /**
     * @throws NotSupported
     */
    public function findById(int $postId): ?Post
    {
        return $this->entityManager->getRepository(Post::class)->findOneBy(
            ['id' => $postId]
        );
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Post::class)->findAll();
    }
}
