<?php

namespace App\MovieRepo\Domain\UseCases\GenerateServicesPage;

class GenerateServicesRequest extends \App\MovieRepo\Domain\UseCases\UseCaseRequest
{

    private $location;

    public function __construct($location)
    {
        $this->location = $location;
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


}