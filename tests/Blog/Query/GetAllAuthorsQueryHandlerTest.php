<?php

declare(strict_types=1);

namespace Tests\Blog\Query;

use Blog\Application\DTO\AuthorItemDto;
use Blog\Application\DTO\PostItemDto;
use Blog\Application\Query\GetAllApiPostsQuery;
use Blog\Application\Query\GetAllApiPostsQueryHandler;
use Blog\Application\Query\GetAllAuthorsQuery;
use Blog\Application\Query\GetAllAuthorsQueryHandler;
use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorRepository;
use Blog\DomainModel\PostRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryAuthorRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryPostRepository;
use Common\Application\Query;
use PHPUnit\Framework\TestCase;

class GetAllAuthorsQueryHandlerTest  extends TestCase
{
    private GetAllAuthorsQueryHandler $handler;
    private AuthorRepository $authorRepository;

    /** @before */
    public function prepareCommand(): void
    {
        $this->authorRepository = new InMemoryAuthorRepository();
        $this->handler = new GetAllAuthorsQueryHandler($this->authorRepository);

    }

    /** @test */
    public function whenAllAuthorsWasRequestButNoAuthorsFromApiEmptyResponse(): void
    {

        $authors = $this->handler->__invoke(new GetAllAuthorsQuery());

        $this->assertEmpty($authors);

    }

    /** @test */
    public function whenAllAuthorsWasRequestFromApiEmptyAllAuthorsWillResponse(): void
    {

        $this->authorRepository->save($this->getAuthor());

        $authors = $this->handler->__invoke(new GetAllAuthorsQuery());

        $this->assertNotEmpty($authors);
        $this->assertCount(1, $authors);
        $this->assertEquals('Leanne Graham', $authors[0]->name);


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
