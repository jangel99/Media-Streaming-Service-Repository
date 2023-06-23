<?php

namespace App\MovieRepo\Domain\UseCases\GenerateListPage;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\MovieRepository;

class GenerateListPage extends \App\MovieRepo\Domain\UseCases\UseCase
{

    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository) {
        $this->movieRepository = $movieRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        return $this->movieRepository->getListMovieByIdUser($useCaseRequest->getIdUser());
    }
}