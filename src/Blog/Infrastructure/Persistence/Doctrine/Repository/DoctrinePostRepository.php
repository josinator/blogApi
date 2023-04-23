<?php

namespace Blog\Infrastructure\Persistence\Doctrine\Repository;


use Blog\DomainModel\Post;
use Blog\DomainModel\PostRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;

class DoctrinePostRepository implements PostRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {

    }

    public function save(Post $post): void
    {
        $this->entityManager->persist($post);

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





    /**
     * @return array|Post[]
     */
    public function findPaginate(int $limit = 100, int $page = 1): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('p')
            ->from(Post::class, 'p')
            ->setMaxResults($limit)
            ->setFirstResult(($page - 1) * $limit)
            ->getQuery()
            ->getResult();
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Post::class)->findAll();
    }
}
