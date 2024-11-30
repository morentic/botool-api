<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ApiResource]
#[Get(security: "is_granted('PUBLIC_ACCESS')")]
#[GetCollection(security: "is_granted('PUBLIC_ACCESS') or is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")]
#[Post(security: "is_granted('ROLE_USER')")]
#[Put(security: "is_granted('ROLE_ADMIN') or object.owner == user")]
#[Delete(security: "is_granted('ROLE_ADMIN')")]
class BuildOrder
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private ?Uuid $uuid;

    #[ORM\Column(type: "string")]
    public string $name;

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }
}