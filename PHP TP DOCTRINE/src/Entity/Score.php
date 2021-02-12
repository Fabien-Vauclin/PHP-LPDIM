<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

class Score
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
     * @return Score
     */
    public function setId(int $id): Score
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     * @return Score
     */
    public function setScore(float $score): Score
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return Score
     */
    public function setCreatedAt(string $created_at): Score
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private int $id;
    /**
     * @ORM\Column(type="float")
     */private float $score;
    /**
     * @ORM\Column(type="datetime")
     */private string $created_at;
}