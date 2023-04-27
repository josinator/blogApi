<?php

declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\Doctrine\Repository;

use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineAuthorRepository implements AuthorRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {

    }

    public function save(Author $author): void
    {
        $this->entityManager->persist($author);

    }

    public function remove(Author $author): void
    {
        $this->entityManager->remove($author);

    }

    public function findById(int $authorId): ?Author
    {
        return $this->entityManager->getRepository(Author::class)->findOneBy(
            ['id' => $authorId]
        );
    }

    /**
     * @return array|Author[]
     */
    public function findPaginate(int $limit = 100, int $page = 1): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('a')
            ->from(Author::class, 'a')
            ->setMaxResults($limit)
            ->setFirstResult(($page - 1) * $limit)
            ->getQuery()
            ->getResult();
    }
}
