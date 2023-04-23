<?php

namespace Blog\Infrastructure\Persistence\Doctrine\Repository;


use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorRepository;
use Doctrine\ORM\EntityManager;

class DoctrineAuthorRepository implements AuthorRepository
{
    public function __construct(private readonly EntityManager $entityManager)
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


    public function findById(int $authorId): Author
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
