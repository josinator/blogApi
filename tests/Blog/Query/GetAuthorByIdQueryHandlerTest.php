<?php

declare(strict_types=1);

namespace Tests\Blog\Query;

use Blog\Application\DTO\AuthorItemDto;
use Blog\Application\DTO\PostItemDto;
use Blog\Application\Query\GetAllApiPostsQuery;
use Blog\Application\Query\GetAllApiPostsQueryHandler;
use Blog\Application\Query\GetAllAuthorsQuery;
use Blog\Application\Query\GetAllAuthorsQueryHandler;
use Blog\Application\Query\GetAuthorByIdQuery;
use Blog\Application\Query\GetAuthorByIdQueryHandler;
use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorNotFoundException;
use Blog\DomainModel\AuthorRepository;
use Blog\DomainModel\PostRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryAuthorRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryPostRepository;
use Common\Application\Query;
use PHPUnit\Framework\TestCase;

class GetAuthorByIdQueryHandlerTest  extends TestCase
{
    private GetAuthorByIdQueryHandler $handler;

    /** @before */
    public function prepareCommand(): void
    {
        $authorRepository = new InMemoryAuthorRepository();
        $authorRepository->save($this->getAuthor());
        $this->handler = new GetAuthorByIdQueryHandler($authorRepository);


    }

    /** @test */
    public function whenNoExistIdOfAuthorWasRequestExceptionShouldThrow(): void
    {

        $this->expectException(AuthorNotFoundException::class);
        $this->expectExceptionMessage('Author not found for authorId: 2');
        $author = $this->handler->__invoke(new GetAuthorByIdQuery(2));



    }

    /** @test */
    public function whenExistIdOfAuthorWasRequestAuthorWillResponse(): void
    {
        $author = $this->handler->__invoke(new GetAuthorByIdQuery(1));

        $this->assertNotEmpty($author);
        $this->assertEquals('Leanne Graham', $author->name);


    }

    private function getAuthor()
    {
        $authorData =  json_decode(' 
      {
      "id": 1,
  "name": "Leanne Graham",
  "username": "Bret",
  "email": "Sincere@april.biz",
  "address": {
          "street": "Kulas Light",
    "suite": "Apt. 556",
    "city": "Gwenborough",
    "zipcode": "92998-3874",
    "geo": {
              "lat": "-37.3159",
      "lng": "81.1496"
    }
  },
  "phone": "1-770-736-8031 x56442",
  "website": "hildegard.org",
  "company": {
          "name": "Romaguera-Crona",
    "catchPhrase": "Multi-layered client-server neural-net",
    "bs": "harness real-time e-markets"
  }
}', true);
        return Author::builder(
            $authorData['name'],
            $authorData['username'],
            $authorData['email'],
            $authorData['address'],
            $authorData['phone'],
            $authorData['website'],
            $authorData['company']
        );

    }
}
