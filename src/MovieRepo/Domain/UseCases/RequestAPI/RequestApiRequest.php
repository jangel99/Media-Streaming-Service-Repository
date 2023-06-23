<?php

namespace App\MovieRepo\Domain\UseCases\RequestAPI;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;

class RequestApiRequest extends UseCaseRequest
{
    private $searchValue;
    private $country;

    /**
     * @return mixed
     */
    public function getSearchValue()
    {
        return $this->searchValue;
    }

    /**
     * @param mixed $searchValue
     */
    public function setSearchValue($searchValue): void
    {
        $this->searchValue = $searchValue;
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


}