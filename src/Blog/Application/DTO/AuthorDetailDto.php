<?php

declare(strict_types=1);

namespace Blog\Application\DTO;

use Blog\DomainModel\Author;

class AuthorDetailDto
{
    /**
     * @param PostItemDto[] $posts
     */
    private function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $username,
        public readonly string $email,
        public readonly AddressDto $address,
        public readonly string $phone,
        public readonly string $site,
        public readonly string $company,
        public readonly array $posts
    ) {
    }

    public static function buildFromAuthor(Author $author): self
    {
        $posts = array_map(static function ($post) {
            return PostItemDto::builder($post);
        }, $author->getPosts()->toArray());

        return new self(
            id: $author->getId(),
            name: $author->getName(),
            username: $author->getUserName(),
            email: $author->getEmail()->email,
            address: AddressDto::buildFromAddress($author->getAddress()),
            phone: $author->getPhone()->phone,
            site: $author->getSite()->site,
            company: $author->getCompany()->name,
            posts: $posts
        );
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'address' => $this->address->__serialize(),
            'phone' => $this->phone,
            'posts' => array_map(static function (PostItemDto $post) {
                return $post->__serialize();
            }, $this->posts),
        ];
    }
}
