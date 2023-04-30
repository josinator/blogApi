<?php

declare(strict_types=1);

namespace Tests\Blog\Command;

use Blog\Application\Command\CreateAuthorCommand;
use Blog\Application\Command\CreateAuthorCommandHandler;
use Blog\Application\DTO\AuthorDetailDto;
use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorException;
use Blog\DomainModel\AuthorRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryAuthorRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

class CreateAuthorCommandHandlerTest extends TestCase
{
    private AuthorRepository $authorRepository;
    private CreateAuthorCommandHandler $handler;

    /** @before */
    public function prepareCommand(): void
    {
        $this->authorRepository = new InMemoryAuthorRepository();
        $this->handler = new CreateAuthorCommandHandler($this->authorRepository);
    }

    /** @test */
    public function createAnAuthorWithNoValidDataExceptionShouldBeThrow(): void
    {
        $data = $this->getAuthorData();
        $data['email'] = "invalid.email";

        $this->expectException(AuthorException::class);
        $this->expectExceptionMessage('Try to create an Author with data: {"id":1,"name":"Leanne Graham","username":"Bret","email":"invalid.email","address":{"street":"Kulas Light","suite":"Apt. 556","city":"Gwenborough","zipcode":"92998-3874","geo":{"lat":"-37.3159","lng":"81.1496"}},"phone":"1-770-736-8031 x56442","website":"hildegard.org","company":{"name":"Romaguera-Crona","catchPhrase":"Multi-layered client-server neural-net","bs":"harness real-time e-markets"}}');
        $this->handler->__invoke(new CreateAuthorCommand($data));



    }

    /** @test */
    public function createAnAuthorWithValidDataAuthorWillBeReturn(): void
    {
        $data = $this->getAuthorData();
        $author = $this->handler->__invoke(new CreateAuthorCommand($data));
        $this->assertInstanceOf(AuthorDetailDto::class, $author);

        $this->assertIsNumeric($author->id);
        $this->assertEquals($author->name, $data['name']);
        $this->assertEquals($author->email, $data['email']);
        //TODO test all properties
    }

    private function getAuthorData()
    {
        return json_decode(' 
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
    }
}
