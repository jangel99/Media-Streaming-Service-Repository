<?php

namespace App\MovieRepo\Domain\Model\Movie;

class Movie
{
    private $idMovie;
    private $titleMovie;
    private $imdbID;
    private $location;
    private $project;
    private $duration;
    private $rating;
    private $descMovie;

    /**
     * @return mixed
     */
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    /**
     * @param mixed $idMovie
     */
    public function setIdMovie($idMovie): void
    {
        $this->idMovie = $idMovie;
    }

    /**
     * @return mixed
     */
    public function getTitleMovie()
    {
        return $this->titleMovie;
    }

    /**
     * @param mixed $titleMovie
     */
    public function setTitleMovie($titleMovie): void
    {
        $this->titleMovie = $titleMovie;
    }

    /**
     * @return mixed
     */
    public function getImdbID()
    {
        return $this->imdbID;
    }

    /**
     * @param mixed $imdbID
     */
    public function setImdbID($imdbID): void
    {
        $this->imdbID = $imdbID;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project): void
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getDescMovie()
    {
        return $this->descMovie;
    }

    /**
     * @param mixed $descMovie
     */
    public function setDescMovie($descMovie): void
    {
        $this->descMovie = $descMovie;
    }

}