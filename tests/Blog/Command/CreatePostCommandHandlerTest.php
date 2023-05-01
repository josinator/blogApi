<?php

declare(strict_types=1);

namespace Tests\Blog\Command;

use Blog\Application\Command\CreatePostCommand;
use Blog\Application\Command\CreatePostCommandHandler;
use Blog\Application\DTO\PostDetailDto;
use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorRepository;
use Blog\DomainModel\PostException;
use Blog\DomainModel\PostRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryAuthorRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryPostRepository;
use PHPUnit\Framework\TestCase;

class CreatePostCommandHandlerTest extends TestCase
{
    private PostRepository $postRepository;
    private AuthorRepository $authorRepository;
    private CreatePostCommandHandler $handler;

    /** @before */
    public function prepareCommand(): void
    {
        $this->postRepository = new InMemoryPostRepository();
        $this->authorRepository = new InMemoryAuthorRepository();

        $this->authorRepository->save($this->getAuthor());

        $this->handler = new CreatePostCommandHandler($this->postRepository, $this->authorRepository);

    }

    /** @test */
    public function createAPostWithNoValidDataExceptionShouldBeThrow(): void
    {
        $postData = $this->getPostData();
        $postData['userId'] = 2;
        $this->expectException(PostException::class);
        $this->expectExceptionMessage('Try to create an Post with data: {"userId":2,"id":1,"title":"sunt aut facere repellat provident occaecati excepturi optio reprehenderit","body":"quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"}');
        $this->handler->__invoke(new CreatePostCommand($postData));

    }

    /** @test */
    public function createAPostWithValidDataPostWillBeReturn(): void
    {
        $postData = $this->getPostData();
        $post = $this->handler->__invoke(new CreatePostCommand($postData));
        $this->assertInstanceOf(PostDetailDto::class, $post);
        $this->assertEquals($postData['title'], $post->title);
        $this->assertEquals($postData['body'], $post->description);
        $this->assertEquals($postData['userId'], $post->authorId);
        $this->assertNotEmpty($post->author);

    }

    private function getPostData()
    {
        return json_decode(' {
    "userId": 1,
    "id": 1,
    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
  }', true);
    }

    private function getAuthor()
    {
        $authorData = json_decode(' 
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
