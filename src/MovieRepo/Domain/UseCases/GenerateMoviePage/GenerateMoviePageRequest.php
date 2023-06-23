<?php

namespace App\MovieRepo\Domain\UseCases\GenerateMoviePage;

class GenerateMoviePageRequest extends \App\MovieRepo\Domain\UseCases\UseCaseRequest
{
    private $country;
    private $movieID;
    private $userId;

    public function __construct($country, $movieID, $userId) {
        $this->country = $country;
        $this->movieID = $movieID;
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getMovieID()
    {
        return $this->movieID;
    }

    /**
     * @param mixed $movieID
     */
    public function setMovieID($movieID): void
    {
        $this->movieID = $movieID;
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