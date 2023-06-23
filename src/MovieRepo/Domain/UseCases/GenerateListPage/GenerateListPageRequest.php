<?php

namespace App\MovieRepo\Domain\UseCases\GenerateListPage;

class GenerateListPageRequest extends \App\MovieRepo\Domain\UseCases\UseCaseRequest
{
    private $idUser;

    public function __construct($idUser) {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }
}