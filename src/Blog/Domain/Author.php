<?php

namespace Blog\Domain;

use Common\Domain\Address;
use Common\Domain\AddressException;
use Common\Domain\Company;
use Common\Domain\CompanyException;
use Common\Domain\Email;
use Common\Domain\Phone;
use Common\Domain\WebSites;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class Author
{

    private AuthorId $authorId;

    /** @var Collection | ArrayCollection blogs */
    private Collection $blogs;

    private function __construct(private string  $name,
                                private string   $userName,
                                private Email    $email,
                                private Address  $address,
                                private Phone    $phone,
                                private WebSites $site,
                                private Company  $company
    )
    {
        $this->authorId = AuthorId::new();
        $this->blogs = new ArrayCollection();
    }

    /**
     * @throws AuthorException
     * @throws AddressException
     * @throws CompanyException
     */
    public static function builder(string $name, string $userName, string $email, array $address, string $phone, string $site, array $company):self
    {

            self::guardNameAndUserNameNotEmpty($name, $userName);
            return new self(
                name: $name,
                userName: $userName,
                email: new Email($email),
                address: Address::build($address),
                phone: new Phone($phone),
                site: new WebSites($site),
                company: Company::build($company)
            );
    }

    /**
     * @throws AuthorException
     */
    private static function guardNameAndUserNameNotEmpty(string $name, string $userName): void
    {
        if(empty($name)){
            throw AuthorException::withEmptyName();
        }

        if(empty($userName)){
            throw AuthorException::withEmptyUserName();
        }
    }

    public function getAuthorId(): AuthorId
    {
        return $this->authorId;
    }


    public function setAuthorId(AuthorId $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getUserName(): string
    {
        return $this->userName;
    }


    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }


    public function getEmail(): Email
    {
        return $this->email;
    }


    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }


    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function setPhone(Phone $phone): void
    {
        $this->phone = $phone;
    }


    public function getSite(): WebSites
    {
        return $this->site;
    }


    public function setSite(WebSites $site): void
    {
        $this->site = $site;
    }


    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }


    public function getBlogs(): Collection
    {
        return $this->blogs;
    }


    public function setBlogs(Collection $blogs): void
    {
        $this->blogs = $blogs;
    }





}