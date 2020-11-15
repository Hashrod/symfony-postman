<?php

namespace App\Entity;

use App\Repository\ReqUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReqUserRepository::class)
 */
class ReqUser
{
    const METHOD = [
        0 => 'GET',
        1 => 'POST',
        2 => 'UPDATE',
        3 => 'DELETE'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Method;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Token;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Body;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reqUsers")
     */
    private $UserReq;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reqResponse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMethod(): ?string
    {
        return $this->Method;
    }

    public function setMethod(string $Method): self
    {
        $this->Method = $Method;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(string $Url): self
    {
        $this->Url = $Url;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->Token;
    }

    public function setToken(?string $Token): self
    {
        $this->Token = $Token;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->Body;
    }

    public function setBody(?string $Body): self
    {
        $this->Body = $Body;

        return $this;
    }

    public function getUserReq(): ?User
    {
        return $this->UserReq;
    }

    public function setUserReq(?User $UserReq): self
    {
        $this->UserReq = $UserReq;

        return $this;
    }

    public function getReqResponse(): ?string
    {
        return $this->reqResponse;
    }

    public function setReqResponse(?string $reqResponse): self
    {
        $this->reqResponse = $reqResponse;

        return $this;
    }
}
