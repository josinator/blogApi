<?php

namespace Blog\DomainModel;

use Blog\Infrastructure\Persistence\Doctrine\Repository\DoctrinePostRepository;
use Doctrine\ORM\Mapping as ORM;
use PharIo\Manifest\Author;

class Post
{
    private const DESCRIPTION_MIN_LENGTH = 25;
    public readonly int $id;

    private function __construct(
        private string $title,
        private string $description,
        private Author $author)
    {

    }


    /**
     * @throws PostException
     */
    public static function postPostBuilder(string $title, string $description, Author $author){
        self::guardTitle($title);
        self::guardDescription($description);
        return new self($title, $description, $author);
    }

    /**
     * @throws PostException
     */
    private static function guardTitle(string $title): void
    {
        //Not and empty string
        if(empty($title)){
            throw PostException::withEmptyTitle();
        }
    }

    /**
     * @throws PostException
     */
    private static function guardDescription(string $description): void
    {
        //No EmptyDescription
        if(empty($description)){
            throw PostException::withEmptyDescription();
        }


        //Description at least has to be 25 characters length
        if(strlen($description) < self::DESCRIPTION_MIN_LENGTH){
            throw PostException::withToShortDescription();
        }
    }


    public function getTitle(): string
    {
        return $this->title;
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    public function getAuthor(): Author
    {
        return $this->author;
    }


    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

}
