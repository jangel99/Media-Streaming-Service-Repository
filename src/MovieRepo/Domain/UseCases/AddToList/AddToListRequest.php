<?php

namespace App\MovieRepo\Domain\UseCases\AddToList;

class AddToListRequest extends \App\MovieRepo\Domain\UseCases\UseCaseRequest
{
    private $movieId;
    private $userId;

    public function __construct($movieId, $userId) {
        $this->movieId = $movieId;
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * @param mixed $movieId
     */
    public function setMovieId($movieId): void
    {
        $this->movieId = $movieId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }
}