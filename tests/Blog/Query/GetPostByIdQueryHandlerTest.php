<?php

declare(strict_types=1);

namespace Tests\Blog\Query;

use Blog\Application\Query\GetPostByIdQuery;
use Blog\Application\Query\GetPostByIdQueryHandler;
use Blog\DomainModel\Author;
use Blog\DomainModel\Post;
use Blog\DomainModel\PostException;
use Blog\DomainModel\PostRepository;
use Blog\Infrastructure\Persistence\InMemory\InMemoryPostRepository;
use PHPUnit\Framework\TestCase;

class GetPostByIdQueryHandlerTest extends TestCase
{
    private GetPostByIdQueryHandler $handler;
    private PostRepository $postRepository;

    /** @before */
    public function prepareCommand(): void
    {
        $this->postRepository = new InMemoryPostRepository();
        $this->setPostData();
        $this->handler = new GetPostByIdQueryHandler($this->postRepository);

    }

    /** @test */
    public function whenNoExistIdOfPostWasRequestExceptionShouldThrow(): void
    {

        $this->expectException(PostException::class);
        $this->expectExceptionMessage('No post found for Id: 3');
        $this->handler->__invoke(new GetPostByIdQuery(3));

    }

    /** @test */
    public function whenExistIdOfPostWasRequestPostWillResponse(): void
    {
        $post = $this->handler->__invoke(new GetPostByIdQuery(1));

        $this->assertNotEmpty($post);
        $this->assertEquals('Leanne Graham', $post->author);
        $this->assertEquals('sunt aut facere repellat provident occaecati excepturi optio reprehenderit', $post->title);

    }

    private function setPostData(): void
    {
        $postData = json_decode(' [{
    "userId": 1,
    "id": 1,
    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
  },
  {
    "userId": 1,
    "id": 2,
    "title": "Titulo 2",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
  }
  ]', true);

        foreach ($postData as $post) {
            $this->postRepository->save(Post::postPostBuilder(
                $post['title'],
                $post['body'],
                $this->getAuthor()
            ));
        }
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
        $author = Author::builder(
            $authorData['name'],
            $authorData['username'],
            $authorData['email'],
            $authorData['address'],
            $authorData['phone'],
            $authorData['website'],
            $authorData['company']
        );

        $author->setId(1);

        return $author;

    }
}
