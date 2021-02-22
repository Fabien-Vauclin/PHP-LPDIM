<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

class Player
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     * @return Player
     */
    public function setId(int $id): Player
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Player
     */
    public function setUsername(string $username): Player
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Player
     */
    public function setEmail(string $email): Player
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private int $id;
    /**
     * @ORM\Column(type="string")
     */
    private string $username;
    /**
     * @ORM\Column(type="string")
     */
    private string $email;
}