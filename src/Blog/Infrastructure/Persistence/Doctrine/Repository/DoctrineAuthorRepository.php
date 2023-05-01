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

    public function save(Author $author): Author
    {
        $this->entityManager->persist($author);
        $this->entityManager->flush();

        return $author;

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

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Author::class)->findAll();
    }
}
