<?php

namespace App\DTO\RequestAPIResponse;

class RequestApiListDTO
{

    private array $movieList;
    private $cached;
    private $project;
    private $id;
    private $status;

    public function __construct() {

    }

    /**
     * @return array
     */
    public function getMovieList(): array
    {
        return $this->movieList;
    }

    /**
     * @param array $movieList
     */
    public function setMovieList(array $movieList): void
    {
        $this->movieList = $movieList;
    }

    public function addMovieToList($movie) {
        $this->movieList[] = $movie;
    }

    /**
     * @return mixed
     */
    public function getCached()
    {
        return $this->cached;
    }

    /**
     * @param mixed $cached
     */
    public function setCached($cached): void
    {
        $this->cached = $cached;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
}